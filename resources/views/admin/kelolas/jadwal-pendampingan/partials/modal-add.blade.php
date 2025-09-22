<div id="modal-add" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Tambah Jadwal Pendampingan Baru</h5>
            <button data-modal-close="modal-add"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.jadwal-pendampingan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    {{-- Nama --}}
                    <div class="col-span">
                        <label for="" class="inline-block mb-2 text-base font-medium">Nama Jadwal Penyuluhan / Pendampingan<strong
                                class="text-red-500">*</strong></label>
                        <input type="text" id="name" name="name"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Masukkan nama Jadwal Penyuluhan / Pendampingan" required>
                    </div>
                    {{-- Periode --}}
                    <div class="col-span">
                        <label for="" class="inline-block mb-2 text-base font-medium">Periode <strong
                                class="text-red-500">*</strong></label>
                        <input type="text" id="periode" name="periode"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-provider="flatpickr" data-date-format="Y-m-d" data-range-date="true"
                            placeholder="Masukkan periode Jadwal Pendampingan" required>
                    </div>
                </div>
                {{-- Deskripsi --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Deskripsi <strong
                            class="text-red-500">*</strong></label>
                    <textarea name="description" id="description"
                        class="ckeditor-classic form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        id="" rows="3"></textarea>
                </div>
                {{-- Jenis Penyuluhan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Penyuluhan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_penyuluhan_id" id="jenis_penyuluhan_id" required>
                        <option value=""></option>
                        @foreach ($jenisPenyuluhans as $jenisPenyuluhan)
                            <option value="{{ $jenisPenyuluhan->id }}">{{ $jenisPenyuluhan->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Kategori Penyuluhan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kategori Penyuluhan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kategori_id" id="kategori_id" required>
                        <option value=""></option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Tema  --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Tema<strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="theme" name="theme"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan nama Jadwal Penyuluhan / Pendampingan" required>
                </div>
                {{-- Penyuluh / Pembawa Materi --}}
                <div class="mt-3">
                    <div class="col-span">
                        <label for="" class="inline-block mb-2 text-base font-medium">Penyuluh / Pembawa Materi <strong
                            class="text-red-500">*</strong></label>
                        <select
                            class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            name="penyuluh_id[]" id="penyuluh_id" multiple required>
                            <option value=""></option>
                            @foreach ($penyuluhs as $penyuluh)
                                <option value="{{ $penyuluh->id }}">{{ $penyuluh->user->name }} ({{ $penyuluh->user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    {{-- Kuota --}}
                    <div class="col-span">
                        <label for="" class="inline-block mb-2 text-base font-medium">Kuota <strong
                                class="text-red-500">*</strong></label>
                        <input type="number" id="quota" name="quota"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Masukkan kuota" required>
                    </div>
                    {{-- Status --}}
                    <div class="col-span">
                        <label for="" class="inline-block mb-2 text-base font-medium">Status <strong
                            class="text-red-500">*</strong></label>
                        <select
                            class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            name="status" id="status" required>
                            <option value=""></option>
                            @foreach (\App\Enums\JenisPenyuluhanStatusEnum::cases() as $status)
                                    @if ($status !== \App\Enums\JenisPenyuluhanStatusEnum::NEW)
                                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Start: Attachment --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Lampiran <strong
                            class="text-red-500">*</strong></label>
                    <input type="file" id="attachment" name="attachment"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        accept="application/pdf,image/jpeg,image/png,image/jpg" required>
                </div>
                {{-- End: Attachment --}}
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



{{-- Materi
<div class="col-span">
    <label for="" class="inline-block mb-2 text-base font-medium">Materi <strong
        class="text-red-500">*</strong></label>
    <select
        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
        name="materi_id" id="materi_id" required>
        <option value=""></option>
        @foreach ($materis as $materi)
            <option value="{{ $materi->id }}">{{ $materi->title }}</option>
        @endforeach
    </select>
</div> --}}


