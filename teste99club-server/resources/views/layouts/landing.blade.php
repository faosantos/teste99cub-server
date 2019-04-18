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
    </head>
    <body data-spy="scroll" data-target="#navbar" data-offset="30">
        <div class="nav-menu fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-dark navbar-expand-lg">
                            <a class="navbar-brand" href="/">
                                <img src="images/logo.png" height="17" width="103" class="img-fluid" alt="logo">
                            </a> 
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                            <div class="collapse navbar-collapse" id="navbar">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#home"> COMEÇAR <span class="sr-only">(current)</span></a> 
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#features">SOBRE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#gallery">GALERIA</a>
                                    </li>
                                    <!--li class="nav-item"> 
                                        <a class="nav-link" href="#pricing">PREÇOS</a>
                                    </li-->
                                    <!--li class="nav-item">
                                        <a class="nav-link" href="#contact">CONTACT</a>
                                    </li-->
                                    <li class="nav-item">
                                        <a href="#download" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Download</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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
