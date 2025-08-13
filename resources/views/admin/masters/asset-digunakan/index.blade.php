@extends('layouts.master')

@section('title', 'Asset Digunakan')

@section('breadcrumb')
    {{ Breadcrumbs::render('master.asset-digunakan') }}
@endsection

@section('content-admin')
@endsection

@push('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endpush