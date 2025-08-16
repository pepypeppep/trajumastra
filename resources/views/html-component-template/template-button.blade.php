@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content-admin')
    {{-- Anchor add --}}
    <a href="" class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
        <i class="ri-user-add-line"></i> Tambah ...
    </a>
    {{-- Anchor edit --}}
    <a href="" class="btn bg-yellow-500 text-white hover:bg-yellow-600 focus:bg-yellow-600">
        <i class="ri-edit-line"></i> Edit ...
    </a>
    {{-- Anchor delete --}}
    <a href="" class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600">
        <i class="ri-delete-bin-line"></i> Hapus ...
    </a>

    {{-- Button save --}}
    <button type="button" class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
        <i class="ri-save-line"></i> Simpan perubahan data
    </button>
