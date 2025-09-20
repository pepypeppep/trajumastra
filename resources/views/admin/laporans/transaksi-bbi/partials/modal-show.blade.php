{{-- Trigger Modal Show --}}
<button data-modal-target="modal-show" id="trigger-open-modal-show" type="button"></button>

<div id="modal-show" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen lg:w-[55rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16" id="modal-title">Rincian Transaksi</h5>
            <button data-modal-close="modal-show"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        {{-- Start Modal Body --}}
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <div class="!pt-0 card-body" id="modal-body-show"></div><!--end card-->
        </div>
        {{-- End Modal Body --}}
        {{-- Start Modal Footer --}}
        {{-- <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
            <button type="submit" class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
                <i class="ri-save-line"></i> Simpan
            </button>
        </div> --}}
        {{-- End Modal Footer --}}
    </div>
</div>

@push('scripts')
    <!-- Start Edit User (Modal) -->
    <script>
        $(document).on('click', '#btn-modal-show', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-show').click();

            var urlGetData = $(this).data('url-get');

            // Send request to get user data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    $("#modal-body-show").html(response);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data.',
                    });
                }
            });
        });
    </script>
    <!-- End Edit User (Modal) -->
@endpush
