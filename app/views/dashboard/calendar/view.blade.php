@extends('dashboard.default')
@section('head')
<title>92five app - Calendar</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">{{trans('92five.Dashboard')}}</a> / {{trans('92five.Calendar')}}</h2>
        <div class="add_project_main">
          <a data-toggle="modal" href="{{url('/dashboard/calendar/event/createdbyme')}}" class="add_project pull-right"> Events Created by Me</a>
          <a data-toggle="modal" href="#myModal" class="add_project add-last"> + Add Event</a>
        </div>
        <!-- Calendar Detail -->
        <div class="row-fluid cal_detail">
          <!-- Cal Left -->
          <div class="span5 cal_left">
            <div class="row-fluid">
              <div class="cal_date" id="cal_date">{{$todaysDate->format('j')}}</div>
              <div class="cal_month" id="cal_month">{{$todaysDate->format('F')}}</div>
              <div class="cal_month" style="margin:0px;" id="cal_year">{{$todaysDate->format('Y')}}</div>
            </div>
            <div class="time_listing" id="time_listing">
              @if(sizeof($events) != 0)
              @foreach($events as $event)
              <div class="row-fluid">
                <div class="span5 time_listing_1">
                  @if($event['allday'])
                    allday
                  @else
                    {{date('g:ia', strtotime($event['start_time']))}} - {{date('g:ia', strtotime($event['end_time']))}}
                  @endif
                </div>

                <div class="span7 time_listing_1"><a data-toggle="modal" class="cal_event_title"  data-placement="right"  eventid={{$event['id']}} href="#myModal4">{{$event['title']}}</a></div>
              </div>
              <div class="calender-viewevent hide">
                @if($event['editdelete'] == 'yes')
                <div class="p-icon-inner"><a class="p-icon-1" title="Edit Event" href="{{url('/dashboard/calendar/event/edit',array($event['id']))}}"><img alt="" src="{{asset('assets/images/dashboard/p-edit.png')}}"></a><a class="p-icon-1 delevent" title="Delete Event" eventid={{$event['id']}} href="#"><img alt="" class="delevent" eventid={{$event['id']}} src="{{asset('assets/images/dashboard/p-delete.png')}}"></a></div>
                @endif
                <div class="viewevent-detail-inner">
                  <!-- Left -->
                  <div class="viewevent-left">
                    <div class="viewevent-detail-1">Category:<span class="viewevent-note"> {{$event['category']}}</span></div>
                    <div class="viewevent-detail-1">Note: <span class="viewevent-note"> {{$event['notes']}}</span></div>
                    <div class="viewevent-detail-1">Location: <span class="viewevent-note"> {{$event['location']}}</span></div>
                  </div>
                  <!-- Right -->
                  <div class="viewevent-right">
                    <div class="viewevent-asignee">
                      <label>People:</label>
                      <div class="viewevent-asignee-right">
                        @foreach($event['users'] as $user)
                        <div class="viewevent-detail-3">{{$user['first_name']}} {{$user['last_name']}}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              @else
              <div class="row-fluid">
                <div class="span12 time_listing_1"> [ Nothing Scheduled !]</div>
              </div>
              @endif
            </div>
          </div>
          <!-- Cal Right -->
          <div class="span7 cal_right cal2">
            <script type="text/template" id="template-calendar">
              <div class="cal_year"><%= year %></div>
            <div class="calender_sec">
                <div class="cal_detail_2">
                  <div class="cal_next clndr-previous-button"><img src="{{asset('assets/images/dashboard/cal_l.png')}}" alt=""></div>
                <div class="cal_month_2"><p><%= month %></p></div>
                <div class="cal_prav clndr-next-button"><img src="{{asset('assets/images/dashboard/cal_r.png')}}" alt=""></div>
              </div>
              <div class="cal_detail_3">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <% _.each(daysOfTheWeek, function(day) { %>
                    <td ><%= day %></td>
                    <% }); %>
                  </tr>
                  <% for(var i = 0; i < numberOfRows; i++){ %>
                  <tr>
                    <% for(var j = 0; j < 7; j++){ %>
                    <% var d = j + i * 7; %>
                    <td class='<%= days[d].classes %>'><div class='day-contents'><%= days[d].day %>
                    </div></td>
                    <% } %>
                  </tr>
                  <% } %>
                </table>
              </div>
            </div>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('dashboard/calendar/shared/add_event')
@include('dashboard/calendar/shared/delete_event')

@if(Session::has('status') and Session::has('message') )
@if(Session::has('status') == 'success')
<script>
$(document).ready( function() {
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
 $(document).on("click", ".removeme", function() {

   var email = $(this).parent('li').attr('email');
   var emaillist = $('#tagsinput').val();
   newemaillist = $.grep(emaillist.split(','), function(v) {
     return v != email;
   }).join(',');

   $(this).parent().remove();
   $('#tagsinput').val(newemaillist);
 });
 $(document).on("click", ".dontdelete", function() {

   $('#myModal-item-delete').modal('hide');
 });
 $("#addevent").submit(function(e) {
   if ($("#tagsinput").val() == '') {
     alert('Atleast add one Collaborator');
     e.preventDefault();
   }
$('.tooltipster-icon').tooltipster();
 });
</script>
{{ HTML::script('assets/js/dashboard/moment.min.js') }}
{{ HTML::script('assets/js/dashboard/clndr.js') }}
<script>
var calendars = {};
$(document).ready(function() {

  calendars.clndr2 = $('.cal2').clndr({
    template: $('#template-calendar').html(),
    daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    events: {{$eventDates}},
    clickEvents: {
      click: function(e) {
        // console.log($(e.element).hasClass("event"));
        if ($(e.element).hasClass("event"))
        {
          var tempclass = $(e.element).attr("class");
          var finaldate = tempclass.split('day-')[1];
          var eventsModel = new EventsList([], {
            selectedDate: finaldate
          });
          var eventsView = new EventsListView({
            collection: eventsModel
          });
          eventsView.render();

        } else
        {

          //User has clicked a day in which no event is there
          // Hence do nothing
        }
      }
    }
  });

  $("#advanced-inputs").hide();
  $('#adv').click(function() {
    $("#advanced-inputs").slideToggle();
  });
  $('#date').pickadate({
    formatSubmit: 'yyyy-mm-dd'
  });
});
</script>

{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::style('assets/css/dashboard/backbone.autocomplete.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/dashboard/picker.time.js') }}
{{ HTML::script('assets/js/dashboard/backbone.autocomplete.js') }}
{{ HTML::script('assets/js/dashboard/userlist.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/dashboard/calendar.js') }}
  <script>
$(function() {
  var eventModel = new EventModel();
  var eventview = new EventView({
    model: eventModel
  });
});
</script>
<script>
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

</script>
  @stop
