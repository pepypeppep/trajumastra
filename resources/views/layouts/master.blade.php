<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | Tailwick - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

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
                        <h5 class="text-16">@yield('title')</h5>
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
