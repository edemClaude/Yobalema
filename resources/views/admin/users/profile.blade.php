@extends('layouts.admin.base')
@section('title', 'Edit Profile')
@section('content')

    @include('components.page-title', [
        'title' => 'Edit Profile',
        'breadcrumbs' => [
            ['label' => 'Tous les utilisateurs', 'url' => route('admin.users.index')],
            ['label' => 'Tous les Chauffeurs', 'url' => route('admin.chauffeurs.index')],
            ['label' => 'Tous les Clients', 'url' => route('admin.clients.index')],
        ]
    ])<!-- End Page Title -->

    @include('components.alert')<!-- End Alerts -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ /* @var App\Models\User $user */$user->getAvatar() }}"
                             alt="{{ $user->prenom }}" class="rounded-circle">

                        <h2>{{ $user->getFullName() }}</h2>
                        <h3>{{ $user->email }}</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div> <!-- End Profile Card -->
                @if($user->role_id == 3)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Actions</h5>
                        <p class="card-text d-flex align-items-center mb-3">
                            <span class="fw-bold">Permis : &nbsp;&nbsp;&nbsp;</span>
                            @include('components.permis-modal', [
                                'id' => $user->id,
                                'title' => $user->permisConduite ? __('Consulter') : "Ajouter un permis",
                                'permis' => $user->permisConduite,
                                'chauffeur' => $user,
                                'categories' => App\Models\PermisConduite::categories(),
                            ])
                        </p>
                        <p class="label d-flex align-items-center mb-3">
                            <span class="fw-bold">Contrat : &nbsp;&nbsp;&nbsp;</span>
                            @include('components.contrat-modal', [
                               'id' => $user->id,
                               'title' => __('Consulter le contrat'),
                               'contrat' => $user->contrat,
                               'chauffeur' => $user,
                               'disabled' => !$user->permisConduite
                                   || !$user?->permisConduite->is_valid
                           ])
                        </p>
                        <p class="card-text d-flex align-items-center mb-3">
                            <span class="fw-bold">Vehicule: &nbsp;&nbsp;&nbsp;</span>
                            {{--  btn vehicule ----}}
                            @include('components.vehicule-modal', [
                                'id' => $user->id,
                                'title' => __('Consulter le vehicule'),
                                'vehicule' => $user->vehicule,
                                'chauffeur' => $user,
                                'disabled' => !$user->contrat
                                    || !$user?->contrat->actived
                            ])
                        </p>
                    </div>
                </div>
                @endif
            </div> <!-- End Left Col -->

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
                                    Overview
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Edit Profile
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                                    Change Password
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>

                                <p class="small fst-italic">
                                    Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus.
                                    Tempora libero non est unde veniam est qui dolor.
                                    Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit.
                                    Fuga sequi sed ea saepe at unde.
                                </p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nom Complet</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->getFullName() }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user?->role->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $user->adresse }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label"> Téléphone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->telephone }}</div>
                                </div>

                            </div><!-- End of Overview Tab -->

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                @include('admin.users.__form__', [
                                    'user' => $user,
                                    'action' => route('admin.users.update', $user),
                                    'method' => 'PUT',
                                ])<!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div><!-- End Right Side -->
        </div> <!-- End Row -->
    </section> <!-- End Profile Section -->

@endSection

