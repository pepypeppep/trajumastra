@extends('layouts.master-without-nav')
@section('content')
<body class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
    <div class="mb-0 border-none lg:w-[600px] card bg-white/70 shadow-none dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="" class="block h-6 mx-auto dark:hidden">
            </a>

            <div class="mt-10">
                <img src="{{ URL::asset('assets/images/auth/error-404.png') }}" alt="" class="h-64 mx-auto">
            </div>

            <div class="mt-8 text-center">
                <h4 class="mb-2 text-purple-500 dark:text-purple-500">@yield('code')</h4>
                <p class="text-slate-500 dark:text-zink-200">@yield('message')</p>
            </div>

            <a href="{{ route('dashboard') }}"
                class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                <i class="ri-home-3-line"></i>
                <span class="align-middle">Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
@endsection
