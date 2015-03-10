<?php

class BaseController extends Controller {

  protected $layout = 'dashboard.layouts.default';

  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */
  protected function setupLayout()
  {
    $this->setMenuData();

    if ( ! is_null($this->layout))
    {
      $this->layout = View::make($this->layout);
    }
  }

  protected function setMenuData()
  {
    $sidebar = array(
      array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Dashboard'), 
        'link' => url('/dashboard'),
        'icon' => 'fa fa-dashboard'
      ),
      array(
        'class' => 'ico-projects',
        'name' => trans('92five.Projects'), 
        'link' => url('/dashboard/projects'),
        'icon' => 'fa fa-cubes'
      ),
      array(
        'class' => 'ico-tasks',
        'name' => trans('92five.Tasks'), 
        'link' => url('/dashboard/tasks'),
        'icon' => 'fa fa-tasks'
      ),
      array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Calendar'), 
        'link' => url('/dashboard/calendar'),
        'icon' => 'fa fa-calendar'
      ),
      array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Timesheet'), 
        'link' => url('/dashboard/timesheet'),
        'icon' => 'fa fa-clock-o'
      ),
      array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.My To-dos'), 
        'link' => url('/dashboard/mytodos'),
        'icon' => 'fa fa-check-square-o'
      )
    );
    
    // arrach Admin
    if(Sentry::getUser() && Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))
    {
      $sidebar[] = "separator";
      $sidebar[] = array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Admin'),
        'link' => url('/dashboard/admin'),
        'icon' => 'fa fa-dashboard'
      );
      $sidebar[] = array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Roles'),
        'link' => url('/dashboard/admin/roles'),
        'icon' => 'fa fa-dashboard'
      );
      $sidebar[] = array(
        'class' => 'ico-dashboard',
        'name' => trans('92five.Reports'),
        'link' => url('/dashboard/reports'),
        'icon' => 'fa fa-dashboard'
      );
    }
    View::share(array(
      'sidebar' => $sidebar
    ));
    
  }

}