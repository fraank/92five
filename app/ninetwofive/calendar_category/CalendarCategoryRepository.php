<?php
use \Exception as Exception;
use \SomeThingWentWrongException as SomeThingWentWrongException;

/**
* Calendar CategoryRepository.
* @version    1.0.0
* @author     Frank Cieslik
* @copyright  (c) 2015
* @link       http://github.com/fraank
**/


class CalendarCategoryRepository implements CalendarCategoryInterface{

  public function addCalendarCategory($data,$createdUserId)
  {
    try
    {
      //Create a new instance of the model
      $calendar_category =  new \CalendarCategory;
      $calendar_category->title = $data['title'];
      $calendar_category->description = $data['description'];
      //$calendar_category->updated_by = $createdUserId;
      //Save the model
      $calendar_category->save();
      return true;
    }
    catch(Exception $e)
    {
      \Log::error("Something Went wrong in Calendar Category Repository - addCalendarCategory():".$e->getMessage());
      throw new \SomeThingWentWrongException();
    }
  }

  public function getCalendarCategories()
  {
    try
    {
      $calendar_categories = \CalendarCategory::withTrashed()->orderBy('title')->get(array('id','title','description', 'public_content', 'deleted_at', 'created_at', 'updated_at'));
      return $calendar_categories;
    }
    catch(Exception $e)
    {
      \Log::error("Somethin Went Wrong in Calendar Repository - getCalendarCategories():".$e->getMessage());
      throw new \SomeThingWentWrongException();
    }
  }

  public function checkPermission($eventId,$userId)
  {
    try
    {
      $event = \CalendarCategory::find($eventId);
      if($event->updated_by == $userId)
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    catch(Exception $e)
    {
      \Log::error("Something Went Wrong in Calendar Repository - checkPermission():".$e->getMessage());
    }
  }


  public function getCalendarCategory($id)
  {
    try
    {
      $event = \CalendarCategory::where('id',$id)->get()->toArray();
      $users =  \CalendarCategory::find($id)->users()->orderBy('first_name')->get()->toArray();
      $event['users'] = $users;
      return $event;
    }
    catch(Exception $e)
    {
      \Log::error("Something Went Wrong in Calendar Repository - getEvent():".$e->getMessage());
    }
  }

  public function deleteCalendarCategory($id,$userId)
  {
    try{
      $event = \CalendarCategory::find($id);
      //$event->deleted_by = $userId;
      //$event->save();
      $event->delete();
      return 'success';
    }
    catch (Exception $e)
    {
      \Log::error("Something Went Wrong in Calendar Category Repository - deleteCalendarCategory():".$e->getMessage());
      return 'error';
    }
  }
  public function editCalendarCategory($data, $updatedUserId)
  {
    try
    {
      $event = \CalendarCategory::find($data['eventid']);
      $event->title = $data['title'];
      $event->calendar_category_id = intval($data['calendar_category_id']);
      $tempDate =\DateTime::createFromFormat('j F, Y',$data['date']);
      $event->date =  $tempDate->format('Y-m-d');

      if(empty($data['allday']))
      $event->allday = false;
      else
      $event->allday = true;

      if($data['starttime_submit'] != '') {
        $event->start_time = $data['starttime_submit'];
      } else if ($event->allday == true && !empty($event->start_time)) {
        $event->start_time = $tempDate->format('00:00:00');
      }

      if($data['endtime_submit'] != '') {
        $event->end_time = $data['endtime_submit'];
      } else if ($event->allday == true && !empty($event->end_time)) {
        $event->end_time = $tempDate->format('23:59:59');
      }

      $event->notes = $data['note'];
      $event->location = $data['location'];
      $event->updated_by = $updatedUserId;
      $event->save();

      //Update the users
      $delCurrentUsers = \EventUser::where('events_id',$data['eventid'])->forceDelete();
      $email  = $data['tagsinput'];
      $emails =  preg_split("/[\s,]+/", $email);
      $user_id = \User::whereIn('email',$emails)->lists('id');
      foreach ($user_id as $userid)
      {
        $eventuser = new \EventUser;
        $eventuser->user_id = $userid;
        $eventuser->events_id = $data['eventid'];
        $eventuser->updated_by = $updatedUserId;
        $eventuser->save();

      }
      //Everything done
      return 'success';
    }
    catch (Exception $e)
    {
      \Log::error("Something Went Wrong in Calendar Repository - editEvent():".$e->getMessage());
      return 'error';
    }

  }

}
