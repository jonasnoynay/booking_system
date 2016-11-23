@extends('layout')


@section('custom-css')
	<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
	<style>
		#calendar table{
			background: #1e88e5;
		    color: #fff;
		    font-size: 16px;
		}
		#calendar thead{
			border:0px;
		}
		#calendar th{
			font-weight: normal;
			padding-top: 1em;
		}
		#calendar td, #calendar th{
			border-style: none;
			
		}

		#calendar .fc-head,
		#calendar .fc-head table{
			background: #1565c0;
		}
		#calendar .fc-state-highlight{
			background: #1976d2;
		}
		#doctor-nav{
			transform: translateX(0px);
		} 
	</style>
@endsection

@section('content')



<div class="row">

<ul id="doctor-nav" class="side-nav">
    <li><div class="userView">
      <div class="background">
        <img src="http://materializecss.com/images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="http://materializecss.com/images/yuna.jpg"></a>
      <a href="#!name"><span class="white-text name"></span></a>
      <a href="#!email"><span class="white-text email"></span></a>
    </div></li>
    <li class="active"><a href="{{ url('dashboard') }}" class="waves-effect">Dashboard</a></li>
    <li><a href="{{ url('clinics') }}" class="waves-effect">Clinics</a></li>
    <li><a href="{{ url('services') }}" class="waves-effect">Services</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">My Account</a></li>
    <li><a class="waves-effect" href="{{ url('profile') }}">My Profile</a></li>
    <li><a class="waves-effect" href="#!" id="sidebar_signout">Sign Out</a></li>
  </ul>
	<div class="col s12" style="padding-left: 300px;">
	@include('navbar')
		<div class="card">
		 	<div class="card-content">
		 		<div id="calendar"></div>
		 	</div>
	      </div>
	</div>

	
   <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
  
    <div class="modal-content">
       <div class="input-field col s12">
	      <select id="clinic">
	      <option value="" disabled selected>Choose Clinic</option>
	      <option value="1">Clinic 1</option>
	      <option value="2">Clinic 2</option>
	      <option value="3">Clinic 3</option>
	    </select>
   		 <label>DENTAL CLINIC</label> 
      </div>

       <div class="input-field col s12">
	      <select id="services">
	      <option value="" disabled selected>Choose Clinic</option>
	      <option value="1">Service 1</option>
	      <option value="2">Service 2</option>
	      <option value="3">Service 3</option>
	    </select>
   		 <label>SERVICES</label> 
      </div>

       	 <div class="input-field col s6">
          <input id="price" type="number" class="validate">
          <label for="price">PRICE</label>
        </div>
        <div class="input-field col s6">
          <input id="duration_time" type="time">
        </div>

       <div class="input-field col s6">
            <span id="day"></span>
        </div>
        <div class="input-field col s6">
          <input id="schedule_time" type="time">
        </div>

        <div class="input-field col s12">
          <textarea id="notes" class="materialize-textarea" required=""></textarea>
          <label for="notes">NOTES</label>
        </div>

    </div>
    <div class="modal-footer">
     <a href="#!" class="waves-effect waves-green btn-flat" id="submit">Submit</a>
       <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a> 
      
    </div>
  </div>
          
  
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
			//initialize modal
			$('.modal').modal();
			//initialize select
			$('select').material_select();
    		// page is now ready, initialize the calendar...
    		console.log(getData());
    		console.log(getFireBaseData());

    		 var events = {
    			title: "Hello Everyone",
    			start: '2016-11-22T12:30:00'
    			//end: '2016-11-22T12:30:00'
    		};    
    		
    		//adding
		   var calendar = $('#calendar').fullCalendar({
	       	header: {
	       		left: 'title',
	       		center: '',
	       		right: 'today,month,agendaDay,agendaWeek prev,next',
	       	},
	        selectable: true,
	        selectHelper: true,
	        editable: true,
	        eventLimit: true,
	        events: getData(),
	        select: function(start, end, jsEvent, view){
	        	 $('#modal1').modal('open');
	        	 //var moment = $('#calendar').fullCalendar('getDate');
	        	 $('#day').text(start.format("MM/DD/YYYY"));
	        	 
	        	 $('#submit').unbind().click(function(){
	        	 	var price, moment, start_value, end_value, notes, clinic, service, duration_time, schedule_time;
	        	 	clinic = $('#clinic option:selected').text();
	        	 	service = $('#services option:selected').text();
	        	 	duration_time = $('#duration_time').val();
	        	 	schedule_time = $('#schedule_time').val();
	        	 	price = $("#price").val();
		        	moment = $('#calendar').fullCalendar('getDate');
		        	//console.log(moment.format());
		        	start_value = start.format("MM/DD/YYYY hh:mm");
		        	notes = $('#notes').val();
		        	end_value = end.format("MM/DD/YYYY");
		        	//CHECK IF THB NOTES IS NULL
		        	if(notes.length == 0) {
		        		console.log("empty");
		        	}
		        	else {
		        		var newEvent = {
			                //start: '2016-11-22T12:30:00',
			                start: start_value,
			                end: end_value,
			                allDay: true,
			                title: notes
			            };
			            $('#calendar').fullCalendar('renderEvent', newEvent,'stick');
			            //ADD TO FIREBASE
			            add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time);
			            clear();
			            $('.modal').modal('close');
		        	}
	        	 });
	        }

	    });

	});
	function clear()
	{
		$('#notes').val('');
	}
	//function for adding in firebase
	function add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time){
		var newBookingValue = firebase.database().ref('booking');
		newBookingValue.push().set({
			price: price,
			start_value: start_value,
			end_value: end_value,
			notes: notes,
			clinic: clinic,
			service: service,
			duration_time: duration_time,
			schedule_time: schedule_time
		});
	}

	function getData() {

			var data =	[
			        {
			            title  : 'event1',
			            start  : '2016-11-22T12:30:00'
			        },
			        {
			            title  : 'event2',
			            start  : '2016-11-23T12:30:00',
			            end    : '2016-11-23T12:30:00'
			        },
			        {
			            title  : 'event3',
			            start  : '2016-11-15T12:30:00',
			            end    : '2016-11-15T12:30:00',
			            allDay : false // will make the time show
			        }
			    ];
			    return data;

			
	}
	function getFireBaseData() {
		var arr = [];
		var bookingRef = firebase.database().ref('booking');
		bookingRef.once('value', function(snapshot) {
			snapshot.forEach(function(childSnapshot){
				//var childKey = childSnapshot.key();
   				 //var clinic = childSnapshot.val().clinic;
   				arr.push({
				        title: childSnapshot.val().notes,
				        start: childSnapshot.val().start_value,
				        end: childSnapshot.val().end_value
				    });
   				 	
   				 //console.log(childData);
			});
		});
		return arr;
	}
	</script>
@endsection