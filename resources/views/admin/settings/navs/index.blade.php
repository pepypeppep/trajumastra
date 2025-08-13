@extends('layouts.master')

@section('title', 'Menu')

@section('breadcrumb')
    {{ Breadcrumbs::render('navigations') }}
@endsection

@section('content-admin')
@endsection

@push('scripts')
@endpush