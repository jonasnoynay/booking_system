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
       <div class="input-field col s12" id="input-clinics">
	      <select id="clinic">
	      <option value="" disabled selected>Choose Clinic</option>
	      <option value="1">Clinic 1</option>
	      <option value="2">Clinic 2</option>
	      <option value="3">Clinic 3</option>
	    </select>
   		 <label>DENTAL CLINIC</label> 
      </div>

       <div class="input-field col s12" id="input-services">
	      <select id="services">
	      <option value="" disabled selected>Choose Services</option>
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
         <!--  <label for="price">PRICE</label> -->
        </div>
        <span id="schedule_error"></span>
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
     <a href="#!" class="waves-effect waves-green btn-flat" id="btn_cancel">Cancel</a> 
     <a href="#!" class="waves-effect waves-green btn-flat" id="delete">Delete</a> 
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
	<script type="text/javascript" src="{{ asset('js/booking.js') }}"></script>
	
@endsection