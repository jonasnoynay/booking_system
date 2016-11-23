<html>
<head>
    <title>Booking System - @yield('title')</title>

    
<script src="https://www.gstatic.com/firebasejs/3.6.1/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyATaM_gG4MxfpNxPHcJ0J1V8o7oh2Di7_A",
    authDomain: "laravel-firebase-dd443.firebaseapp.com",
    databaseURL: "https://laravel-firebase-dd443.firebaseio.com",
    storageBucket: "laravel-firebase-dd443.appspot.com",
    messagingSenderId: "213828532935"
  };
  firebase.initializeApp(config);
</script>

    @yield('auth-js')


     	<link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">

		@yield('custom-css')

	
    </head>

	<body>
		@yield('nav')
		@yield('content')
		</body>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
	
	<script>
	$('#signout, #sidebar_signout').on('click', function(){
			firebase.auth().signOut().then(function() {
		  // Sign-out successful.
		}, function(error) {
		  	console.log(error);
		});
	});
	</script>

	@yield('custom-js')
		
	

	</html>