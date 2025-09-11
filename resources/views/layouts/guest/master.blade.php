<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden scroll-smooth group" data-mode="light" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ $prefs_composer['app_name'] }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Tourney:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @include('layouts.head-css')
    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>

<body class="text-base bg-white text-body font-public dark:text-zink-50 dark:bg-zinc-900">
    @include('layouts.guest.navbar')

    @yield('content')

    @include('layouts.guest.footer')

    @include('layouts.guest.footer-scripts')

    @stack('scripts')
</body>

</html>
