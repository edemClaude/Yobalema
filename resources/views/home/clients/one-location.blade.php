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
                <div class="col-md-8">
                 @include('home.__location-view', ['location' => $location])
                </div>
                <div class="col-md-4">
                    @if(!$location->heure_arrivee)
                        <div class="row">
                            {{-- Importer la vue de payement --}}
                            @include('home.clients.__payement-card', ['location' => $location])
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5">
                <form action="{{ route('client.note.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                    <input type="hidden" name="user_id" value="{{ $location?->chauffeur->id }}">
                    <label for="note">Noté le chauffeur :</label>
                    <select id="note" name="value">
                        <option value="1">★</option>
                        <option value="2">★★</option>
                        <option value="3">★★★</option>
                        <option value="4">★★★★</option>
                        <option value="5">★★★★★</option>
                    </select>
                    <button type="submit">Soumettre</button>
                </form>
            </div>

        </div>
    </div>

@endsection
