<!DOCTYPE html>
<html lang="en">

<head>
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifestadmin.json') }}">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('cud/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('cud/img/favicon.png') }}">
    <title>
        Edoc Tracking by U
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('cud/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('cud/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- <script src="{{ asset('font-awesome/js/all.js') }}"></script>
    <link href="{{ asset('font-awesome/css/all.css') }}" rel="stylesheet" /> -->
    <!-- <script src="https://kit.fontawesome.com/947e1d3325.js" crossorigin="anonymous"></script> -->
    <script src="{{asset('fa.js')}}"></script>
    <link href="{{ asset('cud/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('cud/css/corporate-ui-dashboard.css?v=1.0.0') }}" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div id="app"></div>
    @vite('resources/js/admin.js')
    <!--   Core JS Files   -->
    <script src="{{ asset('cud/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('cud/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cud/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('cud/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('cud/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('cud/js/plugins/swiper-bundle.min.js') }}" type="text/javascript"></script>
    <script>
        if (document.getElementsByClassName('mySwiper')) {
            var swiper = new Swiper(".mySwiper", {
                effect: "cards",
                grabCursor: true,
                initialSlide: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        };
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        // Lazy load Font Awesome
        // function loadFontAwesome() {
        //     var fontAwesomeCSS = document.createElement('link');
        //     fontAwesomeCSS.rel = 'stylesheet';
        //     fontAwesomeCSS.href = '{{ asset('font-awesome/css/all.css') }}';
        //     document.head.appendChild(fontAwesomeCSS);

        //     var fontAwesomeJS = document.createElement('script');
        //     fontAwesomeJS.src = '{{ asset('font-awesome/js/all.js') }}';
        //     document.body.appendChild(fontAwesomeJS);
        // }
        // // Load Font Awesome on demand
        // document.addEventListener('DOMContentLoaded', function() {
        //     var fontAwesomeNeeded = false;

        //     // Check if any elements that require Font Awesome are in the viewport
        //     var observer = new IntersectionObserver(function(entries, observer) {
        //         entries.forEach(function(entry) {
        //             if (entry.isIntersecting) {
        //                 fontAwesomeNeeded = true;
        //                 loadFontAwesome();
        //                 observer.disconnect();
        //             }
        //         });
        //     });

        //     // Add selectors for elements that use Font Awesome icons
        //     var elements = document.querySelectorAll('.fa, .fab, .fas');
        //     elements.forEach(function(element) {
        //         observer.observe(element);
        //     });

        //     // Fallback to load Font Awesome after some time if not loaded by observer
        //     setTimeout(function() {
        //         if (!fontAwesomeNeeded) {
        //             loadFontAwesome();
        //         }
        //     }, 3000);
        // });
    </script>
    <script>
        function toggleBodyClass() {
            document.body.classList.toggle('g-sidenav-pinned');
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('cud/js/corporate-ui-dashboard.min.js?v=1.0.0') }}"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>