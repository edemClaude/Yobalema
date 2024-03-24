@extends('layouts.admin.base')
@section('title', $vehicule->exists ? 'Modifier le véhicule' : 'Ajouter un véhicule')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => $vehicule->exists ? 'Modifier le véhicule' : 'Ajouter un véhicule',
        'breadcrumbs' => [
            ['label' => 'Toutes les véhicules', 'url' => route('admin.vehicules.index')],
        ]
    ]) <!-- Page Title End -->

    <!-- Section Alerts -->
    @include('components.alert')<!-- Alerts -->

    <!-- Section start -->
    <section class="section">

        <!-- Row start -->
        <div class="row">
            <div class="card shadow col-md-8 offset-md-2">

                <div class="card-body">
                    <h5 class="card-title">@yield('title')</h5><!-- Add | Edit title -->
                    <!-- Form Add | Edit form -->
                    @include("admin.vehicules.__form__", [
                        'vehicule' => $vehicule,
                        'action' => $vehicule->exists ? route('admin.vehicules.update', $vehicule)
                            : route('admin.vehicules.store'),
                        'categories' => $categories,
                        'method' => $vehicule->exists ? 'PUT' : 'POST',
                    ]) <!-- End Form Add | Edit form -->

                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Row -->
    </section> <!-- Section end -->
@endsection

