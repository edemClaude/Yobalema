@extends('layouts.admin.base')
@section('title', 'Utilisateurs')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => __('Tous les utilisateurs'),
        'breadcrumbs' => [
            ['label' => 'Liste des utilisateurs', 'url' => '#'],
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
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Utilisateurs</h5>
                            <span class="float-end">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus"></i> Créer</a>
                            </span><!-- add new user button -->
                        </div><!-- Top table area -->
                        <!-- Users table -->
                        <div class="table-responsive">
                            <table class="table datatable text-nowrap">
                                <caption></caption>
                                <!-- Afficher un message lorsque le tableau est vide -->
                                @if($users->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            {{ __('Aucun user n\'a été défini pour le moment') }}
                                        </td>
                                    </tr>
                                @endif
                                <thead>
                                <tr>
                                    <th scope="col">{{ __("Image") }}</th>
                                    <th scope="col">{{ __("Nom") }}</th>
                                    <th scope="col">{{ __("Email") }}</th>
                                    <th scope="col">{{ __("Role") }}</th>
                                    <th scope="col">{{ __("Téléphone") }}</th>
                                    <th scope="col">{{ __("Adresse") }}</th>
                                    <th scope="col">{{ __("Statut") }}</th>
                                    <th scope="col">{{ __("Actions") }}</th>
                                </tr>
                                </thead><!-- End Thead -->
                                <tbody>
                                @foreach ($users as $user)
                                    <tr class="align-middle">
                                        <td>
                                            <img src="{{ $user->getAvatar()  }}" alt="{{ $user->name }}"
                                                 class="rounded-circle img-fluid" width="50">
                                        </td><!-- Image -->

                                        <td>{{ $user->getFullName() }}</td><!-- Name -->
                                        <td>{{ $user->email }}</td><!-- Email -->
                                        <td>{{ $user?->role?->name }}</td><!-- Role -->
                                        <td>{{ $user->telephone }}</td><!-- Telephone -->
                                        <!-- cut the long address -->
                                        <td title="{{ $user->adresse }}">
                                            @if(strlen($user->adresse) > 10)
                                                {{ substr($user->adresse, 0, 10) }}...
                                            @else
                                                {{ $user->address }}
                                            @endif
                                        </td><!-- Address -->

                                        <td>
                                            @if($user->status)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td><!-- Status -->

                                        <td class="text-center">
                                            <div class="text-center actions d-flex gap-3">
                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="btn btn-outline-primary" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a><!-- Edit button -->
                                                <form class="delete-form"
                                                      action="{{ route('admin.users.destroy', $user) }}"
                                                      method="POST" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Supprimer l'utilisateur"
                                                            class="btn btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form><!-- Delete from -->
                                            </div>
                                        </td><!-- Actions: Edit and Delete  -->
                                    </tr>
                                @endforeach
                                </tbody><!-- End Tbody -->
                            </table><!-- Roles table -->
                        </div><!-- End Users table -->
                    </div><!-- End Card Body -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </section> <!-- End Section -->
@endsection

