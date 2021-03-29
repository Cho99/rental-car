<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">

<!-- Mirrored from www.ansonika.com/citytours/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Jul 2018 02:32:39 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title>CITY TOURS - City tours and travel site template by Ansonika</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico"
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
  

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('bower_components/car-client-lte') }}/css/skins/square/grey.css" rel="stylesheet">
    <link href="{{ asset('bower_components/car-client-lte') }}/css/date_time_picker.css" rel="stylesheet">

    {{-- <link href="{{ asset('bower_components/car-client-lte') }}/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ asset('bower_components/car-client-lte') }}/css/ion.rangeSlider.skinFlat.css" rel="stylesheet"> --}}

    <link href="{{ asset('bower_components/car-client-lte') }}/css/jquery.switch.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

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
   
    <script src="{{ asset('bower_components/car-client-lte') }}/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('bower_components/car-client-lte') }}/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })

    </script>
    <script src="{{ asset('bower_components/car-client-lte') }}/js/jquery.ddslick.js"></script>
    <script>
        $("select.ddslick").each(function() {
            $(this).ddslick({
                showSelectedHTML: true
            });
        });

    </script>
    {{-- <script type="text/javascript">
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function () {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function (msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        }
        else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script> --}}
    @yield('script')

</body>

<!-- Mirrored from www.ansonika.com/citytours/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Jul 2018 02:32:39 GMT -->

</html>
