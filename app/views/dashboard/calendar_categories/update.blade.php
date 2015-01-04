@extends('dashboard.default')
@section('head')
<title>92five app - Update Category</title>
@stop

@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">Dashboard</a>/ <a href="{{url('/dashboard/admin')}}">Admin</a> / <a href="{{url('/dashboard/admin/calendar_categories')}}">Update Categories</a> / Update</h2>

        <form class="form-horizontal" method="post" data-validate="parsley">
          <div class="row-fluid change_email edit_user_sec">

            @include('dashboard/calendar_categories/shared/form')
            <div class="span12">
              <button class="submit pull-left">Update</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@stop
@section('endjs')
  {{ HTML::script('assets/js/simplelogin/parsley.js') }}
  {{ HTML::style('assets/css/simplelogin/parsley.css') }}
@stop
