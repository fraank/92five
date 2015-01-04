<?php

class Events extends \Eloquent {

    protected $table = 'events';

    protected $softDelete = true;

    public function toArray()
    {
      $array = parent::toArray();
      $array['category'] = $this->category;
      return $array;
    }

    public function users()
    {
    	return $this->belongsToMany('User','event_user')->withPivot('user_id');
    }

    public function getCategoryAttribute()
    {
      $category = $this->calendar_category()->first();
      if($category)
        return $category->title;
      return "";
    }

    public function calendar_category()
    {
      return $this->belongsTo('CalendarCategory', 'calendar_category_id');
    }
}
