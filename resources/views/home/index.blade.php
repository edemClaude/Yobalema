@extends('layouts.home.base')
@section('title', 'Home')
@section('content')
<div class="hero" style="background-image: url({{ asset('home/images/hero_1_a.jpg') }});">

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">

                <div class="row mb-5">
                    <div class="col-lg-7 intro">
                        <h1><strong>Louer un véhicule</strong> en un seul click.</h1>
                    </div>
                </div>

                <!-- Location form -->
                @include('home.__location-form')<!-- Location form -->

            </div>
        </div>
    </div>
</div>

    {{-- @include('home.__services') --}}

@endsection
