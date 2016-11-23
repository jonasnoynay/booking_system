@extends('layout')


@section('nav')
	@include('navbar')
@endsection

@section('custom-css')
	<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
@endsection

<style>
	.centered
	{
		text-align: center;
	}
</style>
@section('content')

<div class="row">
	 <div class="card col s3">
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
</div>
	<div class="col s9">
		<div class="card">
		 	<div class="card-content">
		 		<div id="calendar"></div>
		 	</div>
	      </div>
	</div>

	<!-- <div id="calEventDialog">
    <form>
        <fieldset>
        <label for="eventTitle">Title</label>
        <input type="text" name="eventTitle" id="eventTitle" /><br>
        <label for="eventStart">Start Date</label>
        <input type="text" name="eventStart" id="eventStart" /><br>
        <label for="eventEnd">End Date</label>
        <input type="text" name="eventEnd" id="eventEnd" /><br>
        <input type="radio" id="allday" name="allday" value="1">
        Half Day
        <input type="radio" id="allday" name="allday" value="2">
        All Day
        </fieldset>
    </form>
</div> -->

</div>

@endsection


@section('auth-js')

<script async="true">
		firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
	  	// User is signed in
	  }else{
	  	window.location.href="/";
	  }

	});
</script>
@endsection

@section('custom-js')
	<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/fullcalendar.min.js') }}"></script>
	<script>
		$(document).ready(function() {

    // page is now ready, initialize the calendar...

	   var calendar = $('#calendar').fullCalendar({
       	header: {
       		left: 'title',
       		center: '',
       		right: 'today,month,agendaDay,agendaWeek prev,next',
       	},
        selectable: true,
        select: function(start, end, jsEvent, view){
        	//alert(start.format("MM/DD/YYYY hh:mm a")+" to "+end.format("MM/DD/YYYY h\19h:mm a")+" in view "+view.name);
        	var title = prompt("Enter a title for this event", "New event");
        	if(title != null) {
        		//create event
        		var event = {
        			title: title.trim() != "" ? title : "New event",
        			start: start,
        			end: end
        		};
        	};
        	 //calendar.fullcalendar("renderEvent", event, true);
        }
    });

	});
	</script>
@endsection