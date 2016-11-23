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

		/* #calendar .fc-day:hover{
			background:#0d47a1;
		} */
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
@include('navbar')
<ul id="doctor-nav" class="side-nav fixed">
    <li><div class="userView">
      <div class="background">
        <img src="http://materializecss.com/images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="http://materializecss.com/images/yuna.jpg"></a>
      <a href="#!name"><span class="white-text name" id="user_name"></span></a>
      <a href="#!email"><span class="white-text email" id="user_email"></span></a>
    </div></li>
    <li class="active"><a href="{{ url('dashboard') }}" class="waves-effect">Dashboard</a></li>
    <li><a href="{{ url('clinics') }}" class="waves-effect">Clinics</a></li>
    <li><a href="{{ url('services') }}" class="waves-effect">Services</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">My Account</a></li>
    <li><a class="waves-effect" href="{{ url('profile') }}">My Profile</a></li>
    <li><a class="waves-effect" href="#!" id="sidebar_signout">Sign Out</a></li>
  </ul>
	<div class="col s12" id="main-panel">

		<div class="card">
		 	<div class="card-content">
		 		<div id="calendar"></div>
		 	</div>
	      </div>
	</div>

</div>

@endsection


@section('auth-js')

<script async="true">
		firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
	  	$('#user_name').text(user.displayName);
		$('#user_email').text(user.email);
		$('#user_signout').text(user.displayName);
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

			$('#user_signout').dropdown({
		      inDuration: 300,
		      outDuration: 225,
		      constrain_width: true, // Does not change width of dropdown to that of the activato
		      gutter: 0, // Spacing from edge
		      belowOrigin: true, // Displays dropdown below the button
		      alignment: 'left' // Displays dropdown with edge aligned to the left of button
		    });

    // page is now ready, initialize the calendar...

	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
	    });

	});
	</script>
@endsection