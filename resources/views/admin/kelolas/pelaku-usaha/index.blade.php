@extends('layouts.master')

@section('title', 'Kelola Pelaku Usaha')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.pelaku-usaha') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4 gap-4">
                <!-- Judul -->
                <h5 class="mb-0">Daftar Pelaku Usaha</h5>

                <!-- Tombol Aksi -->
                <div class="flex gap-2">
                    <button data-url-get="{{ route('kelola.pelaku-usaha.export') }}"
                        onclick="exportData(this)"
                        class="btn bg-green-500 text-white hover:bg-green-600">
                        <i class="ri-upload-2-line"></i> Export
                    </button>
                    <button type="button" data-modal-target="modal-import"
                        class="btn bg-red-500 text-white hover:bg-red-600">
                        <i class="ri-download-2-line"></i> Import
                    </button>
                    <button type="button" data-modal-target="modal-add"
                        class="btn bg-custom-500 text-white hover:bg-custom-600">
                        <i class="ri-user-add-line"></i> Tambah
                    </button>
                </div>
            </div>

            {{-- Start: Additional Data Table Filter --}}
            <div class="flex justify-between items-center mb-4">
                <div></div>

            </div>
            {{-- End: Additional Data Table Filter --}}
            <table id="data-table" class="display stripe group" style="width:100%">
                <div class="grid items-center grid-cols-1 gap-5 xl:grid-cols-3">
                    <div>
                    </div>
                    <div>
                        <select
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-choices name="filterKelompokBinaan" id="filterKelompokBinaan">
                            <option value="">Filter Kelompok Binaan</option>
                            <option value="tanpa_kelompok">Tanpa Kelompok Binaan</option>
                            @foreach (\App\Enums\JenisKelompokBinaanEnum::cases() as $enum)
                                <option value="{{ $enum->value }}">{{ $enum->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" id="keyword"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Masukkan kata kunci">
                    </div>
                </div>
                <thead>
                    <tr>
                        <th class="text-left" style="width: 30%;">Nama Pelaku Usaha</th>
                        <th class="text-center" style="width: 15%;">Kelompok Binaan</th>
                        <th class="text-center" style="width: 10%;">Email</th>
                        <th class="text-center" style="width: 10%;">NIB</th>
                        <th class="text-center" style="width: 10%;">NPWP</th>
                        <th class="text-left" style="width: 15%;">Alamat Skretariat</th>
                        <th class="text-center" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="text-gray-500 dark:text-zink-300">Memuat data ...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Include Modal Add --}}
    @include('admin.kelolas.pelaku-usaha.partials.modal-add')
    {{-- Include Modal Edit --}}
    @include('admin.kelolas.pelaku-usaha.partials.modal-edit')
    {{-- Include Modal Import --}}
    @include('admin.kelolas.pelaku-usaha.partials.modal-import')
    {{-- Form Delete --}}
    <form id="form-delete" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <!--buttons dataTables-->
    <script src="{{ URL::asset('assets/js/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>


    {{-- Implement datatable --}}
    <script>
        // -- Start Load Datatable
        loadTable();

        function loadTable() {
            var tbl = $('#data-table').DataTable({
                processing: true,
                searching: false,
                lengthChange: false,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/js/datatables/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('kelola.pelaku-usaha.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.kelompok_binaan = $('#filterKelompokBinaan').val();
                        d.keyword = $('#keyword').val();
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    }, {
                        data: 'kelompok_binaan_data',
                        name: 'kelompok_binaan_data',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    }, {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    }, {
                        data: 'siup',
                        name: 'siup',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    }, {
                        data: 'npwp',
                        name: 'npwp',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    }, {
                        data: 'address',
                        name: 'address',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    }, {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },
                    // etc ...
                ],
            });

            // Filter change
            $('#filterKelompokBinaan').on('change', function() {
                console.log('filter changed');
                tbl.ajax.reload();
            });

            let keywordTimer;
            $('#keyword').on('keyup', function() {
                clearTimeout(keywordTimer);
                keywordTimer = setTimeout(function() {
                    tbl.ajax.reload();
                }, 500);
            });
        }
        // -- End Load Datatable
    </script>

    {{-- START : Action Export Data --}}
    <script>
        function exportData(button) {
            var urlGet = $(button).data('url-get');
            var kelompokBinaan = $('#filterKelompokBinaan').val();
            var keyword = $('#keyword').val();

            // Build query string
            const params = new URLSearchParams();
            if (kelompokBinaan) params.append('kelompok_binaan', kelompokBinaan);
            if (keyword) params.append('keyword', keyword);

            // Create Download URL
            var urlWithParams = urlGet + '?' + params.toString();

            // Open in new tab (triggers download)
            window.open(urlWithParams, '_blank');

            // Optional: Show success message after a short delay
            setTimeout(() => {
                Swal.fire({
                    title: 'Berhasil mengekspor data!',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
            }, 1000);
        }
    </script>
    {{-- END : Action Export Data --}}

    {{-- Start action delete data --}}
    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            Swal.fire({
                title: 'Yakin ingin menghapusss?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lanjutkan ke form delete
                    const form = $('#form-delete');
                    form.attr('action', urlFormAction);
                    form.submit();
                }
            })
        });
    </script>
    {{-- End action delete data --}}

    {{-- Start Select 2 --}}
    <script>
        // Init global Select2
        function initSelect2UserId(context) {
            $(context).find('[name="user_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih pengguna untuk dijadikan ketua binaan",
                allowClear: true
            });
        }

        function initSelect2Kalurahan(context) {
            $(context).find('[name="kalurahan_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Kalurahan",
                allowClear: true
            });
        }

        function initSelect2JenisUsaha(context) {
            $(context).find('[name="jenis_usaha_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Jenis Usaha",
                allowClear: true,
            });
        }

        function initSelect2BentukUsaha(context) {
            $(context).find('[name="bentuk_usaha_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Bentuk Usaha",
                allowClear: true,
            });
        }

        function initSelect2KelompokBinaan(context) {
            $(context).find('[name="kelompok_binaan_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Kelompok Binaan",
                allowClear: true,
            });
        }

        function initSelect2RangePenghasilan(context) {
            $(context).find('[name="income_range"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Range Penghasilan",
                allowClear: true,
            });
        }

        function initSelect2HaveShip(context) {
            $(context).find('[name="have_ship"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Kepemilikan Kapal",
                allowClear: true,
            });
        }

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2UserId('#modal-add');
            initSelect2Kalurahan('#modal-add');
            initSelect2JenisUsaha('#modal-add');
            initSelect2BentukUsaha('#modal-add');
            initSelect2KelompokBinaan('#modal-add');
            initSelect2RangePenghasilan('#modal-add');
            initSelect2HaveShip('#modal-add');
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2UserId('#modal-edit');
            initSelect2Kalurahan('#modal-edit');
            initSelect2JenisUsaha('#modal-edit');
            initSelect2BentukUsaha('#modal-edit');
            initSelect2KelompokBinaan('#modal-edit');
            initSelect2RangePenghasilan('#modal-edit');
            initSelect2HaveShip('#modal-edit');
        });
    </script>
    {{-- End Select 2 --}}
@endpush
