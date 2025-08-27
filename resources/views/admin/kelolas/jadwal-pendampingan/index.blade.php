@extends('layouts.master')

@section('title', 'Jadwal Pendampingan')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.jadwal-pendampingan') }}
@endsection


@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Jadwal Pendampingan atau Penyuluhan</h5>
                <button type="button" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Jadwal Pendampingan
                </button>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center-">Judul Penyuluhan</th>
                        <th class="text-left">Jenis Penyuluhan</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">Kuota</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Materi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="text-gray-500 dark:text-zink-300">Memuat data Jadwal Pendampingan</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Load modal add --}}
    @include('admin.kelolas.jadwal-pendampingan.partials.modal-add')
    {{-- Load modal edit --}}
    @include('admin.kelolas.jadwal-pendampingan.partials.modal-edit')
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
                    url: "{{ route('kelola.jadwal-pendampingan.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        width: '20%',
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'jenis_penyuluhan_name',
                        name: 'jenis_penyuluhan_name',
                        searchable: true,
                        orderable: true,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'description',
                        name: 'description',
                        searchable: true,
                        orderable: true,
                        width: '20%',
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'quota',
                        name: 'quota',
                        searchable: true,
                        orderable: true,
                        width: '5%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'periode',
                        name: 'periode',
                        searchable: true,
                        orderable: false,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'status',
                        name: 'status',
                        searchable: true,
                        orderable: false,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'materi_title',
                        name: 'materi_title',
                        searchable: true,
                        orderable: false,
                        width: '15%',
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },
                    
                    // etc kelompok-binaan
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


    {{-- Start Select 2 --}}
    <script>
        // Init global Select2
        function initSelect2JenisPenyuluhan(context) {
            $(context).find('[name="jenis_penyuluhan_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Jenis Penyuluhan",
                allowClear: true
            });
        }

        function initSelect2Penyuluh(context) {
            $(context).find('[name="penyuluh_id[]"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Penyuluh / Pemateri",
                allowClear: true
            });
        }
        
        function initSelect2KategoriPenyuluhan(context) {
            $(context).find('[name="kategori_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Kategori Penyuluhan",
                allowClear: true
            });
        }
        
        function initSelect2MateriPenyuluhan(context) {
            $(context).find('[name="materi_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Materi Penyuluhan",
                allowClear: true
            });
        }

        function initSelect2StatusPenyuluhan(context) {
            $(context).find('[name="status"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Status Jadwal Penyuluhan",
                allowClear: true
            });
        }

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2JenisPenyuluhan('#modal-add');
            initSelect2KategoriPenyuluhan('#modal-add');
            initSelect2MateriPenyuluhan('#modal-add');
            initSelect2StatusPenyuluhan('#modal-add');
            initSelect2Penyuluh('#modal-add');
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2JenisPenyuluhan('#modal-edit');
            initSelect2KategoriPenyuluhan('#modal-edit');
            initSelect2MateriPenyuluhan('#modal-edit');
            initSelect2StatusPenyuluhan('#modal-edit');
            initSelect2Penyuluh('#modal-edit');
        });
    </script>
    {{-- End Select 2 --}}
@endpush