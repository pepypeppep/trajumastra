@extends('layouts.master')

@section('title', 'Transaksi BBI')

@section('breadcrumb')
    {{ Breadcrumbs::render('laporan.transaksi-bbi') }}
@endsection

@section('content-admin')
    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3 cursor-pointer"
            onclick="location.href='?periode=hari'">
            <div class="card-body">
                <div class="mt-4 mb-6 text-center">
                    <h6 class="text-16"><a href="#!">Hari ini</a></h6>
                    <p class="text-slate-500 dark:text-zink-200">Data transaksi hari ini</p>
                </div>
                <div
                    class="grid grid-cols-1 gap-5 text-center divide-y md:divide-y-0 md:divide-x sm:grid-cols-3 2xl:grid-cols-12 divide-slate-200 divide-dashed dark:divide-zink-500 rtl:divide-x-reverse">
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->today->count }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Terjual</p>
                    </div><!--end col-->
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->today->sum }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Pendapatan</p>
                    </div><!--end col-->
                </div><!--end grid-->
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3 cursor-pointer"
            onclick="location.href='?periode=bulan'">
            <div class="card-body">
                <div class="mt-4 mb-6 text-center">
                    <h6 class="text-16"><a href="#!">Bulan ini</a></h6>
                    <p class="text-slate-500 dark:text-zink-200">Data transaksi bulan ini</p>
                </div>
                <div
                    class="grid grid-cols-1 gap-5 text-center divide-y md:divide-y-0 md:divide-x sm:grid-cols-3 2xl:grid-cols-12 divide-slate-200 divide-dashed dark:divide-zink-500 rtl:divide-x-reverse">
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->month->count }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Terjual</p>
                    </div><!--end col-->
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->month->sum }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Pendapatan</p>
                    </div><!--end col-->
                </div><!--end grid-->
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3 cursor-pointer"
            onclick="location.href='?periode=tahun'">
            <div class="card-body">
                <div class="mt-4 mb-6 text-center">
                    <h6 class="text-16"><a href="#!">Tahun ini</a></h6>
                    <p class="text-slate-500 dark:text-zink-200">Data transaksi tahun ini</p>
                </div>
                <div
                    class="grid grid-cols-1 gap-5 text-center divide-y md:divide-y-0 md:divide-x sm:grid-cols-3 2xl:grid-cols-12 divide-slate-200 divide-dashed dark:divide-zink-500 rtl:divide-x-reverse">
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->year->count }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Terjual</p>
                    </div><!--end col-->
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->year->sum }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Pendapatan</p>
                    </div><!--end col-->
                </div><!--end grid-->
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-3 cursor-pointer"
            onclick="location.href='/laporan/transaksi-bbi'">
            <div class="card-body">
                <div class="mt-4 mb-6 text-center">
                    <h6 class="text-16"><a href="#!">Selama ini</a></h6>
                    <p class="text-slate-500 dark:text-zink-200">Data transaksi selama ini</p>
                </div>
                <div
                    class="grid grid-cols-1 gap-5 text-center divide-y md:divide-y-0 md:divide-x sm:grid-cols-3 2xl:grid-cols-12 divide-slate-200 divide-dashed dark:divide-zink-500 rtl:divide-x-reverse">
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->all->count }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Terjual</p>
                    </div><!--end col-->
                    <div class="p-2 2xl:col-span-6">
                        <h6 class="mb-1">{{ $revenue->all->sum }}</h6>
                        <p class="text-slate-500 dark:text-zink-200">Pendapatan</p>
                    </div><!--end col-->
                </div><!--end grid-->
            </div>
        </div><!--end col-->
    </div>

    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Transaksi BBI {{ request('periode') ? '(' . request('periode') . ' ini)' : '' }}
                </h5>
                {{-- <button type="button" href="" data-modal-target="modal-add"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                    <i class="ri-user-add-line"></i> Tambah Transaksi BBI
                </button> --}}
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <div class="grid items-center grid-cols-1 gap-5 xl:grid-cols-3">
                    <div>
                        <select
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-choices name="uptd_id" id="uptd_id">
                            <option value="">Pilih UPTD</option>
                            @foreach ($uptds as $uptd)
                                <option value="{{ $uptd->id }}">{{ $uptd->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" id="date"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Pilih Tanggal" data-provider="flatpickr" data-date-format="d F Y" data-mode="range"
                            readonly="readonly" required>
                    </div>
                    <div>
                        <input type="text" id="keyword"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Masukkan kata kunci">
                    </div>
                </div>
                <thead>
                    <tr>
                        <th class="ltr:!text-left rtl:!text-right">Invoice ID</th>
                        <th class="ltr:!text-left rtl:!text-right">Tanggal Transaksi</th>
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
    @include('admin.laporans.transaksi-bbi.partials.modal-show')
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
        loadTable();

        function loadTable() {
            var tbl = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                language: {
                    url: "{{ asset('assets/js/datatables/lang/id.json') }}",
                },
                ajax: {
                    url: "{{ route('laporan.transaksi-bbi.index') }}?periode={{ request('periode') }}",
                    type: 'GET',
                    data: function(d) {
                        d.uptd_id = $('#uptd_id').val();
                        d.date = $('#date').val();
                        d.keyword = $('#keyword').val();
                    },
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
                        data: 'total_data',
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
            });
            $('#uptd_id').on('change', function() {
                tbl.ajax.reload();
            });

            let keywordTimeout;
            $('#keyword').on('keyup', function() {
                clearTimeout(keywordTimeout);
                keywordTimeout = setTimeout(function() {
                    tbl.ajax.reload();
                }, 300); // 500ms debounce
            });

            $('#date').on('change', function() {
                console.log('Date changed:', $('#date').val());
                tbl.ajax.reload();
            });
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
