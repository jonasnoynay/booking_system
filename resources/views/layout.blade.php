<html>
<head>
    <title>Booking System - @yield('title')</title>

    <script src="https://www.gstatic.com/firebasejs/3.6.1/firebase.js"></script>
    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyDGiQJynepFHHklFA7pnkY0y43TcsG72r0",
        authDomain: "booking_system.example.com",
        databaseURL: "https://booking-system-78210.firebaseio.com",
        storageBucket: "booking-system-78210.appspot.com",
        messagingSenderId: "1018659616316"
      };
      firebase.initializeApp(config);
    </script>

    @yield('auth-js')


     	<link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">

		@yield('custom-css')

	@yield('nav')
    </head>

	<body>

		@yield('content')
		</body>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
	
	<script>
	$('#signout').on('click', function(){
			firebase.auth().signOut().then(function() {
		  // Sign-out successful.
		}, function(error) {
		  	console.log(error);
		});
	});
	</script>

	@yield('custom-js')
		
	

	</html>