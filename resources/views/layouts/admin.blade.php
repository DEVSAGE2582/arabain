<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admiro admin is super flexible, powerful, clean & modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>@yield('title')</title>
    <!-- Favicon icon-->
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="css/flag-icon.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="css/iconly-icon.css">
    <link rel="stylesheet" href="css/bulk-style.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="css/themify.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="css/fontawesome-min.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
    <link rel="stylesheet" type="text/css" href="css/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <!-- App css -->
    <link id="color" rel="stylesheet" href="css/color-1.css" media="screen">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts.partials.header')

        <div class="page-body-wrapper">
            
            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.partials.sidebar')
            <!-- Left Sidebar End -->

            <!-- =============================Main Content================================= -->
            @yield('content')

            <!-- Footer Start -->
            @include('layouts.partials.footer')
        </div>
    </div>

    @stack('js')

    <!-- jquery-->
    <script src="js/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="../assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="js/popper.min.js" defer=""></script>
    <!--fontawesome-->
    <script src="js/fontawesome-min.js"></script>
    <!-- feather-->
    <script src="js/feather.min.js"></script>
    <script src="js/custom-script.js"></script>
    <!-- sidebar -->
    <script src="js/sidebar.js"></script>
    <!-- height_equal-->
    <script src="js/height-equal.js"></script>
    <!-- config-->
    <script src="js/config.js"></script>
    <!-- apex-->
    <script src="js/apex-chart.js"></script>
    <script src="js/stock-prices.js"></script>
    <!-- scrollbar-->
    <script src="js/simplebar.js"></script>
    <script src="js/custom.js"></script>
    <!-- slick-->
    <script src="js/slick.min.js"></script>
    <script src="js/slick.js"></script>
    <!-- data_table-->
    <script src="js/jquery.dataTables.min.js"></script>
    <!-- page_datatable-->
    <script src="js/datatable.custom_1.js"></script>
    <!-- page_datatable1-->
    <script src="js/datatable.custom1.js"></script>
    <!-- page_datatable-->
    <script src="js/datatable.custom.js"></script>
    <!-- theme_customizer-->
    <script src="js/customizer.js"></script>
    <!-- tilt-->
    <script src="js/tilt.jquery.js"></script>
    <!-- page_tilt-->
    <script src="js/tilt-custom.js"></script>
    <!-- dashboard_1-->
    <script src="js/dashboard_1.js"></script>
    <!-- custom script -->
    <script src="../assets/js/script.js"></script>
    

</body>

</html>