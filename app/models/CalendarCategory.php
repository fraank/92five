<?php

class CalendarCategory extends \Eloquent  {

  protected $table = 'calendar_categories';

  protected $softDelete = true;

  // return string for displaying CalendarCategory
  public static function select()
  {
    $data = \CalendarCategory::all();
    $ret_data = array();
    if($data && count($data) > 0)
      foreach($data as $actData) {
        $ret_data[$actData->id] = $actData->title;
      }
    return $ret_data;
  }

}
