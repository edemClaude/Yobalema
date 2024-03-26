@extends('layouts.admin.base')
@section('title', 'Payements')
@section('content')

    <!-- Page title -->
    @include('components.page-title', [
        'title' => 'Clients',
        'breadcrumbs' => [
            ['label' => 'Payements', 'url' => route('admin.payements.index')]
        ],
    ]) <!-- Page title -->

    <!-- Alert -->
    @include('components.alert')<!-- Alert -->

    <section class="section">
        <!-- Page content -->
        @include('admin.payements.__list')
    </section>

@endsection
