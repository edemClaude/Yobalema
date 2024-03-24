@extends('layouts.admin.base')
@section('title', $chauffeur->exists ? 'Modifier Chauffeur' : 'Créer Chauffeur')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => $chauffeur->exists ? 'Modifier Chauffeur' : 'Créer Chauffeur',
        'breadcrumbs' => [
            ['label' => "Liste des chauffeurs", 'url' => route('admin.chauffeurs.index')],
        ],
    ])<!-- End Page Title -->

    <!-- Add | Edit section form -->
    <section class="section">

        <div class="row">

            <div class="card shadow col-md-8 offset-md-2">

                <div class="card-body">
                    <h5 class="card-title">@yield('title')</h5>
                    <!-- Form Add | Edit form -->
                    @include('admin.users.__form__', [
                        'user' => $chauffeur,
                        'action' => $chauffeur->exists
                            ? route('admin.chauffeurs.update', $chauffeur)
                            : route('admin.chauffeurs.store'),
                        'method' => $chauffeur->exists ? 'PUT' : 'POST',
                    ]) <!-- End Form Add | Edit form -->
                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Row -->
    </section> <!-- End Add | Edit section form -->

@endsection
