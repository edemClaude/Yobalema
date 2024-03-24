@extends('layouts.admin.base')

@section('title', ($category->exists ? 'Modifier ' : 'Créer ') . "catégorie " . $category->name)

@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => ($category->exists ? 'Modifier ' : 'Créer ') . "catégorie " . $category->name,
        'breadcrumbs' => [
            ['label' => 'Liste des catégories', 'url' => route('admin.categories.index')]
        ],
     ])<!-- End Page Title -->

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
                          action="{{ $category->exists
                                    ? route('admin.categories.update', $category)
                                    : route('admin.categories.store') }}"
                          method="POST">
                        @csrf

                        @if($category->exists)
                            @method('PUT')
                        @endif

                        @include('components.input', [
                                'label' => 'Nom', 'name' => 'name', 'value' => $category->name
                            ]) <!-- End Name Input -->

                        @include('components.input', [
                                'label' => 'Type de Permis', 'name' => 'type_permis', 'value' => $category->type_permis
                            ]) <!-- End type permis Input -->

                        <div class="text-center form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                {{ $category->exists ? 'Modifier' : 'Créer' }}
                            </button> <!-- End Submit Button -->
                        </div>
                    </form> <!-- End Form Add | Edit form -->
                </div><!-- End Card Body -->
            </div><!-- End Card -->
        </div><!-- End Row -->
    </section> <!-- End Add | Edit section form -->

@endsection
