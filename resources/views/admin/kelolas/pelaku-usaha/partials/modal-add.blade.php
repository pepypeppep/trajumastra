<div id="modal-add" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Tambah Pelaku Usaha Baru</h5>
            <button data-modal-close="modal-add"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.pelaku-usaha.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4">
                    {{-- Nama Pelaku Usaha --}}
                    <div class="col-span">
                        <div class="mt-3">
                            <label for="name" class="inline-block text-base font-medium">
                                Nama Pelaku Usaha <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" id="name" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan Nama Pelaku Usaha" required>
                        </div>
                    </div>

                    {{-- Email pelaku usaha --}}
                    <div class="col-span">
                        <div class="mt-3">
                            <label for="email" class="inline-block text-base font-medium">
                                Email Pelaku Usaha <strong class="text-red-500">*</strong>
                            </label>
                            <input type="email" id="email" name="email"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan Email Pelaku Usaha" required>
                        </div>
                    </div>
                </div>

                {{-- Kelurahan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kalurahan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kalurahan_id" id="kalurahan_id">
                        <option value="">Pilih Kalurahan</option>
                        @foreach ($kalurahans as $kalurahan)
                            <option value="{{ $kalurahan->id }}">{{ $kalurahan->name }},
                                {{ $kalurahan->kecamatan->name }}, {{ $kalurahan->kecamatan->kabupaten->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Alamat --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Alamat <strong
                            class="text-red-500">*</strong></label>
                    <textarea name="address"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        id="" rows="3"></textarea>
                </div>

                {{-- Jenis Usaha --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Usaha <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_usaha_id" id="jenis_usaha_id">
                        <option value="">Pilih Jenis Usaha</option>
                        @foreach ($jenisUsahas as $jenisUsaha)
                            <option value="{{ $jenisUsaha->id }}">{{ $jenisUsaha->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Bentuk Usaha --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Bentuk Usaha <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="bentuk_usaha_id" id="bentuk_usaha_id">
                        <option value="">Pilih Bentuk Usaha</option>
                        @foreach ($bentukUsahas as $bentukUsaha)
                            <option value="{{ $bentukUsaha->id }}">{{ $bentukUsaha->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelompok Binaan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kelompok Binaan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kelompok_binaan_id" id="kelompok_binaan_id">
                        <option value="">Pilih Kelompok Binaan</option>
                        @foreach ($kelompokBinaans as $kelompokBinaan)
                            <option value="{{ $kelompokBinaan->id }}">{{ $kelompokBinaan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- NPWP --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">NPWP <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="npwp" name="npwp"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan NPWP" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- NIB --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">NIB <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="siup" name="siup"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan NIB" required>
                        </div>
                    </div>
                </div>

                {{-- Range Penghasilan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Range Penghasilan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="income_range" id="income_range">
                        <option value="">Pilih Range Penghasilan</option>
                        @foreach ($rangePenghasilans as $rangePenghasilan)
                            <option value="{{ $rangePenghasilan->name }}">{{ $rangePenghasilan->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Have a Ship ? --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Punya Kapal <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="have_ship" id="have_ship" required>
                        <option value="">Pilih Punya Kapal</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                {{-- Start: Attachment --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Lampiran File<strong
                            class="text-red-500">*</strong></label>
                    <div class="mb-2">
                        <small class="text-gray-500">Jenis file yang diperbolehkan adalah PDF, JPG, JPEG, PNG dengan
                            ukuran maksimal 10MB. Anda dapat melampirkan dokumen pendukung lainnya jika diperlukan disini.</small>
                    </div>
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
