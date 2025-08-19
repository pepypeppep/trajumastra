@extends('layouts.master')

@section('title', 'Peran')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles-permissions', $role) }}
@endsection

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h5 class="mb-0">Hak Akses Peran - {{ $role->name ?? '-' }}</h5>
                @can('settings-roles.create')
                    <button type="button" onclick="submitForm()"
                        class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600">
                        <i class="ri-save-line"></i> Simpan Perubahan Hak Akses
                    </button>
                @endcan
            </div>

            {{-- Start Form Update Permissions --}}
            <form action="{{ route('settings.roles.permissions', $role->id) }}" id="permissions-form" method="POST">
                @csrf
                @method('PUT')
                <table id="data-table" class="display group" style="width:100%">
                    <thead>
                        <tr class="bg-gray-400">
                            <th class="text-center">Menu</th>
                            <th class="text-center">Read</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                        
                    <tbody>
                        @can('settings-roles.read')    
                            @forelse ($navigations as $nav)
                                {{-- Start single & parent navs --}}
                                <tr class="text-gray-900 font-bold">
                                    {{-- Start Nav Icon & Name --}}
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
                                    {{-- End Nav Icon & Name --}}

                                    {{-- Start Permissions (Read) --}}
                                    <td class="text-center">
                                        <input id="checkbox_{{ $nav->id }}_read" name="permissions[]"
                                        type="checkbox" value="{{ strtolower($nav->slug) . '.read' }}"
                                        class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                        {{ in_array(strtolower($nav->slug) . '.read', $permissions) ? 'checked' : '' }}>
                                    </td>
                                    {{-- End Permissions (Read) --}}
                                    
                                    {{-- Start Permissions (Create) --}}
                                    <td class="text-center">
                                        <input id="checkbox_{{ $nav->id }}_create" name="permissions[]"
                                        type="checkbox" value="{{ strtolower($nav->slug) . '.create' }}"
                                        class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                        {{ in_array(strtolower($nav->slug) . '.create', $permissions) ? 'checked' : '' }}>
                                    </td>
                                    {{-- End Permissions (Create) --}}

                                    {{-- Start Permissions (Update) --}}
                                    <td class="text-center">
                                        <input id="checkbox_{{ $nav->id }}_update" name="permissions[]"
                                        type="checkbox" value="{{ strtolower($nav->slug) . '.update' }}"
                                        class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                        {{ in_array(strtolower($nav->slug) . '.update', $permissions) ? 'checked' : '' }}>
                                    </td>
                                    {{-- End Permissions (Update) --}}

                                    {{-- Start Permissions (Delete) --}}
                                    <td class="text-center">
                                        <input id="checkbox_{{ $nav->id }}_delete" name="permissions[]"
                                        type="checkbox" value="{{ strtolower($nav->slug) . '.delete' }}"
                                        class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                        {{ in_array(strtolower($nav->slug) . '.delete', $permissions) ? 'checked' : '' }}>
                                    </td>
                                    {{-- End Permissions (Delete) --}}
                                </tr>
                                {{-- End single & parent navs --}}
                                
                                {{-- Start child navs --}}
                                @if ($nav->child->count() > 0)
                                    @foreach ($nav->child as $child)
                                        <tr class="text-gray-900">
                                            {{-- Start Child Nav Icon & Name --}}
                                            <td class="text-left">
                                                <div class="grid grid-cols-2 gap-1">
                                                    <div class="col-span">
                                                        <i data-lucide="corner-down-right" class="h-4 text-xs ml-2"></i>
                                                    </div> 
                                                    <div class="col-span text-left">
                                                        {{ $child->name ?? '-' }}
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- End Child Nav Icon & Name --}}

                                            {{-- Start Permissions (Read) --}}
                                            <td class="text-center">
                                                <input id="checkbox_{{ $child->id }}_read" name="permissions[]"
                                                type="checkbox" value="{{ strtolower($child->slug) . '.read' }}"
                                                class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                {{ in_array(strtolower($child->slug) . '.read', $permissions) ? 'checked' : '' }}>
                                            </td>
                                            {{-- End Permissions (Read) --}}
                                            
                                            {{-- Start Permissions (Create) --}}
                                            <td class="text-center">
                                                <input id="checkbox_{{ $child->id }}_create" name="permissions[]"
                                                type="checkbox" value="{{ strtolower($child->slug) . '.create' }}"
                                                class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                {{ in_array(strtolower($child->slug) . '.create', $permissions) ? 'checked' : '' }}>
                                            </td>
                                            {{-- End Permissions (Create) --}}

                                            {{-- Start Permissions (Update) --}}
                                            <td class="text-center">
                                                <input id="checkbox_{{ $child->id }}_update" name="permissions[]"
                                                type="checkbox" value="{{ strtolower($child->slug) . '.update' }}"
                                                class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                {{ in_array(strtolower($child->slug) . '.update', $permissions) ? 'checked' : '' }}>
                                            </td>
                                            {{-- End Permissions (Update) --}}

                                            {{-- Start Permissions (Delete) --}}
                                            <td class="text-center">
                                                <input id="checkbox_{{ $child->id }}_delete" name="permissions[]"
                                                type="checkbox" value="{{ strtolower($child->slug) . '.delete' }}"
                                                class="size-4 border rounded-full appearance-none cursor-pointer bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-green-500 checked:border-green-500 dark:checked:bg-green-500 dark:checked:border-green-500 checked:disabled:bg-green-400 checked:disabled:border-green-400"
                                                {{ in_array(strtolower($child->slug) . '.delete', $permissions) ? 'checked' : '' }}>
                                            </td>
                                            {{-- End Permissions (Delete) --}}
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
            </form>
            {{-- Start Form Update Permissions --}}
        </div>
    </div>
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
        /* Data Table */
        $(document).ready(function() {
            $('#data-table').DataTable({
                columns: [
                    { width: "60%" },
                    { width: "10%" },
                    { width: "10%" },
                    { width: "10%" },
                    { width: "10%" }
                ],
                autoWidth: false,
                pageLength: 100,
                ordering: false
            });
        });

        /* Submit form */
        function submitForm() {
            document.getElementById('permissions-form').submit();
        }
    </script>
@endpush