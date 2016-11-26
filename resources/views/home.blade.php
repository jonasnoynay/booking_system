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
	
		#calendar .fc-toolbar{
			background: #1565c0;
		    padding-bottom: 1em;
		    margin: 0;
		    color: #fff;
		}

		#calendar .fc-toolbar .fc-button-group button{
			background: #1565c0;
		    border: 0;
		    color: #fff;
		    text-transform: uppercase;
		    border-right: 2px solid #fff;
		    border-radius: 0;
		    height: 30px;
		    box-shadow : none;
		}

		#calendar .fc-toolbar .fc-left{
			width: 100%;
		}

		#calendar .fc-toolbar h2{
			font-size: 36px;
		}

		#doctor-nav{
			transform: translateX(0px);
		} 
	</style>
@endsection

@section('content')



<div class="row">
@include('home-navbar')
<div id="calendar"></div>

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

var uid = null;
		firebase.auth().onAuthStateChanged(function(user) {
	  if (user) {
	  	/*$('#user_name').text(user.displayName);
		$('#user_email').text(user.email);*/
		$('#user_signout').text(user.displayName);

		uid = user.uid;

		/*if(user.photoURL){
          storageRef.child(user.photoURL).getDownloadURL().then(function(url){
              if(url){
                  $('#profilePic').attr('src', url);
                }
          }).catch(function(error){
              console.log(error);
            });
          }*/

	  }
	});
</script>
@endsection

@section('custom-js')
	<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/fullcalendar.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/booking.js') }}"></script>
	
@endsection