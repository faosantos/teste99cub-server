<!doctype html>
<html lang="en">
  <head>
    <title>{{config('app.name')}} | @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/landing/bootstrap.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/landing/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="css/landing/owl.carousel.min.css">
    <!-- Main css -->
    <link href="css/landing/style.css" rel="stylesheet">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body data-spy="scroll" data-target="#navbar" data-offset="30">
    @yield('content')
    <!-- jQuery and Bootstrap -->
    <script src="js/landing/jquery-3.2.1.min.js"></script>
    <script src="js/landing/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/landing/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script src="js/landing/script.js"></script>
    @yield('script')
  </body>
</html>