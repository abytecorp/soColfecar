<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    
    @yield('css')


</head>

<body class="skin-blue fixed-layout">
<div id="log-in">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

    <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo  /images/logo-light-icon.png   -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon           logo-icon.png          -->
                                <img src="{{ Storage::disk('public')->url('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{ Storage::disk('public')->url('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text --><span>
                             <!-- dark Logo text -->
                             <img src="{{ Storage::disk('public')->url('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                             <!-- Light Logo text -->    
                             <img src="{{ Storage::disk('public')->url('images/logo-light-text.png') }}" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
            

               
        </nav>
    </header>
    




  
        {{-- <main class="py-4"> --}}
       
            @yield('content')
       
        {{-- </main> --}}
    </div>
</div>


    <script src="{{ mix('js/app.js') }}"></script>


     @yield('script')




</body>
</html>