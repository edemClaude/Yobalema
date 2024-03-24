@extends('layouts.admin.base')
@section('title', 'Rôles')
@section('content')

    <!-- Page Title -->
    @include('components.page-title', [
        'title' => 'Rôles',
        'breadcrumbs' => [
                ['label' => 'Liste des rôles', 'url' => '#'],
            ]
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
                            <h5 class="card-title">Roles</h5>
                            <span class="float-end">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus"></i> Créer</a>
                            </span><!-- add new role button -->
                        </div><!-- Top table area -->
                        <!-- Roles table -->
                        <table class="table table-hover table-responsive">
                            <caption>@yield('title')</caption>
                            <!-- Afficher un message lorsque le tableau est vide -->
                            @if($roles->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ __('Aucun role n\'a été défini pour le moment') }}
                                    </td>
                                </tr>
                            @endif
                            <thead>
                            <tr>
                                <th scope="col">{{ __("ID") }}</th>
                                <th scope="col">{{ __("Nom") }}</th>
                                <th scope="col">{{ __("Actions") }}</th>
                            </tr>
                            </thead><!-- End Thead -->
                            <tbody>
                            @foreach ($roles as $role)
                                <tr>

                                    <th scope="row">{{  strtoupper($role->id) }}</th><!-- ID -->

                                    <td>{{ strtoupper($role->name) }}</td><!-- Name -->


                                    <td class="text-center actions d-flex gap-3">
                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                           class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-square"></i> Editer
                                        </a><!-- Edit button -->

                                        <form class="delete-form" action="{{ route('admin.roles.destroy', $role) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form><!-- Delete from -->
                                    </td><!-- Actions: Edit and Delete  -->
                                </tr>
                            @endforeach
                            </tbody><!-- End Tbody -->
                        </table><!-- Roles table -->
                    </div><!-- End Card Body -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </section> <!-- End Section -->
@endsection
