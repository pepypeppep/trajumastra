@extends('layouts.master')

@section('title', 'Kelola Pelaku Usaha')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.pelaku-usaha') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex flex-wrap items-center mb-4 gap-4">
                <!-- Judul -->
                <h5 class="mb-0">Daftar Pelaku Usaha</h5>

                <!-- Filter di kanan -->
                <div class="ml-auto">
                    <select id="filterKelompokBinaan"
                        class="select2 form-input w-48 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                        <option value="">Tampilkan Semua Data</option>
                        <option value="__tanpa_kelompok__">Tanpa Kelompok Binaan</option>
                        @foreach (\App\Enums\JenisKelompokBinaanEnum::cases() as $enum)
                            <option value="{{ $enum->value }}">{{ $enum->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex gap-2">
                    <a href="{{ route('kelola.pelaku-usaha.export') }}"
                        class="btn bg-green-500 text-white hover:bg-green-600">
                        <i class="ri-upload-2-line"></i> Export
                    </a>
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
        var filter = {
            kelompok_binaan: $('#filterKelompokBinaan').val()
        }
        loadTable(filter);
        // Filter change
        $('#filterKelompokBinaan').on('change', function() {
            filter.kelompok_binaan = $(this).val();
            $('#data-table').DataTable().destroy();
            loadTable(filter);
        });

        function loadTable(filter) {
            var tbl = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: "{{ asset('assets/js/datatables/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('kelola.pelaku-usaha.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.kelompok_binaan = filter.kelompok_binaan;
                    }
                },
                columns: [{
                        data: 'user.name',
                        name: 'user.name',
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
                        data: 'user.email',
                        name: 'user.email',
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
            })
        }
        // -- End Load Datatable
    </script>

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
