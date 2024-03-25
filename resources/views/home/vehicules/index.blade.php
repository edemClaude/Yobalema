@extends('layouts.home.base')
@section('title', 'Vehicules')
@section('content')

    <div class="site-section bg-light"></div>
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Véhicules</strong></h2>
                    <p class="mb-5">Liste de tous nos véhicules en activités</p>
                </div>
            </div>
            <div class="row">
                @include('home.vehicules.__list', ['vehicules' => $vehicules])
            </div>
            {{ $vehicules->links() }}
        </div>
    </div>

@endsection
