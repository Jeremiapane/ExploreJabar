<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Explore Jabar - Agen</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/travel/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/travel/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/select2.min.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/travel/plugins/datatables/datatables.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/travel/css/feather.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/travel/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">

</head>

<body>
    <div class="main-wrapper">
        @include('sweetalert::alert')

        {{-- header --}}

        {{-- sidebar --}}

        @include('travel.layouts.header')
        @include('travel.layouts.sidebar')

        <div class="page-wrapper">
            {{-- Content --}}
            @yield('content')
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- jQuery -->
    <script src="{{ asset('assets/travel/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/travel/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Feather Js -->
    <script src="{{ asset('assets/travel/js/feather.min.js') }}"></script>

    <!-- Slimscroll -->
    <script src="{{ asset('assets/travel/js/jquery.slimscroll.js') }}"></script>

    <!-- Select2 Js -->
    <script src="{{ asset('assets/travel/js/select2.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('assets/travel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/travel/plugins/datatables/datatables.min.js') }}"></script>

    <!-- counterup JS -->
    <script src="{{ asset('assets/travel/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/travel/js/jquery.counterup.min.js') }}"></script>

    <!-- Apexchart JS -->
    <script src="{{ asset('assets/travel/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/travel/plugins/apexchart/chart-data.j') }}s"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/travel/js/app.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>

</body>

</html>