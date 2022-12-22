<!DOCTYPE html>
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Neno Laser Clinic </title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/favicon/favicon.png')}}" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" />
    <!-- Alerts -->
    <link href="{{asset('assets/vendor/toastr/toastr.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('assets/vendor/toastr/toastr.min.js')}}"></script>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{url('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{url('assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <!-- Helpers -->
    <script src="{{url('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{url('assets/js/config.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="https://www.neno.co.in" target="_blank" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="{{url('/assets/img/favicon/neno.png')}}">
                    </span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <!-- Dashboard -->

                    @if (request()->is('dashboard') or request()->is('/'))
                        <?php $mk='active'; ?>
                    @else
                        <?php $mk=''; ?>
                    @endif

                    <li class="menu-item {{$mk}}">
                    <a href="{{url('/dashboard')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                    </li>

                    <!-- Master-->

                    <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Master</span>
                    </li>

                    @if(Session::get('level') == '1')
                        <!-- User Master-->
                        @if (request()->is('usermaster') or request()->is('usermaster/add') or request()->is('usermaster/edit/{id?}'))
                            <?php $mk='active'; ?>
                        @else
                            <?php $mk=''; ?>
                        @endif


                    <li class="menu-item {{$mk}}">
                    {{-- {{ request()->is('usermaster') ? 'active' : '' }}"> --}}
                        <a href="{{url('/usermaster')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Basic">User Master</div>
                        </a>
                    </li>
                    @endif

                    <!-- Customer Master-->
                    @if (request()->is('customers') or request()->is('customers/add'))
                        <?php $mk='active'; ?>
                    @else
                       <?php $mk=''; ?>
                    @endif
                    <li class="menu-item {{$mk}}">
                        <a href="{{url('/customers')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-data"></i>
                            <div data-i18n="Basic">Customers</div>
                        </a>
                    </li>

                    <!-- Daily Rgister -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Daily Register</span></li>

                    @if (request()->is('visits') or request()->is('visits/add'))
                        <?php $mk='active'; ?>
                    @else
                       <?php $mk=''; ?>
                    @endif
                    <li class="menu-item {{$mk}}">
                        <a href="{{url('/visits')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-notepad"></i>
                            <div data-i18n="Basic">Client Treatment</div>
                        </a>
                    </li>

                    @if(Session::get('level') == '1')
                        @if (request()->is('payments') or request()->is('payments/add'))
                            <?php $mk='active'; ?>
                        @else
                        <?php $mk=''; ?>
                        @endif
                        <li class="menu-item {{$mk}}">
                            <a href="{{url('/payments')}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-dollar"></i>
                                <div data-i18n="Basic">Payments</div>
                            </a>
                        </li>
                    @endif
                     <!-- Reports -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports</span></li>

                    <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-detail"></i>
                        <div data-i18n="Form Elements">All Reports</div>
                    </a>

                    <ul class="menu-sub">

                        @if(Session::get('level') == '1')
                        <li class="menu-item">
                            <a href="{{url('/reports/payments')}}" class="menu-link">
                                <div data-i18n="Input groups">Payment Collection</div>
                            </a>
                        </li>
                        @endif

                        <li class="menu-item">
                            <a href="{{url('/reports/visits')}}" class="menu-link">
                                <div data-i18n="Input groups">Treatment Record</div>
                            </a>
                        </li>
                    </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

                    <!-- Layout container -->
                    <div class="layout-page">

                        <!-- Navbar -->
                        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                            </div>

                            <?php
                            if (session()->get('avatar') == 1)
                                $avatar = asset("userprofilepics/" . session()->get('username') . '.jpg');
                            else
                                $avatar = asset('userprofilepics/avatar.jpg');
                            ?>

                            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <!-- Place this tag where you want the button to render. -->
                                <li class="nav-item lh-1 me-3">
                                <a class="github-button" href="javascript:void(0);" data-icon="octicon-star"
                                    data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">
                                    Welcome, {{session()->get('fullname')}} </a>
                                </li>

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                    <img src="{{url($avatar)}}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                            <img src="{{$avatar}}" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <?php
                                            if (session()->get('level') == "1")
                                                $levelname = "Admin";
                                            elseif (session()->get('level') == "2")
                                                $levelname = "Director";
                                            elseif (session()->get('level') == "3")
                                                $levelname = "Sales";
                                            elseif (session()->get('level') == "4")
                                                $levelname = "Approval";
                                            elseif (session()->get('level') == "5")
                                                $levelname = "Only Reports";
                                            else
                                                $levelname = "Invalid";
                                        ?>
                                            <span class="fw-semibold d-block">{{session()->get('fullname')}}</span>
                                            <small class="text-muted">{{$levelname}}</small>
                                        </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li>
                                    <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                    <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="{{url('/logout')}}">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                    </li>
                                </ul>
                                </li>
                                <!--/ User -->
                            </ul>
                            </div>
                        </nav>
                        <!-- / Navbar -->
