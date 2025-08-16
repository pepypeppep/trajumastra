@extends('layouts.master')

@section('title', 'Profil Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content-admin')
<div class="card">
    <div class="card-body">
        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
            <div class="xl:col-span-6">
                <h5 class="mb-1 text-18">{{ $user->name ?? '-' }}</h5>
                <p class="mb-4 text-slate-500 dark:text-zink-200">{{ ucwords(Auth::user()->roles->pluck('name')->toArray()[0]) }}</p>
            </div>
            <div class="xl:col-span-6 text-right">
                <h6 class="mb-1 text-15 text-slate-500 dark:text-zink-200">Dibuat pada, {{ $user->created_at->format('d M Y, H:i:s') }}</h6>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                <div class="xl:col-span-4">
                    <label for="name" class="inline-block mb-2 text-base font-medium">Nama</label>
                    <input type="text" id="name" name="name"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan nama anda" value="{{ $user->name ?? '-' }}">
                </div><!--end col-->
                <div class="xl:col-span-4">
                    <label for="username" class="inline-block mb-2 text-base font-medium">Username</label>
                    <input type="text" id="username"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan username anda" value="{{ $user->username ?? '-' }}" disabled>
                </div><!--end col-->
                <div class="xl:col-span-4">
                    <label for="email" class="inline-block mb-2 text-base font-medium">Email</label>
                    <input type="text" id="email"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan email anda" value="{{ $user->email ?? '-' }}" disabled>
                </div><!--end col-->
            </div><!--end grid-->
            <div class="flex justify-end mt-6 gap-x-4">
                <button type="submit"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                    <i class="align-baseline ltr:pr-1 rtl:pl-1 ri-save-line"></i>
                    Simpan perubahan
                </button>
                <a href="https://sso.bantulkab.go.id/auth/realms/bantul/account"
                    class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                    <i class="align-baseline ltr:pr-1 rtl:pl-1 ri-user-settings-line"></i>
                    Pengaturan Akun SSO
                </a>
            </div>
        </form><!--end form-->
    </div>
</div>
@endsection

@push('scripts')
@endpush