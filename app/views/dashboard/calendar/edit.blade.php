@extends('dashboard.default')
@section('head')
<title>92five app - Edit Event</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">{{trans('92five.Dashboard')}}<a> / <a href="{{url('/dashboard/calendar')}}">{{trans('92five.Calendar')}}</a> /{{trans('92five.editEvent')}}</h2>
        <div class="row-fluid proj_create">
          <form class="" action='' method='post' id="editevent" data-validate="parsley">
            <h3><input type="text" name="title" id="title" class="proj_create_in" value="{{$event[0]['title']}}" placeholder="Event Name (required)" data-required="true" data-show-errors="false"></h3>
            <div class="row-fluid span12 proj_create_detail">
              <div class="row-fluid">
                <!-- Left Part -->
                <div class="span6 add-proj-form">
                  <fieldset>
                    <div class="control-group">
                      <input id="date" name="date" type="text" class="span12 pull-left" value="{{new ExpressiveDate($event[0]['date'])}}" placeholder="When" data-required="true" data-show-errors="false">
                      <div  id="timeselect">
                      <input id="starttime" name="starttime" type="text" class="span6 pull-left" value="{{date('g:iA', strtotime($event[0]['start_time']))}}" placeholder="From" data-required="true" data-show-errors="false"> -
                      <input id="endtime" name="endtime" type="text" class="span6 pull-right" value="{{date('g:iA', strtotime($event[0]['end_time']))}}" placeholder="Till" data-required="true" data-show-errors="false">
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="allday">All day event?</label>
                      <input type="hidden" name="allday" value="0"/>
                      @if ( $event[0]['allday'] == true )
                        <input id="allday" name="allday" type="checkbox" checked="checked" />
                      @else
                        <input id="allday" name="allday" type="checkbox" />
                      @endif
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="passwordinput">Category:</label>
                      <div class="controls">
                        <div class="task_select">
                          {{ Form::select('calendar_category_id', \CalendarCategory::select(), $event[0]['calendar_category_id'], array( "tabindex" =>"1", "style" => "width:270px;", "data-required" => "true", "data-show-errors" => "false")) }}
                        </div>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="note">Note:</label>
                      <div class="controls">
                        <textarea  name="note" id="note" class="add-proj-form-t" placeholder="Note">{{$event[0]['notes']}}</textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="location">Location:</label>
                      <div class="controls">
                        <input type="text" value="{{$event[0]['location']}}" placeholder="Location" name="location" id="location">
                      </div>
                    </div>
                  </fieldset>
                </div>
                <!-- Right Part -->
                <div class="span5 add_proj_right add-proj-form">
                  <div class="control-group col">
                    <label class="control-label" for="passwordinput">People:<span class="tooltipster-icon" title="To add the people start typing the name and select the appropriate user from the list. Please note that only those name will appear in list who are registered in the app. Please add your name as well if you are one of them.">(?)</span></label>
                    <div class="controls">
                      <div class="span12 flatui-detail">
                        <input id="plugin" name="passwordinput" type="text" placeholder="Add Name">
                      </div>
                      <div id="selected">
                        <ul id="list">
                          @foreach($event['users'] as $user)
                          <li id="userlist" class="userlist" email={{$user['email']}} >{{$user['first_name'].' '.$user['last_name']}} <a class="removeme" id="removeme" href="#">X</a></li>
                          @endforeach
                        </ul>
                        <input style="display: none;" name="tagsinput" id="tagsinput" class="tagsinput" placeholder="Add Name" value="{{$emaillist}}" />
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="submit_button_main"><button class="submit">Update</a></button></div>
              </div>
            </div>
            <input type="hidden" id="eventid" name="eventid" value="{{$event[0]['id']}}" />
          </form>
        </div>
      </div>
    </div>
  </div>
  @stop
  @section('endjs')
<script>
 $(document).on("click", ".removeme", function() {
   var email = $(this).parent('li').attr('email');
   var emaillist = $('#tagsinput').val();
   newemaillist = $.grep(emaillist.split(','), function(v) {
     return v != email;
   }).join(',');
   $(this).parent().remove();
   $('#tagsinput').val(newemaillist);
 });
 $("#editevent").submit(function(e) {
   if ($("#tagsinput").val() == "") {
     alert('Atleast add one Collaborator');
     e.preventDefault();
   }
 });
 $(document).ready(function() {
   $('.tooltipster-icon').tooltipster();
   check_allday();
 });
</script>
{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::style('assets/css/dashboard/backbone.autocomplete.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::style('assets/css/dashboard/jqtransform.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/dashboard/backbone.autocomplete.js') }}
{{ HTML::script('assets/js/dashboard/userlist.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/jquery/jquery.jqtransform.js') }}
{{ HTML::script('assets/js/dashboard/picker.time.js') }}
<script>
 $('#date').pickadate({
   formatSubmit: 'yyyy-mm-dd'
 });

 var check_allday = function() {
   if( $('#allday').is(':checked')) {
     $('#timeselect').hide();
     $('#starttime').data('required', 'false');
     $('#endtime').data('required', 'false');
   } else {
     $('#timeselect').show();
     $('#starttime').data('required', 'true');
     $('#endtime').data('required', 'true');
   }
 }

 $('#allday').change(function(){
   check_allday();
 });

 var from_$input = $('#starttime').pickatime({
   min: [7, 00],
   max: [21, 0],
   formatSubmit: 'HH:i',
   formatLabel: function(timeObject) {
     return '<b>h</b>:i <!i>a</!i>';
   }
 });
 var from_picker = from_$input.pickatime('picker');
 var to_$input = $('#endtime').pickatime({
   min: [7, 00],
   max: [21, 0],
   formatSubmit: 'HH:i',
   formatLabel: function(timeObject) {
     var minObject = this.get('min');

     var hours = timeObject.hour - minObject.hour;
     var mins = (timeObject.mins - minObject.mins) / 60;
     pluralize = function(number, word) {
       return number + ' ' + (number === 1 ? word : word + 's');
     }
     return '<b>h</b>:i <!i>a</!i> <sm!all>(' + pluralize(hours + mins, '!hour') + ')</sm!all>';
   }
 });
 var to_picker = to_$input.pickatime('picker');
 if (from_picker.get('value')) {
   to_picker.set('min', from_picker.get('select'));
 }
 if (to_picker.get('value')) {
   from_picker.set('max', to_picker.get('select'));
 }
 from_picker.on('set', function(event) {
   if (event.select) {
     to_picker.set('min', from_picker.get('select'));
   }
 });
 to_picker.on('set', function(event) {
   if (event.select) {
     from_picker.set('max', to_picker.get('select'));
   }
 });
</script>
@stop
