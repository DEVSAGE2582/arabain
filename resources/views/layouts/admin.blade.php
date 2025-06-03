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
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iconly-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bulk-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('css/color-1.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Bootstrap 5.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

  <!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('js/popper.min.js') }}" defer></script>

<!-- FontAwesome -->
<script src="{{ asset('js/fontawesome-min.js') }}"></script>

<!-- Feather Icons -->
<script src="{{ asset('js/feather.min.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('js/custom-script.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/height-equal.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>

<!-- Charts -->
{{-- <script src="{{ asset('js/apex-chart.js') }}"></script> --}}
{{-- <script src="{{ asset('js/stock-prices.js') }}"></script> --}}

<!-- Scrollbar -->
<script src="{{ asset('js/simplebar.js') }}"></script>

<!-- UI -->
<script src="{{ asset('js/custom.js') }}"></script>
{{-- <script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script> --}}

<!-- DataTables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable.custom_1.js') }}"></script>
<script src="{{ asset('js/datatable.custom1.js') }}"></script>
<script src="{{ asset('js/datatable.custom.js') }}"></script>

<!-- Theme Customizer -->
<script src="{{ asset('js/customizer.js') }}"></script>

<!-- Tilt Effects -->
{{-- <script src="{{ asset('js/tilt.jquery.js') }}"></script> --}}
{{-- <script src="{{ asset('js/tilt-custom.js') }}"></script> --}}

<!-- Dashboard Scripts -->
<script src="{{ asset('js/dashboard_1.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Bootstrap 5.3 JS Bundle with Popper (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            const row = $(this).closest('tr');
            $('#rowIndex').val(row.index());
            $('#editName').val(row.find('td:eq(0)').text());
            $('#editPosition').val(row.find('td:eq(1)').text());
            $('#editSalary').val(row.find('td:eq(2)').text());
            $('#editLocation').val(row.find('td:eq(3)').text());
            $('#editEmail').val(row.find('td:eq(6)').text());
            $('#editModal').modal('show');
        });
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            const index = $('#rowIndex').val();
            const row = $('#employeeTable tbody tr').eq(index);
            row.find('td:eq(0)').text($('#editName').val());
            row.find('td:eq(1)').text($('#editPosition').val());
            row.find('td:eq(2)').text($('#editSalary').val());
            row.find('td:eq(3)').text($('#editLocation').val());
            row.find('td:eq(6)').text($('#editEmail').val());
            $('#editModal').modal('hide');
        });
        $('.delete-btn').on('click', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

</body>

</html>