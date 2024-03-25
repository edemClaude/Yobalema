@extends('layouts.home.base')
@section('title', 'Home')
@section('content')
<div class="hero" style="background-image: url({{ asset('home/images/hero_1_a.jpg') }});">
    <div class="site-section"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="row mb-5">
                    <div class="col-lg-7 intro">
                        <h1><strong>Louer un véhicule</strong> en seulement quelque clicks.</h1>
                    </div>
                </div>

                <!-- Location form -->
                @include('home.__location-form')<!-- Location form -->

            </div>
        </div>
    </div>
</div>

    {{-- @include('home.__services') --}}
<div class="site-section bg-light"></div>
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h2 class="section-heading"><strong>Véhicules</strong></h2>
                <p class="mb-5">Liste de nos vehicules</p>
            </div>
        </div>


        <div class="row">
            @include('home.vehicules.__list', ['vehicules' => $vehicules])
        </div>
    </div>
</div>

@endsection
