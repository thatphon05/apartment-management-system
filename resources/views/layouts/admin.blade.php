<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} | @yield('title')</title>
    @include('partials.admins.header_assets')
</head>
<body class="">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->
@include('partials.admins.sidebar')
<main class="main-content">
    <div class="position-relative iq-banner">
        <!--Nav Start-->
        @include('partials.admins.navbar')
        <!-- Nav Header Component Start -->
        <div class="iq-navbar-header" style="height: 215px;">
            <div class="container-fluid iq-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flex-wrap d-flex justify-content-between align-items-center">
                            <div>
                                <h1>@yield('title')</h1>
                                {{--
                                <p>We are on a mission to help developers like you build successful projects for FREE.</p>
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-header-img">
                <img src="../assets/images/dashboard/top-header.png" alt="header"
                     class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                <img src="../assets/images/dashboard/top-header1.png" alt="header"
                     class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                <img src="../assets/images/dashboard/top-header2.png" alt="header"
                     class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                <img src="../assets/images/dashboard/top-header3.png" alt="header"
                     class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                <img src="../assets/images/dashboard/top-header4.png" alt="header"
                     class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                <img src="../assets/images/dashboard/top-header5.png" alt="header"
                     class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
            </div>
        </div>
        <!-- Nav Header Component End -->
        <!--Nav End-->
    </div>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            @yield('content')
        </div>
    </div>
    <!-- Footer Section Start -->
    @include('partials.admins.footer')
    <!-- Footer Section End -->
</main>
@include('partials.admins.offcanvas')
@include('partials.admins.body_assets')
</body>
</html>
