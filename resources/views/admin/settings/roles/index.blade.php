@extends('layouts.master')

@section('title', 'Peran')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Peran</h5>
                @can('settings-roles.create')
                    <button type="button" data-modal-target="modal-add-role" 
                        class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                        <i class="ri-add-circle-line"></i> Tambah peran
                    </button>
                @endcan
            </div>
            <table id="data-table" class="display group" style="width:100%">
                <thead>
                    <tr class="bg-gray-400">
                        <th class="text-center">No.</th>
                        <th class="text-left">Nama Peran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @can('settings-roles.read')    
                        @forelse ($roles as $role)
                            <tr class="text-gray-900">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $role->name ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @can('settings-roles.read')
                                            <a href="{{ route('settings.roles.show', $role->id) }}"
                                                class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:border-sky-600 active:ring active:ring-sky-100 dark:ring-sky-400/20">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        @endcan
                                        @can('settings-roles.update')
                                            <button type="button" data-modal-target="modal-edit-role_{{ $role->id }}"
                                                class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                        @endcan
                                        @can('settings-roles.delete')
                                            <form action="{{ route('settings.roles.destroy', $role->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20"
                                                    onclick="confirmDelete(this);">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada menu ditemukan</td>
                            </tr>
                        @endforelse
                    @endcan
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal add --}}
    @can('settings-roles.create')
    @include('admin.settings.roles.partials.modal-add')
    @endcan
    {{-- Include modal edit --}}
    @can('settings-roles.update')
    @include('admin.settings.roles.partials.modal-edit')
    @endcan
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
        $(document).ready(function() {
            $('#data-table').DataTable({
                "columnDefs": [
                    { "targets": [2], "className": "text-center" }
                ],
                columns: [
                    { width: "5%" },
                    { width: "75%" },
                    { width: "20%" }
                ],
                autoWidth: false
            });
        });
    </script>
@endpush