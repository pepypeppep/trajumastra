    {{-- Trigger Button Modal --}}
    <button data-modal-target="modal-show-jadwal" id="trigger-open-modal-show-jadwal" type="button"></button>
    
    <div id="modal-show-jadwal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div
            class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div
                class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16" id="modal-title">Detail Jadwal Pendampingan</h5>
                <button data-modal-close="modal-show-jadwal"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <div class="space-y-4">
                    <div class="">
                        <h6 class="text-sm font-semibold">Nama</h6>
                        <p class="text-14 text-slate-600 dark:text-zink-300" id="name"></p>
                    </div>

                    <div class="mt-5">
                        <h6 class="text-sm font-semibold">Deskripsi</h6>
                        <div class=" text-slate-600 dark:text-zink-300" id="description"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-5">
                        <div>
                            <h6 class="text-sm font-semibold">Jenis Penyuluhan</h6>
                            <p class="text-14 text-slate-600 dark:text-zink-300" id="jenis-penyuluhan"></p>
                        </div>

                        <div>
                            <h6 class="text-sm font-semibold">Kategori</h6>
                            <p class="text-14 text-slate-600 dark:text-zink-300" id="kategori"></p>
                        </div>

                        <div>
                            <h6 class="text-sm font-semibold">Kuota</h6>
                            <p class="text-14 text-slate-600 dark:text-zink-300" id="quota"></p>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h6 class="text-sm font-semibold">Penyuluh</h6>
                        <p class="text-14 text-slate-600 dark:text-zink-300" id="penyuluh"></p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                        <div>
                            <h6 class="text-sm font-semibold">Mulai</h6>
                            <p class="text-14 text-slate-600 dark:text-zink-300" id="start"></p>
                        </div>

                        <div>
                            <h6 class="text-sm font-semibold">Selesai</h6>
                            <p class="text-14 text-slate-600 dark:text-zink-300" id="end"></p>
                        </div>
                    </div>

                    {{-- START: File Attachment --}}
                    <div class="mt-5">
                        <h6 class="text-sm font-semibold">File Lampiran</h6>
                        {{-- Button download --}}
                        <a href="" class="btn-download-attachment btn mt-2 px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20">
                            <i class="ri-download-line"></i> Download File Lampiran
                        </a>
                        <p class="not-have-attachment">-</p>
                    </div>
                    {{-- END: File Attachment --}}
                </div>
            </div>
            {{-- End Modal Body --}}
        </div>
    </div>