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
</div>

  <div id="addAppointment" class="modal" style="max-width: 600px;">
    <form action="" id="addClinicForm">
    	<div class="modal-content">
	      <h5>Add Appointment</h5>
	      <div class="row">
	              <div class="row">
	                <div class="input-field">
	                  <select id="addServiceSelectClinic">
	                    <option value="" disabled selected>Choose a clinic</option>
	                    
	                    <!-- <option value="1">Option 1</option>
	                    <option value="2">Option 2</option>
	                    <option value="3">Option 3</option> -->
	                  </select>
	                  <label>Clinic</label>
	                </div>
	              </div>
	      			<div class="row">
				        <div class="input-field">
				          <input id="clinic_address" type="text" class="validate">
				          <label for="clinic_address">Clinic Address</label>
				        </div>
			      	</div>
	      </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat">Cancel</a>
	      <button type="submit" class="modal-action modal-close waves-effect waves-light btn-flat">Submit</button>
	    </div>
    </form>
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
	<script>

		$(document).on('ready', function(){


			//initalize modals
		$('.modal').modal();

		$('select').material_select();

			$('#calendar').fullCalendar({
				header : {
					left : 'agendaDay,agendaWeek,month',
					center : 'title',
					right : ''
				},
				dayClick: function(date, jsEvent, view) {

					console.log(date);

					if(uid){
						$('#addAppointment').modal('open');
					}

			        //alert('Clicked on: ' + date.format()) ex. 2016-11-09;

			        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY) 1012,555;

			        //alert('Current view: ' + view.name) ex. month;

			        // change the day's background color just for fun
			        //$(this).css('background-color', 'red');

			    }
		        // put your options and callbacks here
		    });
		});

	</script>
@endsection