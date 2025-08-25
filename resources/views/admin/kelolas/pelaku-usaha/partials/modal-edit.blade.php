{{-- Trigger button modal edit --}}
<button data-modal-target="modal-edit" id="trigger-open-modal-edit" type="button"></button>

{{-- Modal Edit --}}
<div id="modal-edit" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16" id="modal-title"></h5>
            <button data-modal-close="modal-edit"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.pelaku-usaha.store') }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <div class="grid grid-cols-3 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- Nama --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Nama Ketua Binaan<strong
                                    class="text-red-500">*</strong></label>
                            <input type="text" id="name" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan nama" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Email --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Email Ketua Binaan <strong
                                    class="text-red-500">*</strong></label>
                            <input type="email" id="email" name="email"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan email" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- No Hp --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">No Hp. Ketuan Binaan <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="phone" name="phone"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan no hp" required>
                        </div>
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Alamat Sekretariat <strong
                        class="text-red-500">*</strong></label>
                    <textarea name="address"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        id="address" rows="3"></textarea>
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
                            <option value="{{ $kalurahan->id }}">{{ $kalurahan->name }}, {{ $kalurahan->kecamatan->name }}, {{ $kalurahan->kecamatan->kabupaten->name }}</option>
                        @endforeach
                    </select>
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

@push('scripts')
    <script>
        $(document).on('click', '.btn-modal-edit', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-edit').click();

            // User Id
            var userId = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
            // Send request to get user data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    // Modal title
                    $('#modal-title').text('Ubah Data UPTD - ' + response.name);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#name').val(response.name);
                    $('#form-edit').find('#email').val(response.email);
                    $('#form-edit').find('#phone').val(response.phone);
                    $('#form-edit').find('#address').val(response.address);
                    $('#form-edit').find('#npwp').val(response.npwp);
                    $('#form-edit').find('#siup').val(response.siup);
                    $('#form-edit').find('#kalurahan_id').val(response.kalurahan_id).trigger('change');
                    $('#form-edit').find('#jenis_usaha_id').val(response.jenis_usaha_id).trigger('change');
                    $('#form-edit').find('#bentuk_usaha_id').val(response.bentuk_usaha_id).trigger('change');
                    $('#form-edit').find('#kelompok_binaan_id').val(response.kelompok_binaan_id).trigger('change');
                    $('#form-edit').find('#income_range').val(response.income_range).trigger('change');

                    // ==== Jenis Ikan (multiple select2 with tags) ====
                    let $jenisIkanSelect = $('#form-edit').find('select[name="jenis_ikan_id[]"]');

                    response.jenis_ikans.forEach(function(item) {
                        // append option dynamically
                        let option = new Option(item.name, item.id, true, true);
                        $jenisIkanSelect.append(option);
                    });

                    // Refresh select2
                    $jenisIkanSelect.trigger('change');

                    initMapEdit(response.latitude, response.longitude);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data desa.',
                    });
                }
            });
        });
    </script>
@endpush
