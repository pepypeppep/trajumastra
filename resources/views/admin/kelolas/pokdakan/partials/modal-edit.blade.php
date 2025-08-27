@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

{{-- Trigger Modal Edit --}}
<button data-modal-target="modal-edit" id="trigger-open-modal-edit" type="button"></button>

<div id="modal-edit" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16" id="modal-title">Ubah Pokdakan</h5>
            <button data-modal-close="modal-edit"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="#" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
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
                {{-- Jenis Ikan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Ikan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_ikan_id[]" id="jenis_ikan_id" multiple>
                        @foreach ($jenis_ikans as $jenis_ikan)
                            <option value="{{ $jenis_ikan->id }}">{{ $jenis_ikan->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Jenis Usaha --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Usaha <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_usaha_id[]" id="jenis_usaha_id" multiple>
                        @foreach ($jenis_usahas as $jenis_usaha)
                            <option value="{{ $jenis_usaha->id }}">{{ $jenis_usaha->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Jenis Kolam --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Kolam <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_kolam_id[]" id="jenis_kolam_id" multiple>
                        @foreach ($jenis_kolams as $jenis_kolam)
                            <option value="{{ $jenis_kolam->id }}">{{ $jenis_kolam->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Kalurahan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kalurahan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kalurahan_id" id="kalurahan_id">
                        <option value=""></option>
                        @foreach ($kals as $kal)
                            <option value="{{ $kal->id }}">
                                {{ $kal->name . ' - ' . $kal->kecamatan->name . ' - ' . $kal->kecamatan->kabupaten->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Alamat --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Alamat <strong
                            class="text-red-500">*</strong></label>
                    <textarea id="address" name="address"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        rows="3" placeholder="Masukkan alamat" required></textarea>
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
    <!-- Start Edit User (Modal) -->
    <script>
        $(document).on('click', '#btn-modal-edit', function(e) {
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
                    $('#modal-title').text('Ubah Data Pokdakan - ' + response.name);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#name').val(response.name);
                    $('#form-edit').find('#address').val(response.address);
                    $('#form-edit').find('#phone').val(response.phone);
                    $('#form-edit').find('#leader').val(response.leader);
                    $('#form-edit').find('#members').val(response.members);
                    $('#form-edit').find('#year').val(response.year);
                    $('#form-edit').find('#kalurahan_id').val(response.kalurahan_id).trigger('change');

                    // ==== Jenis Ikan (multiple select2 with tags) ====
                    let jenisIkanSelect = $('#form-edit').find('select[name="jenis_ikan_id[]"]');

                    response.jenis_ikans.forEach(function(item) {
                        // append option dynamically
                        let option = new Option(item.name, item.id, true, true);
                        jenisIkanSelect.append(option);
                    });

                    // Refresh select2
                    jenisIkanSelect.trigger('change');

                    // ==== Jenis Usaha (multiple select2 with tags) ====
                    let jenisUsahaSelect = $('#form-edit').find('select[name="jenis_usaha_id[]"]');

                    response.jenis_usahas.forEach(function(item) {
                        // append option dynamically
                        let option = new Option(item.name, item.id, true, true);
                        jenisUsahaSelect.append(option);
                    });

                    // Refresh select2
                    jenisUsahaSelect.trigger('change');

                    // ==== Jenis Kolam (multiple select2 with tags) ====
                    let jenisKolamSelect = $('#form-edit').find('select[name="jenis_kolam_id[]"]');

                    response.jenis_kolams.forEach(function(item) {
                        // append option dynamically
                        let option = new Option(item.name, item.id, true, true);
                        jenisKolamSelect.append(option);
                    });

                    // Refresh select2
                    jenisKolamSelect.trigger('change');

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
    <!-- End Edit User (Modal) -->
@endpush
