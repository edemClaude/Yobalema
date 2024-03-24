@php/* @var App\Models\Vehicule $vehicule */ @endphp
@extends('layouts.admin.base')
@section('title', $vehicule->category?->name. " - " . $vehicule->matricule)

@section('content')
    <!-- Page title -->
    @include('components.page-title', [
        'title' => $vehicule->category?->name. " - " . $vehicule->matricule,
        'breadcrumbs' => [
            ['label' => "Listes des véhicules", 'url' => route('admin.vehicules.index')],
        ]
    ])<!-- /.page-title -->



@endsection
