<div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
    <div class="grow">
        <h5 class="text-16">@yield('title')</h5>
    </div>
    <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
        @yield('breadcrumb')
    </ul>
</div>