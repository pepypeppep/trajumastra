{{-- Trigger Modal Edit --}}
<button data-modal-target="modal-file" id="trigger-open-modal-file" type="button"></button>

<div id="modal-file" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen lg:w-[55rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Lampiran Materi</h5>
            <button data-modal-close="modal-file"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="p-4 overflow-y-auto" style="height: calc(100vh - 10rem);">
            <object id="pdf-viewer" data="" type="application/pdf" width="100%" height="100%">
                <p>Browser Anda tidak mendukung untuk menampilkan PDF. Anda dapat <a id="pdf-download"
                        class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20"
                        href="">mengunduh
                        PDF</a> sebagai gantinya.
                </p>
            </object>
        </div>
    </div>
</div>

@push('scripts')
    <!-- Start Edit User (Modal) -->
    <script>
        $(document).on('click', '#btn-modal-file', function(e) {
            // Trigger button to open modal
            $('#trigger-open-modal-file').click();

            var urlGetData = $(this).data('url-get');
            $('#pdf-viewer').attr('data', urlGetData);
            $('#pdf-download').attr('href', urlGetData);
        });
    </script>
    <!-- End Edit User (Modal) -->
@endpush
