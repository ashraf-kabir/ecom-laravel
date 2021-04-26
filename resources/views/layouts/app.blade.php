<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="frontend/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="frontend/css/animate.css">
    
    <link rel="stylesheet" href="frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="frontend/css/magnific-popup.css">

    <link rel="stylesheet" href="frontend/css/aos.css">

    <link rel="stylesheet" href="frontend/css/ionicons.min.css">

    <link rel="stylesheet" href="frontend/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="frontend/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="frontend/css/flaticon.css">
    <link rel="stylesheet" href="frontend/css/icomoon.css">
    <link rel="stylesheet" href="frontend/css/style.css">
  </head>
  <body class="goto-here">

    {{--start header--}}
    @include('include.header')
    {{--end header--}}

    {{--start content--}}
    @include('include.navbar')
    {{--end content--}}

    {{--start content--}}
    @yield('content')
    {{--end content--}}

    {{--start footer--}}
    @include('include.footer')
    {{--end footer--}}

<script src="frontend/js/jquery.min.js"></script>
<script src="frontend/js/jquery-migrate-3.0.1.min.js"></script>
<script src="frontend/js/popper.min.js"></script>
<script src="frontend/js/bootstrap.min.js"></script>
<script src="frontend/js/jquery.easing.1.3.js"></script>
<script src="frontend/js/jquery.waypoints.min.js"></script>
<script src="frontend/js/jquery.stellar.min.js"></script>
<script src="frontend/js/owl.carousel.min.js"></script>
<script src="frontend/js/jquery.magnific-popup.min.js"></script>
<script src="frontend/js/aos.js"></script>
<script src="frontend/js/jquery.animateNumber.min.js"></script>
<script src="frontend/js/bootstrap-datepicker.js"></script>
<script src="frontend/js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="frontend/js/google-map.js"></script>
<script src="frontend/js/main.js"></script>

@yield('scripts')

</body>
</html>