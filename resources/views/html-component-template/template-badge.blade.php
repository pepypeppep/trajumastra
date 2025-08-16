@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content-admin')
    {{--  --}}
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent">Custom</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">Green</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-orange-100 border-transparent text-orange-500 dark:bg-orange-500/20 dark:border-transparent">Orange</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-sky-100 border-transparent text-sky-500 dark:bg-sky-500/20 dark:border-transparent">Sky</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">Yellow</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Red</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-purple-100 border-transparent text-purple-500 dark:bg-purple-500/20 dark:border-transparent">Purple</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent">Slate</span>
    <span
        class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-zinc-100 border-transparent text-zinc-500 dark:bg-zinc-500/20 dark:border-transparent">Zinc</span>