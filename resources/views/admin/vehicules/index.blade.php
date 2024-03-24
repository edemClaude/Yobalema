@extends('layouts.admin.base')
@section('title', 'Véhicules')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => __('Véhicules'),
        'breadcrumbs' => [
            [ 'label' => __('liste des véhicules'), 'url' => "#" ]
        ]
    ]) <!-- Page Title End -->

    <!-- Section Alerts -->
    @include('components.alert')<!-- Alerts -->

    <!-- Start Section -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Véhicules</h5>
                            <span class="float-end">
                            <a href="{{ route('admin.vehicules.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus"></i> Créer</a>
                            </span><!-- add new vehicule button -->
                        </div><!-- Top table area -->
                        <!-- Vehicles table -->
                        <div class="table-responsive">
                            <table class="table datatable text-nowrap">
                                <caption></caption>
                                <!-- Afficher un message lorsque le tableau est vide -->
                                @if($vehicules->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            {{ __('Aucun véhicule n\'a ajouté pour le moment') }}
                                        </td>
                                    </tr>
                                @endif
                                <thead>
                                <tr>
                                    <th scope="col">{{ __("Image") }}</th>
                                    <th scope="col">{{ __("Matricule") }}</th>
                                    <th scope="col">{{ __("Catégorie") }}</th>
                                    <th scope="col">{{ __("Km Défaut") }}</th>
                                    <th scope="col">{{ __("Km actuel") }}</th>
                                    <th scope="col">{{ __("Statut") }}</th>
                                    <th scope="col">{{ __("Date d'achat") }}</th>
                                    <th scope="col">{{ __("Actions") }}</th>
                                </tr>
                                </thead><!-- End Thead -->
                                <tbody>
                                @foreach ($vehicules as /* @var App\Models\Vehicule $vehicule*/ $vehicule)
                                    <tr class="align-middle">

                                        <td class="align-middle">
                                            <img src="{{ $vehicule->getImage() }}"
                                                 alt="image" class="img-fluid w-50">
                                        </td><!-- Image -->

                                        <td class="align-middle">
                                            {{ $vehicule->matricule }}
                                        </td><!-- Immatriculation -->
                                        <td class="align-middle">
                                            {{ $vehicule?->category?->name }}
                                        </td><!-- Catégorie -->
                                        <td class="align-middle">
                                            {{ $vehicule->km_defaut }} Km
                                            <i class="bi bi-speedometer"></i>
                                        </td> <!-- Kilométrage par défaut -->

                                        <td class="align-middle">
                                            {{ $vehicule->km_actuel }} Km
                                            <i class="bi bi-speedometer"></i>
                                        </td> <!-- Kilométrage actuel -->

                                        <td class="align-middle">
                                            {{ $vehicule->status }}
                                        </td><!-- Status -->

                                        <td class="align-middle">{{ $vehicule->date_achat }}</td><!-- Date -->

                                        <td class="text-center align-middle">
                                            <div class="text-center actions d-flex gap-3">

                                                <a href="{{ route('admin.vehicules.edit', $vehicule) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a><!-- Edit button -->

                                                <form class="delete-form"
                                                      action="{{ route('admin.vehicules.destroy', $vehicule) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form><!-- Delete from -->
                                            </div>
                                        </td><!-- Actions: Edit and Delete  -->
                                    </tr><!-- tr -->
                                @endforeach
                                </tbody><!-- End Tbody -->
                            </table><!-- Roles table -->
                        </div><!-- End Vehicles table -->
                    </div><!-- End Card Body -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </section><!-- End Section -->
@endsection
