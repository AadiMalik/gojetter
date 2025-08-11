<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Go Jetter Admin </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('public/dist-assets/css/themes/lite-purple.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/dist-assets/css/plugins/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/dist-assets/css/plugins/fontawesome-5.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/dist-assets/css/plugins/metisMenu.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/dist-assets/css/vendor/toastr.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.1/sweetalert2.min.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        .sidebar_active {
            background: #b8b8c5;
            border-radius: 20px;
        }
    </style>
    @yield('css')
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        @include('layouts.sidebar')
        <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            @include('layouts.header')
            <!-- ============ Body content start ============= -->
            <!-- Pre Loader Strat  -->
            <div class='loadscreen' id="preloader">

                <div class="loader spinner spinner-primary">
                </div>
            </div>
            @yield('content')
            <div class="sidebar-overlay open"></div><!-- Footer Start -->
            <div class="flex-grow-1"></div>
            <div class="app-footer">
                <!-- <div class="row">
                    <div class="col-md-9">
                        <p><strong>Gull - Laravel + Bootstrap 4 admin template</strong></p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero quis beatae officia saepe perferendis voluptatum minima eveniet voluptates dolorum, temporibus nisi maxime nesciunt totam repudiandae commodi sequi dolor quibusdam
                            <sunt></sunt>
                        </p>
                    </div>
                </div> -->
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <!-- <a class="btn btn-primary text-white btn-rounded" href="https://themeforest.net/item/gull-bootstrap-laravel-admin-dashboard-template/23101970" target="_blank">Buy Gull HTML</a> -->
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <img class="logo" src="{{ asset('public/dist-assets/images/logo.png') }}" alt="">
                        <div>
                            <p class="m-0">&copy; {{ date('Y') }} Go Jetter</p>
                            <p class="m-0">All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
    </div>
    <script src="{{ asset('public/dist-assets/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/tooltip.script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/script_2.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/sidebar.script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/layout-sidebar-vertical.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/echarts.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/dashboard.v4.script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/widgets-statistics.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/apexSparklineChart.script.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/scripts/customizer.script.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/dist-assets/js/vendor/toastr.min.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/toastr.script.js') }}"></script>
    <script src="{{ asset('public/dist-assets/js/vendor/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    @yield('js')
</body>

</html>
