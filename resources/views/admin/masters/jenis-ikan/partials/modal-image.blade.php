@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

{{-- Trigger Modal Edit --}}
<button data-modal-target="modal-image" id="trigger-open-modal-image" type="button"></button>

<div id="modal-image" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16" id="modal-title">Ikan: <span id="modal-title-fish"></span></h5>
            <button data-modal-close="modal-image"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <img src="" alt="" id="fish-image" class="w-full h-full rounded-md object-cover">
        </div>
    </div>
</div>

@push('scripts')
    <!-- Start Edit User (Modal) -->
    <script>
        $(document).on('click', '#btn-modal-image', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-image').click();

            var urlGetData = $(this).data('url-get');
            $('#fish-image').attr('src', urlGetData);
            $('#modal-title-fish').text($(this).data('title'));

            // Send request to get user data
            // $.ajax({
            //     url: urlGetData, // Url for get data edit
            //     type: 'GET',
            //     success: function(response) {
            //         // Modal title
            //         $('#modal-title').text('Ubah Data Jenis Ikan - ' + response.name);
            //         // Set form action
            //         $('#form-edit').attr('action', urlFormAction);
            //         // Set value to form inputs
            //         $('#form-edit').find('#name').val(response.name);
            //     },
            //     error: function(xhr) {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Error',
            //             text: 'Gagal memuat data desa.',
            //         });
            //     }
            // });
        });
    </script>
    <!-- End Edit User (Modal) -->
@endpush
