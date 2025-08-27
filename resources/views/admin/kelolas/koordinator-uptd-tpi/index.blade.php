@extends('layouts.master')

@section('title', 'Kelola Koordinator UPTD TPI')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.uptd-tpi') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Koordinator UPTD TPI</h5>
                <button type="button" href="" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Koordinator UPTD TPI
                </button>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Telepon</th>
                        <th class="text-center">UPTD</th>
                        <th class="text-left">Alamat</th>
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
    @include('admin.kelolas.koordinator-uptd-tpi.partials.modal-add')
    {{-- Modal Edit --}}
    @include('admin.kelolas.koordinator-uptd-tpi.partials.modal-edit')
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

    {{-- Start Select 2 --}}
    <script>
        // Init global Select2
        function initSelect2UserId(context) {
            $(context).find('select[name="user_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih pengguna yang ingin dijadikan koordinator UPTD",
                allowClear: true
            });
        }

        function initSelect2UptdId(context) {
            $(context).find('select[name="uptd_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih UPTD",
                allowClear: true
            });
        }

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2UserId('#modal-add');
            initSelect2UptdId('#modal-add');
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2UserId('#modal-edit');
            initSelect2UptdId('#modal-edit');
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
                    url: "{{ route('kelola.koordinator-uptd-tpi.index') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'user.name',
                        name: 'user.name',
                        searchable: true,
                        orderable: true,
                        className: 'dark:border-zink-50 text-left'
                    }, {
                        data: 'user.email',
                        name: 'user.email',
                        searchable: true,
                        orderable: true,
                        className: 'dark:border-zink-50 text-center'
                    },{
                        data: 'user.phone',
                        name: 'user.phone',
                        searchable: true,
                        orderable: true,
                        className: 'dark:border-zink-50 text-center'
                    }, {
                        data: 'uptd.name',
                        name: 'uptd.name',
                        searchable: true,
                        orderable: true,
                        className: 'dark:border-zink-50 text-center'
                    }, {
                        data: 'user.address',
                        name: 'user.address',
                        searchable: true,
                        orderable: true,
                        className: 'dark:border-zink-50 text-left'
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
