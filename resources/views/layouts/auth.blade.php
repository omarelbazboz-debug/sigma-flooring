<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $lang == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('uploads/settings/source/' . $configration->fav_icon) }}" type="image/x-icon" />

    <!-- Title -->
    <title>{{ config('app.name') . ' - ' . trans('home.admin_panel') }}</title>

    <link
        href="{{ asset('public/assets/back/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('public/assets/back/css/preloader.min.css') }}" type="text/css" />
    <!-- dropzone css -->
    <link href="{{ asset('public/assets/back/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- choices css -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/back/libs/choices.js/public/assets/styles/choices.min.css') }}"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/assets/back/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    @if ($lang == 'ar')
        <link href="{{ asset('public/assets/back/css/css/bootstrap-rtl.min.css') }}" id="bootstrap-style"
            rel="stylesheet" type="text/css" />
    @endif
    <!-- Icons Css -->
    <link href="{{ asset('public/assets/back/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('public/assets/back/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
    @if ($lang == 'ar')
        <link href="{{ asset('public/assets/back/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet"
            type="text/css" />
    @endif
    <link href="{{ asset('public/assets/back/libs/admin-resources/rwd-table/rwd-table.min.css') }}"
        rel="stylesheet" type="text/css" />


    <!-- Responsive datatable examples -->
    <link
        href="{{ asset('public/assets/back/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />


    @yield('style')
</head>


<body class="main-body">



    @yield('content')


    <!-- JAVASCRIPT -->
    <script src="{{ asset('public/assets/back/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- choices js -->
    <script src="{{ asset('public/assets/back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/js/pages/form-advanced.init.js') }}"></script>

    <script src="{{ asset('public/assets/back/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/assets/back/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('public/assets/back/libs/pace-js/pace.min.js') }}"></script>

</body>

</html>
