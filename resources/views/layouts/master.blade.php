<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ $prefs_composer['app_name'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset($prefs_composer['favicon']) }}">

    @include('layouts.head-css')
    <!-- Styles -->
    @livewireStyles
</head>

@include('layouts.body')

<div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
    <!-- sidebar -->
    @include('layouts.sidebar')
    <!-- topbar -->
    @include('layouts.topbar')
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <!-- page wrapper -->
        @include('layouts.page-wrapper')

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <!-- Start Page Title Breadcrumb -->
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <div class="flex items-center gap-2">
                        <h5 class="text-16">@yield('title')</h5>
                        @if (request()->routeIs('dashboard') || request()->routeIs('laporan.*'))
                            <div>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices name="uptd_id" id="uptd_id"
                                    onchange="window.location.href = '{{ request()->url() }}?uptd=' + this.value;">
                                    <option value="">Pilih UPTD</option>
                                    @foreach ($uptds as $uptd)
                                        <option value="{{ $uptd->id }}"
                                            {{ request()->uptd == $uptd->id ? 'selected' : '' }}>{{ $uptd->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    @yield('breadcrumb')
                </ul>
            </div>
            <!-- End Page Title Breadcrumb -->

            <!-- Start content -->
            @yield('content-admin')
            <!-- End content -->
        </div>
    </div>
    <!-- End Page-content -->
    <!-- footer -->
    @include('layouts.footer')
</div>
</div>
<!-- end main content -->
@stack('modals')
@include('layouts.customizer')
@include('layouts.footer-scripts')

@livewireScripts
</body>

</html>
