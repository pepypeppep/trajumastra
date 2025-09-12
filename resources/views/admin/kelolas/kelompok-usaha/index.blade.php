@extends('layouts.master')

@section('title', 'Kelompok Usaha')

@section('breadcrumb')
    {{ Breadcrumbs::render('kelola.kelompok-usaha') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Kelompok usaha</h5>
                <button type="button" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Kelompok usaha
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
                        <th class="ltr:!text-left rtl:!text-right">Bentuk Usaha</th>
                        <th class="ltr:!text-left rtl:!text-right">NIB</th>
                        <th class="ltr:!text-left rtl:!text-right">Penghasilan</th>
                        <th class="ltr:!text-left rtl:!text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will be loaded here by DataTables --}}
                    <tr class="data-row">
                        <td colspan="6">
                            <div class="flex justify-center items-center">
                                <span class="text-gray-500 dark:text-zink-300">Memuat data kelompok usaha</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Load modal add --}}
    @include('admin.kelolas.kelompok-usaha.partials.modal-add')
    {{-- Load modal edit --}}
    @include('admin.kelolas.kelompok-usaha.partials.modal-edit')
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
                    url: "{{ route('kelola.kelompok-usaha.index') }}",
                    type: 'GET',
                },
                columns: [
                    {
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
                        data: 'bentuk_usaha.name',
                        name: 'bentuk_usaha.name',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'nib',
                        name: 'nib',
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'income_range',
                        name: 'income_range',
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
                    
                    // etc kelompok-usaha
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
        function initSelect2KelompokBinaan(context) {
            $(context).find('[name="kelompok_binaan_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Kelompok Binaan",
                allowClear: true
            });
        }

        function initAppendDataWhenSelectedKelompokBinaan(context) {
            // On change event
            $(context + ' #kelompok_binaan_id').on('change', function() {
                var kelompokBinaanId = $(this).val();
                if (kelompokBinaanId) {
                    $.ajax({
                        url: "{{ url('kelola/kelompok-usaha/kelompok-binaan') }}/" + kelompokBinaanId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Auto fill the form fields
                            $(context + ' #name').val(data.name);
                            $(context + ' #phone').val(data.phone);
                            $(context + ' #leader').val(data.leader);
                            $(context + ' #members').val(data.members);
                            $(context + ' #address').val(data.address);
                            $(context + ' #year').val(data.year);
                            // Set kalurahan_id hidden input
                            $(context + ' #kalurahan_id').val(data.kalurahan_id);
                        },
                        error: function() {
                            console.error('Failed to fetch kelompok binaan details.');
                        }
                    });
                } else {
                    // Clear the form fields if no kelompok binaan is selected
                    $(context + ' #name').val('');
                    $(context + ' #phone').val('');
                    $(context + ' #leader').val('');
                    $(context + ' #members').val('');
                    $(context + ' #address').val('');
                    // Clear kalurahan_id hidden input
                    $(context + ' #kalurahan_id').val('');
                }
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

        function initSelect2BentukUsaha(context) {
            $(context).find('[name="bentuk_usaha_id"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Bentuk Usaha",
                allowClear: true
            });
        }

        function initSelect2RangePenghasilan(context) {
            $(context).find('[name="income_range"]').select2({
                dropdownParent: $(context),
                width: '100%',
                placeholder: "Pilih Range Penghasilan",
                allowClear: true
            });
        }

        // Modal ADD
        $(document).on('click', '[data-modal-target="modal-add"]', function() {
            initSelect2KelompokBinaan('#modal-add');
            initAppendDataWhenSelectedKelompokBinaan('#modal-add');
            initSelect2Kalurahan('#modal-add');
            initSelect2BentukUsaha('#modal-add');
            initSelect2RangePenghasilan('#modal-add');
        });

        // Modal EDIT
        $(document).on('click', '[data-modal-target="modal-edit"]', function() {
            initSelect2KelompokBinaan('#modal-edit');
            initSelect2Kalurahan('#modal-edit');
            initSelect2BentukUsaha('#modal-edit');
            initSelect2RangePenghasilan('#modal-edit');
        });
    </script>
    {{-- End Select 2 --}}
@endpush