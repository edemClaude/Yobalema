@extends('layouts.admin.base')

@section('title', ($role->exists ? 'Modifier ' : 'Créer ') . " rôle " . $role->name)

@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => ($role->exists ? 'Modifier ' : 'Créer ') . " rôle " . $role->name,
        'breadcrumbs' => [
                ['label' => 'Liste des Rôles', 'url' => route('admin.roles.index')],
            ]
    ])
    <!-- End Page Title -->

    <!-- Alert area -->
    @include('components.alert')<!-- End Alert area -->

    <!-- Add | Edit section form -->
    <section class="section">

        <div class="row">

            <div class="card shadow col-md-6 offset-md-3">

                <div class="card-body">
                    <h5 class="card-title">@yield('title')</h5>

                    <!-- Form Add | Edit form -->
                    <form class="needs-validation" novalidate
                          action="{{ $role->exists ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
                          method="POST">
                        @csrf

                        @if($role->exists)
                            @method('PUT')
                        @endif

                        @include('components.input', [
                                'label' => 'Nom', 'name' => 'name', 'value' => $role->name
                            ]) <!-- End Name Input -->
                        <div class="text-center form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                {{ $role->exists ? 'Modifier' : 'Créer' }}
                            </button> <!-- End Submit Button -->
                        </div>
                    </form> <!-- End Form Add | Edit form -->
                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Row -->
    </section> <!-- End Add | Edit section form -->

@endsection
