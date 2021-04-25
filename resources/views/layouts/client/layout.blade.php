<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description"
        content="Retal Car - Premium site.">
    <meta name="author" content="Dog">
    <title>Rental Car - Quang Anh Car</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('bower_components/car-client-lte') }}/img/favicon.ico"
        type="{{ asset('bower_components/car-client-lte') }}/image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('bower_components/car-client-lte') }}/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('bower_components/car-client-lte') }}/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('bower_components/car-client-lte') }}/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('bower_components/car-client-lte') }}/img/apple-touch-icon-144x144-precomposed.png">

    <!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i"
        rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('bower_components/car-client-lte') }}/css/base.css" rel="stylesheet">
    
    @yield('css')

    {{-- my css --}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->
   
    <!-- Header================================================== -->
    @include('layouts.client.header')
    <!-- End Header -->

    {{-- Main --}}
    @yield('content')
    <!-- End main -->

    @include('layouts.client.footer')
    <!-- End footer -->

    <div id="toTop"></div>
    <!-- Back to top button -->

    <!-- Search Menu -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_set_1_icon-78"></i>
            </button>
        </form>
    </div>
    <!-- End Search Menu -->

    <!-- Common scripts -->
    <script src="{{ asset('bower_components/car-client-lte') }}/js/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('bower_components/car-client-lte') }}/js/common_scripts_min.js"></script>
    <script src="{{ asset('bower_components/car-client-lte') }}/js/functions.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>

    @yield('script')
</body>

</html>
