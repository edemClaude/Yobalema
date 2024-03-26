@extends('layouts.home.base')
@section('title', "Toutes mes locations")
@section('content')

    <div class="site-section bg-light"></div>
    <div class="site-section bg-light">
        <div class="container">
            @include('components.alert')<!-- Alerts -->
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>List de toutes mes locations</strong></h2>
                    <p class="mb-5">Consulter toutes vos activités antérieures</p>
                </div>

            </div>

            <div class="row">
                @foreach($locations as $location)
                    @include('home.__location-view', ['location' => $location])
                @endforeach
            </div>
        </div>
    </div>

@endsection
