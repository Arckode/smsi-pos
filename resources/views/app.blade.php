<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Koperasi Nusa Sejahtera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" /> --}}
    {{-- <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" /> --}}
    {{-- <meta name="author" content="FREEHTML5.CO" /> --}}


    <!-- Facebook and Twitter integration -->
    {{-- <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" /> --}}

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico" />

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('hp/css/animate.css') }}" />
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('hp/css/icomoon.css') }}" />
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('hp/css/bootstrap.css') }}" />

    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('hp/css/flexslider.css') }}" />
    <link rel="stylesheet" href="{{ asset('hp/css/style.css') }}" />

    <!-- Modernizr JS -->
    <script src="{{ asset('hp/js/modernizr-2.6.2.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('hp/css/uikit.min.css') }}" />
    <script src="{{ asset('hp/js/uikit.min.js') }}"></script>
    <script src="{{ asset('hp/js/uikit-icons.min.js') }}"></script>

    @vite('resources/css/app.css')
</head>

<body>
    <div id="app"></div>
    @vite('resources/js/app.js')

    <!-- jQuery -->
    <script src="{{ asset('hp/js/jquery.min.js') }}"></script>
    <!-- jQuery Easing -->
    <script src="{{ asset('hp/js/jquery.easing.1.3.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('hp/js/bootstrap.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('hp/js/jquery.waypoints.min.js') }}"></script>
    <!-- Counters -->
    <script src="{{ asset('hp/js/jquery.countTo.js') }}"></script>
    <!-- Flexslider -->
    <script src="{{ asset('hp/js/jquery.flexslider-min.js') }}"></script>

    <!-- Main JS (Do not remove) -->
    <script src="{{ asset('hp/js/main.js') }}"></script>
</body>

</html>
