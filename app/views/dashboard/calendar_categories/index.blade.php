@extends('dashboard.default')
@section('head')
<title>92five app - All Calendar Categories</title>
@stop
@section('content')

<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">Dashboard</a> / <a href="{{url('/dashboard/admin')}}">Admin</a> / Calendar Categories</h2>
        <div class="add_project_main">
          <a href="{{url('dashboard/admin/calendar_categories/add')}}" class="add_project add-last">+ &nbsp;Add Category</a>
        </div>
        <div class="row-fluid">
          <table class="table">
            <thead>
              <th>ID</th>
              <th>Title</th>
              <th>created</th>
              <th>updated</th>
              <th>Public Content?</th>
              <th>Deleted?</th>
              <th>Actions</th>
            </thead>
        @if(sizeof($data)!=0)
          @foreach($data as $calendar_category)
          <tr>
            <td>
              {{$calendar_category['id']}}
            </td>
            <td>
              {{$calendar_category['title']}}
            </td>
            <td>
              {{new ExpressiveDate($calendar_category['created_at'])}}
            </td>
            <td>
              {{new ExpressiveDate($calendar_category['updated_at'])}}
            </td>

            <td>
              @if($calendar_category['public_content'] == true)
                <div class="view_checkbox">
                  <input type="checkbox" id="public-{{$calendar_category['id']}}" checked class="regular-checkbox checked" />
                  <label calendarcategoryid={{$calendar_category['id']}} checked class="public" for="banned-{{$calendar_category['id']}}"></label>
                </div>
              @else
                <div class="view_checkbox">
                  <input type="checkbox" id="public-{{$calendar_category['id']}}"  class="regular-checkbox checked" />
                  <label calendarcategoryid={{$calendar_category['id']}} class="public" for="banned-{{$calendar_category['id']}}"></label>
                </div>
              @endif
            </td>
            <td>
              @if($calendar_category['deleted_at'])
                <div class="view_checkbox">
                  <input type="checkbox" id="deleted-{{$calendar_category['id']}}" checked class="regular-checkbox checked" />
                  <label calendarcategoryid={{$calendar_category['id']}} checked class="deleted" for="deleted-{{$calendar_category['id']}}"></label>
                </div>
              @else
                <div class="view_checkbox">
                  <input type="checkbox" id="deleted-{{$calendar_category['id']}}"  class="regular-checkbox checked" />
                  <label calendarcategoryid={{$calendar_category['id']}} class="deleted" for="deleted-{{$calendar_category['id']}}"></label>
                </div>
              @endif
            </td>
            <td>
              <a href="{{url('/dashboard/admin/calendar_categories/update',array($calendar_category['id']))}}" class="p-icon-2" title="Change Email">Update</a> |
              <a class="calendarcategory_delete" calendarcategoryid="{{$calendar_category->id}}" href="#">Delete</a>
            </td>
          </tr>
          @endforeach
        @endif
      </table>
    </div>
  </div>
</div>
</div>

<!-- Start Delete popup  -->
<div id="myModal-item-delete" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Really ?</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-delete">Confirm delete the Category?</div>
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/admin/calendar_categories/delete')}}">  <input type="hidden" name="calendarCategoryId" id="calendarCategoryId" value=""  > <button class="submit">Yes please.</a></button></form>
      <button class="submit dontdelete" id="dontdelete" >No Thanks.</a></button></div>
    </div>
</div>
<!-- End Delete popup -->

  @if(Session::has('status') and Session::has('message') )
  @if(Session::has('status') == 'success')
  <script>
    $(document).ready( function() {
      var url = window.location.href;
      var tempurl = url.split('dashboard')[0];
      iosOverlay({
        text: "{{Session::get('message')}}",
        duration: 5e3,
        icon: tempurl+'assets/images/notifications/check.png'
      });

    });
  </script>
  {{Session::forget('status'); Session::forget('message');}}
  @elseif(Session::has('status') == 'error')
  <script>
    $(document).ready( function() {
      var url = window.location.href;
      var tempurl = url.split('dashboard')[0];
      iosOverlay({
        text: "{{Session::get('message')}}",
        duration: 5e3,
        icon: tempurl+'assets/images/notifications/cross.png'
      });
    });
  </script>
  {{Session::forget('status'); Session::forget('message');}}
  @endif
  @endif
  @stop
  @section('endjs')
  <script>
    $(function() {
      var calendarCategoryModel = new CalendarCategoryModel();
      var calendarCategoryView = new CalendarCategoryView({
        model: calendarCategoryModel
      });
    });
    $(document).on("click", ".calendarcategory_delete", function() {
      var calendarCategoryId = $(this).attr('calendarcategoryid');
      $('#calendarCategoryId').val(calendarCategoryId);
      $('#myModal-item-delete').modal('show');
    });

    $(document).on("click", ".dontdelete", function() {
      $('#myModal-item-delete').modal('hide');
    });
  </script>
  @stop
