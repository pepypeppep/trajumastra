<div id="modal-add" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Tambah Materi Baru</h5>
            <button data-modal-close="modal-add"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                {{-- Judul --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Judul <strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="title" name="title"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan judul" required>
                </div>
                {{-- Tag --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Tag <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="multiple form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="tag[]" id="tag">
                    </select>
                </div>
                {{-- Deskripsi --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Deskripsi <strong
                            class="text-red-500">*</strong></label>
                    <textarea id="description" name="description"
                        class="ckeditor-classic form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:bg-zink-700 dark:text-zink-100 placeholder:text-slate-400"
                        required> </textarea>
                </div>
                {{-- Lampiran --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Lampiran <strong
                            class="text-red-500">*</strong></label>
                    <input type="file" id="attachment" name="attachment"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        accept="application/pdf,image/jpeg,image/png,image/jpg" required>
                </div>
            </div>
            {{-- End Modal Body --}}
            {{-- Start Modal Footer --}}
            <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                <button type="submit"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
                    <i class="ri-save-line"></i> Simpan
                </button>
            </div>
            {{-- End Modal Footer --}}
        </form>
    </div>
</div>
