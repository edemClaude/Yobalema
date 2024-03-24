@php/* @var App\Models\User $chauffeur */@endphp
@extends('layouts.admin.base')
@section('title', 'Tous les chauffeurs')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => __('Chauffeurs'),
        'breadcrumbs' => [
                ['url' => '#', 'label' => __('Liste des chauffeurs')]
            ],
    ])<!-- End Page Title -->

    <!-- Alert area -->
    @include('components.alert')<!-- End Alert area -->

    <!-- Start Section -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Top table area -->
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Chauffeurs</h5>
                            <span class="float-end">
                            <a href="{{ route('admin.chauffeurs.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus"></i> Créer</a>
                            </span><!-- add new user button -->
                        </div><!-- Top table area -->
                        <!-- Drivers table -->
                        <div class="table-responsive">
                            <table class="table datatable text-nowrap">
                                <caption></caption>
                                <!-- Afficher un message lorsque le tableau est vide -->
                                @if($chauffeurs->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            {{ __('Aucun chauffeur n\'a été défini pour le moment') }}
                                        </td>
                                    </tr>
                                @endif <!-- End Afficher un message lorsque le tableau est vide -->
                                <thead>
                                <tr>
                                    <th scope="col">{{ __("Image") }}</th>
                                    <th scope="col">{{ __("Nom") }}</th>
                                    <th scope="col">{{ __("Permis de conduite") }}</th>
                                    <th scope="col">{{ __("Statut") }}</th>
                                    <th scope="col">{{ __("Véhicule") }}</th>
                                    <th scope="col">{{ __("Contrat") }}</th>
                                    <th scope="col">{{ __("Actions") }}</th>
                                </tr>
                                </thead><!-- End Thead -->
                                <tbody>
                                @foreach ($chauffeurs as $chauffeur)
                                    <tr class="align-middle">
                                        <td class="align-middle">
                                            @if($chauffeur->image)
                                                <img src="{{ $chauffeur->getAvatar() }}"
                                                     alt="..." class="img-fluid w-50 rounded-circle">
                                            @endif
                                        </td><!-- Image -->
                                        <td class="align-middle">{{ $chauffeur->getFullName() }}</td><!-- Name -->
                                        <td class="align-middle">
                                            @include('components.permis-modal', [
                                                'id' => $chauffeur->id,
                                                'title' => __('Consulter le permis'),
                                                'permis' => $chauffeur->permisConduite,
                                                'chauffeur' => $chauffeur,
                                                'categories' => $categories,
                                            ])
                                        </td><!-- License -->
                                        <td class="align-middle">
                                            @if($chauffeur->status)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check"></i> Activé</span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-x"></i> Désactivé</span>
                                            @endif
                                        </td><!-- Status -->

                                        <td class="align-middle">
                                            @include('components.contrat-modal', [
                                                'id' => $chauffeur->id,
                                                'title' => __('Consulter le contrat'),
                                                'contrat' => $chauffeur->contrat,
                                                'chauffeur' => $chauffeur,
                                                'disabled' => !$chauffeur->permisConduite
                                                    || !$chauffeur?->permisConduite->is_valid
                                            ])
                                        </td>

                                        <td class="align-middle">
                                            @include('components.vehicule-modal', [
                                                'id' => $chauffeur->id,
                                                'title' => __('Consulter le vehicule'),
                                                'vehicule' => $chauffeur->vehicule,
                                                'chauffeur' => $chauffeur,
                                                'disabled' => !$chauffeur->contrat
                                                    || !$chauffeur?->contrat->actived
                                            ])
                                        </td> <!-- Véhicule attribué -->

                                        <td class="text-center align-middle">
                                            <div class="text-center actions d-flex gap-2">

                                                <a href="{{ route('admin.users.edit', $chauffeur) }}"
                                                   class="btn btn-sm btn-outline-primary" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a><!-- Edit button -->

                                                <form class="delete-form"
                                                      action="{{ route('admin.users.destroy', $chauffeur) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form><!-- Delete from -->
                                            </div>
                                        </td><!-- Actions: Edit and Delete  -->
                                    </tr>
                                @endforeach
                                </tbody><!-- End Tbody -->
                            </table><!-- Drivers table -->
                        </div><!-- End Drivers table -->
                    </div><!-- End Card Body -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </section> <!-- End Section -->
@endsection


