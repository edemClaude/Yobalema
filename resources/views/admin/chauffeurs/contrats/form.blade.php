@extends('layouts.admin.base')
@section('title', 'Modifier un contrat')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => __('Modifier un contrat'),
        'breadcrumbs' => [
            ['url' => route('admin.chauffeurs.index'), 'label' => __('Liste des chauffeurs')]
        ],
    ])

    <!-- Alert area -->
    @include('components.alert')<!-- End Alert area -->

    <!-- Start Section -->
    <section class="section">
        <div class="card shadow col-xl-8 offset-xl-2">
            <div class="card-header">
                <h5 class="card-title">@yield('title')</h5>
            </div>
            <div class="card-body">
                @include('admin.chauffeurs.contrats.__form__', [
                        'action' => route('admin.contrats.update', $chauffeur->contrat),
                        'method' => 'PUT',
                        'chauffeur' => $chauffeur
                    ])
            </div>
        </div>

    </section><!-- End Section -->
@endSection
