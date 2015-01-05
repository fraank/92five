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
      $calendar_category->public_content = $data['public_content'];
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
      $calendar_category = \CalendarCategory::where('id',intval($data['calendarCategoryId']))->first();
      $calendar_category->title = $data['title'];
      $calendar_category->description = $data['description'];
      $calendar_category->public_content = $data['public_content'];

      //$calendar_category->updated_by = $updatedUserId;
      $calendar_category->save();

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
