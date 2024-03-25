@extends('layouts.home.base')
@section('title', 'One Location')

@section('content')
    <div class="site-section bg-light"></div>
    <div class="site-section bg-light">
        <div class="container">

            @include('components.alert') <!-- Alert Component -->

            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Last Location</strong></h2>
                    <p class="mb-5">
                        Consulter ici l'activité la plus récente et finaliser le payement.
                    </p>
                </div>
            </div>
            <div class="row">
                @include('home.__location-view', ['location' => $location])
            </div>

            <div class="row">
                {{-- Importer la vue de payement --}}
            </div>
        </div>
    </div>

@endsection
