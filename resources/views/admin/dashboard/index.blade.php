@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content-admin')
@endsection

@push('scripts')
    <!--apexchart js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--dashboard ecommerce init js-->
    <script src="{{ URL::asset('assets/js/pages/dashboards-ecommerce.init.js') }}"></script>

@endpush