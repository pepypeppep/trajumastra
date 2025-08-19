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
    {{-- Anchor view --}}
    <a href="" class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600">
        <i class="ri-eye-line"></i> View ...
    </a>

    {{-- Button save --}}
    <button type="button" class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
        <i class="ri-save-line"></i> Simpan perubahan data
    </button>


{{--  --}}


    {{-- Anchor add --}}
    <a href="" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
        <i class="ri-user-add-line"></i> Tambah ...
    </a>
    {{-- Anchor edit --}}
    <a href="" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
        <i class="ri-edit-line"></i> Edit ...
    </a>
    {{-- Anchor delete --}}
    <a href="" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
        <i class="ri-delete-bin-line"></i> Hapus ...
    </a>
    {{-- Anchor view --}}
    <a href="" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 dark:ring-sky-400/20">
        <i class="ri-eye-line"></i> View ...
    </a>

    {{-- Button save --}}
    <button type="button" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 w-full">
        <i class="ri-save-line"></i> Simpan perubahan data
    </button>
