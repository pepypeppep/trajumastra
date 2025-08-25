@extends('layouts.master')

@section('title', 'Kelola Pelaku Usaha')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.pelaku-usaha') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Pelaku Usaha</h5>
                <button type="button" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Pelaku Usaha
                </button>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 30%;">Nama Ketua Binaan</th>
                        <th class="text-center" style="width: 15%;">Kelompok Binaan</th>
                        <th class="text-center" style="width: 10%;">Email Ketua Binaan</th>
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
            status: '',
            pilar: '',
            keyword: ''
        }
        loadTable(filter);

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
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'kelompok_binaan.name',
                        name: 'kelompok_binaan.name',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'siup',
                        name: 'siup',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'npwp',
                        name: 'npwp',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'address',
                        name: 'address',
                        searchable: true,
                        orderable: true,
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
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

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2Kalurahan('#modal-add');
            initSelect2JenisUsaha('#modal-add');
            initSelect2BentukUsaha('#modal-add');
            initSelect2KelompokBinaan('#modal-add');
            initSelect2RangePenghasilan('#modal-add');

            setTimeout(() => {
                if (mapAdd) {
                    mapAdd.invalidateSize();
                }
            }, 100);
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2Kalurahan('#modal-edit');
            initSelect2JenisUsaha('#modal-edit');
            initSelect2BentukUsaha('#modal-edit');
            initSelect2KelompokBinaan('#modal-edit');
            initSelect2RangePenghasilan('#modal-edit');

            setTimeout(() => {
                if (mapEdit) {
                    mapEdit.invalidateSize();
                }
            }, 100);
        });
    </script>
    {{-- End Select 2 --}}
@endpush
