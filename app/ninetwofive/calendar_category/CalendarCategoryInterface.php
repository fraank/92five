<?php
/**
* Calendar Interface.
* @version    1.0.0
* @author     Frank Cieslik
* @copyright  (c) 2015
* @link       http://github.com/fraank
**/

interface CalendarCategoryInterface{

  //Add event with data
  public function addCalendarCategory($data,$createdUserId);
  //Get categories
  public function getCalendarCategories();
  //Get the event
  public function getCalendarCategory($id);
  //Delete the event
  public function deleteCalendarCategory($id,$userId);
  //Update event
  public function editCalendarCategory($data, $updatedUserId);
  //Check permission
  public function checkPermission($eventId,$userId);
}
