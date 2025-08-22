@extends('layouts.master')

@section('title', 'Transaksi UPTD')

@section('breadcrumb')
    {{ Breadcrumbs::render('laporan.transaksi-uptd') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Transaksi UPTD</h5>
                {{-- <button type="button" href="" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Transaksi UPTD
                </button> --}}
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="ltr:!text-left rtl:!text-right">Invoice ID</th>
                        <th class="ltr:!text-left rtl:!text-right">Tanggal Transaksi</th>
                        <th class="ltr:!text-left rtl:!text-right">Pembeli</th>
                        <th class="ltr:!text-left rtl:!text-right">UPTD</th>
                        <th class="ltr:!text-left rtl:!text-right">Petugas</th>
                        <th class="ltr:!text-left rtl:!text-right">Nominal</th>
                        <th class="text-center">Aksi</th>
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

    {{-- Modal Add --}}
    {{-- @include('admin.kelolas.stok-ikan.partials.modal-add') --}}
    {{-- Modal Edit --}}
    @include('admin.laporans.transaksi-uptd.partials.modal-show')
    {{-- Form Delete --}}
    {{-- <form id="form-delete" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form> --}}
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
                    url: "{{ route('laporan.transaksi-uptd.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'invoice_id',
                        name: 'invoice_id',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'transaction_at',
                        name: 'created_at',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'uptd.name',
                        name: 'uptd.name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'staff.name',
                        name: 'staff.name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'total',
                        name: 'total',
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
