<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Ade Fathi Amirrasyid | eCommerce Template</title>
    <meta charset="utf-8">
    <meta name="keywords" content="divisima, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("bootstrap/css/bootstrap.min.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/font-awesome.min.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/flaticon.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/slicknav.min.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/jquery-ui.min.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/owl.carousel.min.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/animate.css")}}"/>
	<link rel="stylesheet" href="{{asset("bootstrap/css/style.css")}}"/>
</head>
  <body>
    @include('e_commerce_template/layout/v_nav')
    @yield('home')
    @yield('product')
    @yield('contact')
    @yield('category')
    @yield('cart')
    @yield('checkout')
    @yield('footer')

    <!--====== Javascripts & Jquery ======-->
	<script src="{{asset("bootstrap/js/jquery-3.2.1.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/jquery.slicknav.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/owl.carousel.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/jquery.nicescroll.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/jquery.zoom.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/jquery-ui.min.js")}}"></script>
	<script src="{{asset("bootstrap/js/main.js")}}"></script>
  </body>
</html>
