@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

{{-- Trigger Modal Edit --}}
<button data-modal-target="modal-map" id="trigger-open-modal-map" type="button"></button>

<div id="modal-map" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen lg:w-[55rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Map UPTD</h5>
            <button data-modal-close="modal-map"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="p-4 overflow-y-auto" style="height: calc(100vh - 10rem);">
            <div id="leaflet-map-custom-icons" class="leaflet-map"></div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Start Edit User (Modal) -->
    <script>
        $(document).on('click', '#btn-modal-map', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-map').click();

            // User Id
            var userId = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
        });
    </script>
    <!-- End Edit User (Modal) -->
@endpush
