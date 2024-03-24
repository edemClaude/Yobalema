@extends('layouts.admin.base')
@section('title', 'Dashboard')
@section('content')
    @include('components.page-title',[
        'title' => 'Dashboard',
        'breadcrumbs' => [
            [
                'label' => 'Dashboard',
                'url' => route('admin.dashboard')
            ]
        ]
    ])
@endsection
