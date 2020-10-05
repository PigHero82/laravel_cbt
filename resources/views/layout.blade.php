<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('judul') - CBT</title>
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.jpg') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/components.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/fontawesome5.css') }}">
    <!-- END: Custom CSS-->

    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">Admin</span><span class="user-status">Admin</span></div><span><div class="avatar bg-primary mr-1">
                                    <div class="avatar-content">
                                      A
                                    </div>
                                </div></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="page-user-profile.html">Pimpinan</a>
                                <a class="dropdown-item" href="page-user-profile.html">Reviewer</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/profil"><i class="feather icon-user"></i> Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> Logout</a>
                                <form id="logout-form" action="#" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="
                    @if (request()->is('admin*'))
                        {{-- {{ route('admin.index') }} --}}#
                    @elseif (request()->is('dosen*'))
                        {{-- {{ route('dosen.index') }} --}}#
                    @elseif (request()->is('pimpinan*'))
                        #
                    @elseif (request()->is('penelitian*'))
                        #
                    @elseif (request()->is('pengabdian*'))
                        #
                    @elseif (request()->is('reviewer'))
                        #
                    @endif
                    ">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="img-fluid" style="max-width: 17%;">
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        @include('sidebar')
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title mb-0">@yield('judul')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
               @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Custom JS-->
    <script src="{{ asset('/js/fontawesome5.js') }}"></script>
    <!-- END: Custom JS-->
    {{-- <script src="{{ asset('/app-assets/js/scripts/datatables/datatable.min.js') }}"></script> --}}

    @yield('js')

</body>
<!-- END: Body-->

</html>