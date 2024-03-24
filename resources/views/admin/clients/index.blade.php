@extends('layouts.admin.base')
@section('title', 'Clients')
@section('content')

    <!-- Page title -->
    @include('components.page-title', [
        'title' => 'Clients',
        'breadcrumbs' => [
            ['label' => 'Clients', 'url' => route('admin.clients.index')]
        ],
    ]) <!-- Page title -->

    <!-- Alert -->
    @include('components.alert')<!-- Alert -->

    <section class="section">
        <!-- Page content -->
        @include('admin.clients._list')
    </section>

@endsection
