<?php
use \Exception as Exception;
use \SomeThingWentWrongException as SomeThingWentWrongException;
/**
 * Calendar Repository.
 * @version    1.0.0
 * @author     Chintan Banugaria
 * @copyright  (c) 2014, 92fiveapp
 * @link       http://92fiveapp.com
 **/


class CalendarRepository implements CalendarInterface{

	public function addEvent($data,$createdUserId)
	{
		try
		{
			//Create a new instance of the model
			$calendar =  new \Events;
			$calendar->title = $data['title'];
			$calendar->calendar_category_id = intval($data['calendar_category_id']);
			$calendar->date = $data['date_submit'];
			$calendar->notes = $data['note'];
			$calendar->location = $data['location'];

			if(empty($data['allday']))
				$calendar->allday = false;
			else
				$calendar->allday = true;

			if($data['starttime_submit'] != '') {
				$calendar->start_time = $data['starttime_submit'];
			} else if ($calendar->allday == true) {
				$calendar->start_time = '00:00:00';
			}

			if($data['endtime_submit'] != '') {
				$calendar->end_time = $data['endtime_submit'];
			} else if ($calendar->allday == true) {
				$calendar->end_time = '23:59:59';
			}


			$calendar->updated_by = $createdUserId;
			//Save the model
			$calendar->save();
			$emails =  preg_split("/[\s,]+/", $data['tagsinput']);
			$usersId = \User::whereIn('email',$emails)->lists('id');
			//Add collaborators
			foreach ($usersId as $userId)
			{
					$eventCollabs = new \EventUser;
					$eventCollabs->events_id = $calendar->id;
					$eventCollabs->user_id = $userId;
					$eventCollabs->updated_by = $createdUserId;
					$eventCollabs->save();
			}
			return 'success';
		}
		catch(Exception $e)
		{
			\Log::error("Something Went wrong in Calendar Repository - addEvent():".$e->getMessage());
			throw new \SomeThingWentWrongException();
		}

	}
	public function getEvents($userId, $day)
	{
		try
		{
			$finalevents = array();
			$eventsId = \EventUser::where('user_id',$userId)->lists('events_id');
			if(sizeof($eventsId) != 0)
			{
			$events = \Events::whereIn('id',$eventsId)->where('date',$day)->orderBy('start_time')->get(array('id','title','start_time','end_time','calendar_category_id','notes','location','updated_by', 'allday'))->toArray();
			foreach ($events as $event) {

				$users = \Events::find($event['id'])->users()->orderBy('first_name')->get()->toArray();
				$event['users'] = $users;
				if($event['updated_by'] == $userId)
				{
					$event['editdelete'] = "yes";
				}
				else
				{
					$event['editdelete'] = "no";
				}
				//Log::info($eventusers[0]['first_name']);
				$finalevents[] = $event;
			}

			//Log::info(json_encode($finalevents));
			return $finalevents;
			}
			else
			{
				return null;
			}
		}
		catch(Exception $e)
		{
			\Log::error("Somethin Went Wrong in Calendar Repository - getEvents():".$e->getMessage());
			throw new \SomeThingWentWrongException();
		}
	}
	public function checkPermission($eventId,$userId)
	{
		try
		{
			$event = \Events::find($eventId);
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
	public function getEventDates($userId)
	{

		$eventsId = \EventUser::where('user_id',$userId)->lists('events_id');
		if(sizeof($eventsId) !=0)
		{
		$eventDates =  \Events::whereIn('id',$eventsId)->get(array('date'))->toJson();
		return $eventDates;
		}
		else
		{
			return json_encode([]);
		}

	}

	public function getEvent($id)
	{
		try
		{
			$event = \Events::where('id',$id)->get()->toArray();
			$users =  \Events::find($id)->users()->orderBy('first_name')->get()->toArray();
			$event['users'] = $users;
			return $event;
		}
		catch(Exception $e)
		{
			\Log::error("Something Went Wrong in Calendar Repository - getEvent():".$e->getMessage());
		}
	}

	public function deleteEvent($id,$userId)
	{
		try{

			$event = \Events::find($id);
			$event->deleted_by = $userId;
			$event->save();
			$event->delete();
			$eventusers = \EventUser::where('events_id',$id)->delete();
			return 'success';

		}
		catch (Exception $e)
		{
			\Log::error("Something Went Wrong in Calendar Repository - deleteEvent():".$e->getMessage());
			return 'error';
		}
	}
	public function editEvent($data, $updatedUserId)
	{
		try
		{
			$event = \Events::find($data['eventid']);
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
	public function getEventsCreatedByUser($userId)
	{
		try
		{
			$events = \Events::where('updated_by',$userId)->orderBy('date','DESC')->get()->toArray();
			return $events;
		}
		catch(Exception $e)
		{
			\Log::error("Something Went Wrong in Calendar Repository - getEventsCreatedByUser():".$e->getMessage());
			return null;
		}
	}
}
