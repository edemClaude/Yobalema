<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name') }} | @yield('title') </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheets -->
    @include("layouts.home.__stylesheets")

</head>

<body>

<div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <!-- Header -->
    @include('layouts.home.__header')<!-- End Header -->

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.home.__footer')<!-- End Footer -->

</div>

@include('layouts.home.__scripts')

</body>

</html>

