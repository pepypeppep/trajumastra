@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content-admin')
    @if (request('uptd'))
        @include('admin.dashboard.uptd')
    @else
        @include('admin.dashboard.global')
    @endif
@endsection
