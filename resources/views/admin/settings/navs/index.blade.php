@extends('layouts.master')

@section('title', 'Menu')

@section('breadcrumb')
    {{ Breadcrumbs::render('navigations') }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Daftar Menu</h5>
                @can('settings-navs.create')
                    <button type="button" data-modal-target="modal-add-menu" 
                        class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600">
                        <i class="ri-add-circle-line"></i> Tambah Menu
                    </button>
                @endcan
            </div>
            <table id="data-table" class="display group" style="width:100%">
                <thead>
                    <tr class="bg-gray-400">
                        <th class="text-center">Nama Menu</th>
                        <th class="text-center">Pengidentifikasi<br>Hak Akses</th>
                        <th class="text-left">Alamat Route</th>
                        <th class="text-center">No. Urut</th>
                        <th class="text-center">Status Aktif</th>
                        <th class="text-center">Ditampilkan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @can('settings-navs.read')    
                        @forelse ($navigations as $nav)
                            {{-- Start single & parent navs --}}
                            <tr class="text-gray-900 font-bold">
                                <td class="text-left">
                                    <div class="grid grid-cols-2 gap-1">
                                        <div class="col-span">
                                            <i data-lucide="{{ $nav->icon }}" class="h-4 group-data-[sidebar-size=sm]:h-5 group-data-[sidebar-size=sm]:w-5 transition group-hover/menu-link:animate-icons fill-slate-100 group-hover/menu-link:fill-blue-200 group-data-[sidebar=dark]:fill-vertical-menu-item-bg-active-dark group-data-[sidebar=dark]:dark:fill-zink-600 group-data-[layout=horizontal]:dark:fill-zink-600 group-data-[sidebar=brand]:fill-vertical-menu-item-bg-active-brand group-data-[sidebar=modern]:fill-vertical-menu-item-bg-active-modern group-data-[sidebar=dark]:group-hover/menu-link:fill-vertical-menu-item-bg-active-dark group-data-[sidebar=dark]:group-hover/menu-link:dark:fill-custom-500/20 group-data-[layout=horizontal]:dark:group-hover/menu-link:fill-custom-500/20 group-data-[sidebar=brand]:group-hover/menu-link:fill-vertical-menu-item-bg-active-brand group-data-[sidebar=modern]:group-hover/menu-link:fill-vertical-menu-item-bg-active-modern group-data-[sidebar-size=md]:block group-data-[sidebar-size=md]:mx-auto group-data-[sidebar-size=md]:mr-2"></i>
                                        </div>
                                        <div class="col-span text-left">
                                            {{ $nav->name ?? '-' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $nav->slug ?? '-' }}</td>
                                <td class="text-left">{{ $nav->url ?? '-' }}</td>
                                <td class="text-center">{{ $nav->order ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $nav->active ? 'bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent' : 'bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent' }}">
                                        {{ $nav->active ? 'Ya' : 'Tidak' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $nav->display ? 'bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent' : 'bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent' }}">
                                        {{ $nav->display ? 'Ya' : 'Tidak' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="grid grid-cols-2 gap-2 justify-center">
                                        @can('settings-navs.update')
                                            <button type="button" data-modal-target="modal-edit_{{ $nav->id }}"
                                                class="btn bg-yellow-500 text-white hover:bg-yellow-600 focus:bg-yellow-600">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                        @endcan
                                        @can('settings-navs.delete')
                                            <form action="{{ route('settings.navs.destroy', $nav->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600" onclick="confirmDelete(this);">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            {{-- End single & parent navs --}}
                            
                            {{-- Start child navs --}}
                            @if ($nav->child->count() > 0)
                                @foreach ($nav->child as $child)
                                    <tr class="text-gray-500">
                                        <td class="text-left">
                                            <div class="grid grid-cols-2 gap-1">
                                                <div class="col-span">
                                                    <i data-lucide="corner-down-right" class="h-4 text-xs"></i>
                                                </div>
                                                <div class="col-span text-left">
                                                    <small>{{ $child->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <div class="grid grid-cols-2 gap-1">
                                                <div class="col-span"></div>
                                                <div class="col-span text-left">
                                                    <small>{{ $child->slug }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <small>{{ $child->url }}</small>
                                        </td>
                                        <td class="text-left">
                                            <div class="grid grid-cols-2 gap-1">
                                                <div class="col-span"></div>
                                                <div class="col-span text-left">
                                                    <small>{{ $child->order }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $child->active ? 'bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent' : 'bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent' }}">
                                                {{ $child->active ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border {{ $child->display ? 'bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent' : 'bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent' }}">
                                                {{ $child->display ? 'Ya' : 'Tidak' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="grid grid-cols-2 gap-2 justify-center">
                                                @can('settings-navs.update')
                                                    <button type="button" data-modal-target="modal-edit_{{ $child->id }}"
                                                        class="btn bg-yellow-500 text-white hover:bg-yellow-600 focus:bg-yellow-600">
                                                        <i class="ri-edit-line"></i>
                                                    </button>
                                                @endcan
                                                @can('settings-navs.delete')
                                                    <form action="{{ route('settings.navs.destroy', $child->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600" onclick="confirmDelete(this);">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            {{-- End child navs --}}
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
    @can('settings-navs.create')
    @include('admin.settings.navs.partials.modal-add')
    @endcan
    {{-- Include modal edit --}}
    @can('settings-navs.update')
    @include('admin.settings.navs.partials.modal-edit')
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

    {{-- Start implement datatable --}}
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "pageLength": 100,
                "ordering": false
            });
        });
    </script>
    {{-- End implement datatable --}}
@endpush