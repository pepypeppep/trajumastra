@extends('layouts.master')

@section('title', 'Preferensi')

@section('breadcrumb')
    {{ Breadcrumbs::render('preferences') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Preferensi</h5>
            </div>
            <table id="data-table" class="display stripe group" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Key</th>
                        <th class="text-center">Group</th>
                        <th class="text-left">Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @forelse ($preferences as $preference)
                        <tr>
                            <td>{{ $preference->name ?? '-' }}</td>
                            <td>{{ $preference->group ?? '-' }}</td>
                            <td>{{ $preference->value ?? '-' }}</td>
                            <td>
                                @can('settings-preferences.update')
                                    <button type="button" data-modal-target="modal-edit_{{ $preference->id }}"
                                        class="btn bg-yellow-500 text-white hover:bg-yellow-600 focus:bg-yellow-600">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada preferensi ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Include modal edit --}}
    @include('admin.settings.preferences.partials.modal-edit')
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

    {{-- Start implement datatable --}}
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "order": [[ 0, "asc" ]],
                "columnDefs": [
                    { "targets": [0, 1, 3], "className": "text-center" },
                    { "targets": [2], "className": "text-left" }
                ]
            });
        });
    </script>
    {{-- End implement datatable --}}
@endpush