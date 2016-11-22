@extends('layout')
@section('content')
<div class="row">
			<div class="col s12 l6 card darken-1">
				<div class="col s12">
				<ul class="tabs" style="overflow: hidden;">
					<li class="tab col s6"><a href="#login">LOGIN</a> </li>
					<li class="tab col s6"><a href="#new">NEW USER</a></li>
				</ul>
			</div>
			<div class="col s12">
				<div id="login" class="col s12">
					<form action="" id="sign_in">
						<div class="input-field col s12">
						<input type="text" placeholder="Email Address" id="signin_email" class="validate">
						</div>
						<input type="password" placeholder="Password" id="sign_in_password" class="validate">
						<button type="submit" class="waves-effect waves-light btn">Sign In</button>
					</form>
				</div>
				<div id="new" class="col s12">
					<form action="" id="create">
					<input type="text" placeholder="Fullname" id="create_fullname">
						<input type="text" placeholder="Email Address" id="create_email">
						<input type="password" placeholder="Password" id="create_password">
						<input type="password" placeholder="Confirm Password" id="create_confirm_password">
						<button type="submit" class="waves-effect waves-light btn">Create</button>
					</form>
				</div>
			</div>
			</div>
		</div>
@endsection


@section('custom-js')
	<script>

		$(document).on('ready', function(){


			$('#sign_in').on('submit', function(e){
				e.preventDefault();
				var email_address = $('#signin_email').val();
				var password = $('#sign_in_password').val();

				if(email_address && password){
					firebase.auth().signInWithEmailAndPassword(email_address, password).then(function(user) {
					  window.location.href="/dashboard";
					});
				}

			});

			$('#create').on('submit', function(e){
			e.preventDefault();
			var fullname = $('#create_fullname').val();
			var email_address = $('#create_email').val();
			var password = $('#create_password').val();
			var confirm_password = $('#create_confirm_password').val();
			if(fullname && email_address && password && password == confirm_password){
				firebase.auth().createUserWithEmailAndPassword(email_address, password).then(function(error) {

				var user = firebase.auth().currentUser;
				console.log(user);
					user.updateProfile({
						  displayName: fullname
						}).then(function() {
						  window.location.href="/dashboard";
						}, function(error) {
						  console.log(error);
						});
				}, function(error){
					console.log(error);
				});
			}


			});

		});
	</script>

@endsection
