@extends('layouts.master')

@section('title', 'Penyuluh')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.penyuluh') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Penyuluh</h5>
                <button type="button" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Penyuluh
                </button>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left">Nama Penyuluh</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Tempat, Tgl. Lahir</th>
                        <th class="text-left">Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="text-gray-500 dark:text-zink-300">Memuat data penyuluh</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Load modal add --}}
    @include('admin.kelolas.penyuluh.partials.modal-add')
    {{-- Load modal edit --}}
    @include('admin.kelolas.penyuluh.partials.modal-edit')
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
                    url: "{{ route('kelola.penyuluh.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                        width: '25%',
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'nik',
                        name: 'nik',
                        searchable: true,
                        orderable: false,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'ttl',
                        name: 'ttl',
                        searchable: true,
                        orderable: false,
                        width: '10%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },{
                        data: 'address',
                        name: 'address',
                        searchable: true,
                        orderable: false,
                        width: '40%',
                        className: 'border border-gray-300 dark:border-zink-50 text-left'
                    },{
                        data: 'aksi',
                        name: 'aksi',
                        searchable: false,
                        orderable: false,
                        width: '15%',
                        className: 'border border-gray-300 dark:border-zink-50 text-center'
                    },
                    
                    // etc Penyuluh
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
@endpush