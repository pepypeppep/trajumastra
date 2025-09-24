<div id="modal-import" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Import Pelaku Usaha</h5>
            <button data-modal-close="modal-import"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.pelaku-usaha.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col h-full">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                {{-- Start: Download Template --}}
                <div class="mt-3">
                    <div class="text-center px-4 py-3 text-sm text-red-500 border border-red-200 rounded-md md:items-center bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                        <div class="font-bold text-xl">!!! PERHATIAN !!!</div>
                        <span class="font-bold">Sebelum mengimpor data pelaku usaha, pastikan untuk mengunduh template Excel yang telah disediakan dan mengisi data sesuai dengan format yang benar. </span>
                        <div class="mt-2">
                            <a href="{{ route('kelola.pelaku-usaha.download-template-import') }}" target="_blank"
                                class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                                <i class="ri-download-2-line"></i> Download Template Excel
                            </a>
                        </div>
                    </div>
                </div>
                {{-- End: Download Template --}}

                {{-- Start: Input File --}}
                <div class="mt-3">
                    <label for="file" class="form-label">File Excel</label>
                    <input type="file" name="file" id="file" class="form-input" required>
                </div>
                {{-- End: Input File --}}
            </div>
            {{-- End Modal Body --}}
            {{-- Start Modal Footer --}}
            <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                <button type="submit"
                    class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600 w-full">
                    <i class="ri-save-line"></i> Import Data Pelaku Usaha
                </button>
            </div>
            {{-- End Modal Footer --}}
        </form>
    </div>
</div>
