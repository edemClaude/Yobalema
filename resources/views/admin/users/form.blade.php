@extends('layouts.admin.base')
@section('title', $user->exists ? 'Modifier '.$user->prenom : 'Créer un utilisateur')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => $user->exists ? 'Modifier '.$user->prenom : 'Créer un utilisateur',
        'breadcrumbs' => [
            ['label' => 'tous les utilisateurs', 'url' => route('admin.users.index')],
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
                        'user' => $user,
                        'action' => $user->exists
                            ? route('admin.users.update', $user)
                            : route('admin.users.store'),
                        'method' => $user->exists ? 'PUT' : 'POST'
                    ]) <!-- End Form Add | Edit form -->
                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Row -->
    </section> <!-- End Add | Edit section form -->

@endsection
