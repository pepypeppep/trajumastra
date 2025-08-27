@extends('layouts.master')

@section('title', 'Kelola Pokdakan')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.pokdakan') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Pokdakan</h5>
                <button type="button" href="" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Pokdakan
                </button>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="ltr:!text-left rtl:!text-right">Nama</th>
                        <th class="ltr:!text-left rtl:!text-right">Kalurahan</th>
                        <th class="ltr:!text-left rtl:!text-right">Alamat</th>
                        <th class="ltr:!text-left rtl:!text-right">Ketua</th>
                        <th class="ltr:!text-left rtl:!text-right">Anggota</th>
                        <th class="ltr:!text-left rtl:!text-right">Jenis Ikan</th>
                        <th class="ltr:!text-left rtl:!text-right">Jenis Usaha</th>
                        <th class="ltr:!text-left rtl:!text-right">Jenis Kolam</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="7">
                            <div class="flex justify-center items-center">
                                <span class="text-gray-500 dark:text-zink-300">Memuat data ...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Add --}}
    @include('admin.kelolas.pokdakan.partials.modal-add')
    {{-- Modal Edit --}}
    @include('admin.kelolas.pokdakan.partials.modal-edit')
    {{-- Modal Map --}}
    {{-- @include('admin.kelolas.pokdakan.partials.modal-map') --}}
    {{-- Form Delete --}}
    <form id="form-delete" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('css')
    <!-- leaflet plugin -->
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/leaflet/esri-leaflet-geocoder.css') }}">
@endpush
@push('scripts')
    <script src="{{ URL::asset('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <!--buttons dataTables-->
    <script src="{{ URL::asset('assets/js/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables/buttons.print.min.js') }}"></script>
    <!-- leaflet plugin -->
    <script src="{{ URL::asset('assets/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet-geocoder.js') }}"></script>

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

        function initSelect2JenisIkan(context) {
            $(context).find('[name="jenis_ikan_id[]"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Jenis Ikan",
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ' '],
                multiple: true
            });
        }

        function initSelect2JenisUsaha(context) {
            $(context).find('[name="jenis_usaha_id[]"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Jenis Usaha",
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ' '],
                multiple: true
            });
        }

        function initSelect2JenisKolam(context) {
            $(context).find('[name="jenis_kolam_id[]"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Jenis Kolam",
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ' '],
                multiple: true
            });
        }

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2Kalurahan('#modal-add');
            initSelect2JenisIkan('#modal-add');
            initSelect2JenisUsaha('#modal-add');
            initSelect2JenisKolam('#modal-add');
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2Kalurahan('#modal-edit');
            initSelect2JenisIkan('#modal-edit');
            initSelect2JenisUsaha('#modal-edit');
            initSelect2JenisKolam('#modal-edit');
        });
    </script>
    {{-- End Select 2 --}}

    {{-- Start Implement datatable --}}
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
                    url: "{{ route('kelola.pokdakan.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'kalurahan.name',
                        name: 'kalurahan.name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'address',
                        name: 'address',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'leader',
                        name: 'leader',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'members',
                        name: 'members',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'jenis_ikan_data',
                        name: 'jenis_ikan_data',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'jenis_usaha_data',
                        name: 'jenis_usaha_data',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'jenis_kolam_data',
                        name: 'jenis_kolam_data',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'text-center'
                    },
                ],
            })
        }
        // -- End Load Datatable
    </script>
    {{-- End Implement datatable --}}

    {{-- Start action delete data --}}
    <script>
        $(document).on('click', '#btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
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
@endpush
