@extends('layouts.master-without-nav')
@section('title')
    {{ __('t-login') }}
@endsection
@section('content')

    <body
        class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
        <div class="mb-0 border-none lg:w-[600px] card bg-white/70 shadow-none dark:bg-zink-500/70">
            <div class="!px-10 !py-12 card-body">
                <a href="index">
                    {{-- <img src="./assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block">
                    <img src="./assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden"> --}}
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="" class="block h-6 mx-auto dark:hidden">
                </a>

                <div class="mt-8 text-center">
                    <h4 class="mb-2 text-purple-500 dark:text-purple-500">PERINGATAN !</h4>
                    <p class="text-slate-500 dark:text-zink-200">Anda tidak diperkenankan mengakses aplikasi ini</p>
                </div>

                <div
                    class="px-4 py-3 mt-3 mb-6 text-sm text-yellow-500 border border-transparent rounded-md bg-yellow-50 dark:bg-yellow-400/20 font-semibold">
                    Akun <span class="text-red-500">{{ $username }} {{ $email }}</span> {{ $message }}
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit"
                        class="w-full text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">Keluar</button>
                </form>
            </div>
        </div>
    @endsection
