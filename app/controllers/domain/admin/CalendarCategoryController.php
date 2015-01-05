<?php namespace Controllers\Domain\Admin;

use Cartalyst\Sentry\Facades\Laravel\Sentry as Sentry;

/**
* User Controller.
* @version    1.0.0
* @author     Frank Cieslik
* @copyright  (c) 2015, team
* @link       http://github.com/fraank
**/
class CalendarCategoryController extends \BaseController{

  protected $calendar_category;

  /**
  * Constructor
  */
  public function __construct()
  {
    $this->calendar_category = \App::make('CalendarCategoryInterface');
  }

  /**
  * Get all users
  * @return View
  */
  public function index()
  {
    //Get all data
    $data = $this->calendar_category->getCalendarCategories();
    return \View::make('dashboard.calendar_categories.index')
    ->with('data', $data);
  }

  public function add()
  {
    $form = new \CalendarCategory();
    return \View::make('dashboard.calendar_categories.add')->with('form', $form);
  }

  /**
  * Add user with email
  * @return Redirect
  */
  public function postAdd()
  {
    $data = \Input::all();
    $createdUserId = Sentry::getUser()->id;
    $result = $this->calendar_category->addCalendarCategory($data, $createdUserId);

    //Notify User
    if($result)
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','success')->with('message','Calendar Category Created');
    }
    else
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','error')->with('message','Something Went Wrong');
    }
  }

  public function update($id)
  {
    $form = \CalendarCategory::find($id);
    return \View::make('dashboard.calendar_categories.update')->with('form', $form);
  }

  public function postUpdate($id)
  {
    $data = \Input::all();
    $data['calendarCategoryId'] = $id;
    $createdUserId = Sentry::getUser()->id;
    $result = $this->calendar_category->editCalendarCategory($data, $createdUserId);
    if($result)
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','success')->with('message','Calendar Category Updated');
    }
    else
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','error')->with('message','Something Went Wrong');
    }
  }

  /**
  * Delete User
  * @return Redirect
  */
  public function delete()
  {
    //Get the User Id
    $calendarCategoryId = \Input::get('calendarCategoryId');
    $deletedUserId = Sentry::getUser()->id;
    //Delete User
    $result = $this->calendar_category->deleteCalendarCategory($calendarCategoryId, $deletedUserId);
    //Redirect with proper notifications
    if($result)
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','success')->with('message','Category Deleted');
    }
    else
    {
      return \Redirect::to('dashboard/admin/calendar_categories')->with('status','error')->with('message','Something Went Wrong');
    }
  }

  /**
  * Manage CalendarCategory
  * @param int
  * @return JSON
  */
  public function manageCalendarCategories($calendarcategoryId)
  {
    //Get all data
    $data = \Input::json()->all();
    $result = $this->calendar_category->manageCalendarCategories($data);
    //Display Appropriate Notification
    if($result)
    {
      return \Response::json(array(
        'error' => false),
        200);
    }
    else
    {
      return \Response::json(array(
        'error' => true),
        500);
    }
  }

}
