@extends('layout')


@section('custom-css')
	<link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
	<style>
	/*	#calendar table{
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
		} */
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
      	<div class="inupt-field col s12">
      	<p>
	      <input type="checkbox" id="allDay" />
	      <label for="allDay">All Day</label>
	    </p>
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
    <div class="modal-footer bottom-button">
     <a href="#!" class="waves-effect waves-green btn-flat" id="submit">Submit</a>
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a> 
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat " id="delete">Delete</a> 
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
	var test_var;
	var data = [];
	var calendar;
		$(document).ready(function() {
			//initialize modal
			$('.modal').modal();
			//initialize select
			$('select').material_select();
    		// page is now ready, initialize the calendar...
    		 checkDataIsEmpty();
    	
    		//getFireBaseData();
		 
	});
	function clear()
	{
		$('#notes').val('');
		$('#duration_time').val('');
		$('#schedule_time').val('');
		$("#price").val('');
	}
	//function for adding in firebase
	function add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time){
		//console.log(price+" "+start_value+" "+end_value+" "+notes+" "+clinic+" "+service+" "+duration_time+" "+schedule_time);
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
		//var newKey = newBookingValue.push().key;
		//return newKey;

		console.log(newBookingValue.key);
		 /*var newPostKey = firebase.database().ref().child('posts').push().key;*/
	}
	function checkDataIsEmpty() {
		var newBookingValue = firebase.database().ref('booking');
		newBookingValue.on("value", function(snapshot){
			console.log("check data");
			console.log(snapshot.val());
			if(snapshot.val() == null) {
				console.log("empty");
				initialFullCalendar();
			}
			else {
				console.log("Note Empty");
				 getFireBaseData();
			}
		});
	}
	function initialFullCalendar() {
				var calendar = $('#calendar');
				calendar.fullCalendar({
						selectable: true,
				        selectHelper: true,
				        editable: true,
				        eventLimit: true,
				        select: function(start, end, jsEvent, view){
				        	 $('#modal1').modal('open');
				        	 //var moment = $('#calendar').fullCalendar('getDate');
				        	 $('#delete').hide();
				        	 $('#day').text(start.format("MM/DD/YYYY"));

				        	 $('#submit').unbind().click(function(){
				        	 	var price, moment, start_value, end_value, notes, clinic, service, duration_time, schedule_time, allDay;
				        	 	clinic = $('#clinic option:selected').text();
				        	 	service = $('#services option:selected').text();
				        	 	duration_time = $('#duration_time').val();
				        	 	schedule_time = $('#schedule_time').val();
				        	 	price = $("#price").val();
					        	moment = $('#calendar').fullCalendar('getDate');
					        	allDay = $('#allDay').val();
					        	//variable for all day
					        	//console.log(allDay);
					        	//console.log(start.format()+"T"+duration_time);
					        	var start_date = start.format()+"T"+duration_time;
					        	//START VALUE SETTING TIME
					        	//start_value = start.format("MM/DD/YYYY hh:mm");
					        	start_value = start.format("MM/DD/YYYY "+duration_time);
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
						                allDay: false,
						                title: notes,
						                clinic: clinic,
						                service: service,
						                duration_time: duration_time,
						                schedule_time: schedule_time,
						                price: price
						            };
						            $('#calendar').fullCalendar('renderEvent', newEvent,true);
						            //ADD TO FIREBASE
						            add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time);
						            clear();
						            $('.modal').modal('close');
					        	}
				        	 });
				        }
    		});
	}
	function getFireBaseData() {
		var bookingRef = firebase.database().ref('booking');
		bookingRef.once('value', settingData);
	}

	function settingData(snapshot) {
		var childSize = snapshot.numChildren();
			var booking_data = [];
			snapshot.forEach(function(childSnapshot){
				//console.log(childSnapshot.val().start_value+"T"+childSnapshot.val().duration_time);
				//var start_date = childSnapshot.val().start_value+"T"+childSnapshot.val().duration_time
   				booking_data.push({
				        title: childSnapshot.val().notes,
				        start: childSnapshot.val().start_value,
				        end: childSnapshot.val().end_value,
				        clinic: childSnapshot.val().clinic,
		                service: childSnapshot.val().service,
		                duration_time: childSnapshot.val().duration_time,
		                schedule_time: childSnapshot.val().schedule_time,
		                price: childSnapshot.val().price,
		                id: childSnapshot.key
				    });
   				
   				if(booking_data.length == childSize) {
   					//setting the data from firebase
   					var calendar = $('#calendar');
   					  calendar.fullCalendar({
				       	header: {
				       		left: 'title',
				       		center: '',
				       		right: 'today,month,agendaDay,agendaWeek prev,next',
				       	},
				        selectable: true,
				        selectHelper: true,
				        editable: true,
				        eventLimit: true,
				        events: booking_data,
				        select: function(start, end, jsEvent, view){
				        	 $('#modal1').modal('open');
				        	 //var moment = $('#calendar').fullCalendar('getDate');
				        	 $('#delete').hide();
				        	 $('#day').text(start.format("MM/DD/YYYY"));

				        	 $('#submit').unbind().click(function(){
				        	 	var price, moment, start_value, end_value, notes, clinic, service, duration_time, schedule_time, allDay, currentKey;
				        	 	clinic = $('#clinic option:selected').text();
				        	 	service = $('#services option:selected').text();
				        	 	duration_time = $('#duration_time').val();
				        	 	schedule_time = $('#schedule_time').val();
				        	 	price = $("#price").val();
					        	moment = $('#calendar').fullCalendar('getDate');
					        	allDay = $('#allDay').val();
					        	//variable for all day
					        	//console.log(allDay);
					        	//console.log(start.format()+"T"+duration_time);
					        	var start_date = start.format()+"T"+duration_time;
					        	//START VALUE SETTING TIME
					        	//start_value = start.format("MM/DD/YYYY hh:mm");
					        	start_value = start.format("MM/DD/YYYY "+duration_time);
					        	notes = $('#notes').val();
					        	end_value = end.format("MM/DD/YYYY");
					        	//CHECK IF THB NOTES IS NULL
					        	if(notes.length == 0) {
					        		console.log("empty");
					        	}
					        	else {
					        		//currentKey = add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time);
					        		//console.log("current key"+currentKey);
					        		var newEvent = {
						                //start: '2016-11-22T12:30:00',
						                start: start_value,
						                end: end_value,
						                allDay: false,
						                title: notes,
						                clinic: clinic,
						                service: service,
						                duration_time: duration_time,
						                schedule_time: schedule_time,
						                price: price,
						                //id: currentKey
						            };
						            $('#calendar').fullCalendar('renderEvent', newEvent,true);
						            //ADD TO FIREBASE
						          	add(price, start_value, end_value, notes, clinic, service, duration_time, schedule_time);
						            clear();
						            $('.modal').modal('close');
					        	}
				        	 });
				        },
				        editable: true,
				        eventDrop : function(event, delta, revertFunc) {				
				        	if (!confirm("Are you sure about this change?")) {
				        		revertFunc();
					        }
					        else {
					        	//console.log(event.id);
					        	//console.log(event.title+" "+event.start.format()+" "+event.end.format(), event.clinic +" "+event.service, event.duration_time);
					        	//calling the function revertChanges to update the position
					        	revertChanges(event.id, event.title, event.start.format("MM/DD/YYYY "+event.duration_time), event.end.format(), event.clinic, event.service, event.duration_time, event.schedule_time, event.price);
					        }
				        },
				        //update or remove
				        eventClick: function(event, jsEvent, view, revertFunc) {
				        	/*console.log(event._id);*/
				        	//console.log(event.title +" "+ event.clinic+" "+event.service);
				        	$('#modal1').modal('open');
				        	//SET THE TAG IN MODAL
				        	$('#delete').show();
				        	$('#notes').val(event.title);
							$('#duration_time').val(event.duration_time);
							$('#schedule_time').val(event.schedule_time);
							$("#price").val(event.price);
							//NEED TO MODIFY
							//$('#clinic option:selected').text(2);
				        	//$('#services option:selected').text(2);
				        	//DELETE FUNCTION
				        	$('#delete').on('click', function() {
				        		$('#calendar').fullCalendar('removeEvents', event._id);
				        		clear();
				        		//CONFIRM FOR DELETING
				        		/*if (!confirm("Are you sure about this change?")) {
					        			revertFunc();
							        }
							        else {
						        	$('#calendar').fullCalendar('removeEvents', event._id);
					        		clear();
						        }*/
						        removeData(event.id, event.title);
				        		
				        	});



				        }

				    });

   				}
			});
			
	}
	//function to update in firebase
	function revertChanges(id, title, start, end, clinic, service, duration_time, schedule_time, price) {
		//console.log(title+" "+start+" "+end + " " +clinic +" "+service +" " +duration_time);
		console.log("calling me!");
		/*var bookingRef = firebase.database().ref('booking').child(id);
		var data = {
				price: price,
				start_value: start,
				end_value: end,
				notes: title,
				clinic: clinic,
				service: service,
				duration_time: duration_time,
				schedule_time: schedule_time
			};
		bookingRef.update(data);*/
		var bookingRef = firebase.database().ref('booking');
		bookingRef.orderByChild("notes").equalTo(title).on('child_added', function(snapshot){
			//console.log(snapshot.key);
			var data = {
				price: price,
				start_value: start,
				end_value: end,
				notes: title,
				clinic: clinic,
				service: service,
				duration_time: duration_time,
				schedule_time: schedule_time
			};
			//console.log(data);
			//update firebase
			var bookingUpdateRef = firebase.database().ref('booking').child(snapshot.key);
			bookingUpdateRef.update(data);
		});
	}
	//function for remove
	//need changes
	function removeData(id, title) {
		if(id == null) {
			console.log("search");
			console.log(id+" "+title);
		}
		else {
			console.log("delete");
			console.log(id+" "+title);
			var bookingUpdateRef = firebase.database().ref('booking').child(id);
			bookingUpdateRef.update(null);
		}
	}
	</script>
@endsection