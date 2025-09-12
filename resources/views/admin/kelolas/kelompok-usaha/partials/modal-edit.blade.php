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
        <form action="" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                {{-- Kelompok Binaan --}}
                <div class="">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kelompok Binaan <strong
                            class="text-red-500">*</strong></label>
                    <small>Pilih kelompok binaan yang ingin dijadikan kelompok usaha.</small>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kelompok_binaan_id" id="kelompok_binaan_id" required>
                            <option value="">Pilih Kelompok Binaan</option>
                        @foreach ($kelompokBinaans as $kelompokBinaan)
                            <option value="{{ $kelompokBinaan->id }}">{{ $kelompokBinaan->name }} - [{{ $kelompokBinaan->jenis_usahas->pluck('name')->implode(', ') }}]</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- Nama --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Nama <strong
                                    class="text-red-500">*</strong></label>
                            <input type="text" id="name" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan nama kelompok" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Telepon --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">CP <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="phone" name="phone"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- Ketua --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Ketua <strong
                                    class="text-red-500">*</strong></label>
                            <input type="text" id="leader" name="leader"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan nama ketua" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Anggota --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Anggota <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="members" name="members"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan jumlah anggota" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Tahun --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Tahun Berdiri <strong
                                    class="text-red-500">*</strong></label>
                            <input type="number" id="year" name="year"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan tahun berdiri" required>
                        </div>
                    </div>
                </div>
                {{-- Kalurahan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kalurahan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kalurahan_id" id="kalurahan_id">
                        <option value=""></option>
                        @foreach ($kalurahans as $kal)
                            <option value="{{ $kal->id }}">
                                {{ $kal->name . ' - ' . $kal->kecamatan->name . ' - ' . $kal->kecamatan->kabupaten->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- NIB --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">NIB <strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="nib" name="nib"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan NIB kelompok usaha" required>
                </div>
                {{-- Bentuk Usaha & Penghasilan --}}
                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- Bentuk Usaha --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Bentuk Usaha <strong
                                    class="text-red-500">*</strong></label>
                            <select
                                class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                name="bentuk_usaha_id" id="bentuk_usaha_id" required>
                                <option value="">Pilih Bentuk Usaha</option>
                                @foreach ($bentukUsahas as $bentukUsaha)
                                    <option value="{{ $bentukUsaha->id }}">{{ $bentukUsaha->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span">
                        {{-- Penghasilan --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Range Penghasilan <strong
                                    class="text-red-500">*</strong></label>
                            <select name="income_range" id="income_range"
                                class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                required>
                                <option value="">Pilih Range Penghasilan</option>
                                @foreach ($rangePenghasilans as $range)
                                    <option value="{{ $range->name }}">{{ $range->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Alamat --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Alamat <strong
                            class="text-red-500">*</strong></label>
                    <textarea id="address" name="address"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        rows="3" placeholder="Masukkan alamat sekretariat" required></textarea>
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
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
            // Send request to get user data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // Modal title
                    $('#modal-title').text('Ubah Data Kelompok Usaha - ' + response.name);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#name').val(response.name);
                    $('#form-edit').find('#address').val(response.address);
                    $('#form-edit').find('#phone').val(response.phone);
                    $('#form-edit').find('#leader').val(response.leader);
                    $('#form-edit').find('#members').val(response.members);
                    $('#form-edit').find('#year').val(response.year);
                    $('#form-edit').find('#nib').val(response.nib);
                    $('#form-edit').find('#kelompok_binaan_id').val(response.kelompok_binaan_id).trigger('change');
                    $('#form-edit').find('#income_range').val(response.income_range).trigger('change');
                    $('#form-edit').find('#bentuk_usaha_id').val(response.bentuk_usaha_id).trigger('change');
                    $('#form-edit').find('#kalurahan_id').val(response.kalurahan_id).trigger('change');
                    // Because kelompokBinaans has filter, just show kelompok binaan is'nt have kelompok usaha. So attach data this kelompok binaan has selected in the input #kelompok_binaan_id, then selected this attached data
                    if (response.kelompok_binaan) {
                        // If option not exist, append it to select input then select it
                        var newOption = new Option(
                            response.kelompok_binaan.name + ' - [' + response.kelompok_binaan.jenis_usahas.map(j => j.name).join(', ') + ']',
                            response.kelompok_binaan.id,
                            true,
                            true
                        );
                        // Remove existing option with same value if exists
                        $('#form-edit').find('#kelompok_binaan_id option[value="' + response.kelompok_binaan.id + '"]').remove();
                        // Prepend the new option to the top
                        $('#form-edit').find('#kelompok_binaan_id').prepend(newOption).trigger('change');
                    }
                    

                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data kelompok usaha.',
                    });
                }
            });
        });
    </script>
@endpush
