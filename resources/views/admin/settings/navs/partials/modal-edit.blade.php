{{-- Loop through navigations --}}
@foreach ($navigations as $nav)
    {{-- MODAL FOR PARENT OR SINGLE MENU --}}
    <div id="modal-edit-menu_{{ $nav->id }}" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div
            class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div
                class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16" id="modal-title">Edit Menu - {{ $nav->name }}</h5>
                <button data-modal-close="modal-edit-menu_{{ $nav->id }}"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <form action="{{ route('settings.navs.update', $nav->id) }}" method="POST" id="form-edit-menu_{{ $nav->id }}">
                {{-- CSRF Token --}}
                @csrf
                @method('PUT')
                {{-- Start Modal Body --}}
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    <div class="row">
                        <div class="grid grid-cols-4 gap-1">
                            {{-- Nama Menu --}}
                            <div class="col-span-2">
                                <label for="" class="inline-block mb-2 text-base font-medium">Nama Menu <strong class="text-red-500">*</strong></label>
                                <input type="text" id="name_{{ $nav->id }}" name="name" value="{{ $nav->name }}"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan nama menu disini">
                            </div>
                            {{-- Pengidentifikasi Hak Akses --}}
                            <div class="">
                                <label for="" class="inline-block mb-2 text-base font-medium">Pengidentifikasi Hak Akses <strong class="text-red-500">*</strong></label>
                                <input type="text" id="slug_{{ $nav->id }}" name="slug" value="{{ $nav->slug }}"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan pengidentifikasi hak akses disini">
                            </div>
                            {{-- Induk Menu --}}
                            <div class="">
                                <label for="" class="inline-block mb-2 text-base font-medium">Induk Menu <i class="text-sky-500">Kosongkan induk menu apabila menu merupakan menu induk atau tunggal.</i></label>
                                <select id="parent-id_{{ $nav->id }}" name="parent_id"
                                    class=" form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800">
                                    <option value="">Pilih Induk Menu</option>
                                    {{-- Loop through parent menus --}}
                                    @foreach ($parentNavigations as $parentNav)
                                        <option value="{{ $parentNav->id }}" {{ $parentNav->id == $parentNav->parent_id ? 'selected' : '' }}>{{ $parentNav->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Alamat Route --}}
                            <div class="">
                                <label for="" class="inline-block mb-2 text-base font-medium">Alamat Route <strong class="text-red-500">*</strong></label>
                                <input type="text" id="url_{{ $nav->id }}" name="url" value="{{ $nav->url }}"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan alamat route disini">
                            </div>
                            {{-- Icon --}}
                            <div class="">
                                <label for="" class="inline-block mb-2 text-base font-medium">Icon <strong class="text-red-500">* Wajib menggunakan Lucide Icon <a href="https://lucide.dev/" class="text-blue-500"><u>https://lucide.dev/</u></a></strong></label>
                                <input type="text" id="icon_{{ $nav->id }}" name="icon" value="{{ $nav->icon }}"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan icon disini">
                            </div>
                            {{-- No. Urut --}}
                            <div class="-1">
                                <label for="" class="inline-block mb-2 text-base font-medium">No. Urut <strong class="text-red-500">*</strong></label>
                                <input type="number" id="order_{{ $nav->id }}" name="order" value="{{ $nav->order }}"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan no. urut disini">
                            </div>
                            {{-- Status Aktif --}}
                            <div class="-1">
                                <label for="" class="inline-block mb-2 text-base font-medium">Status Aktif <strong class="text-red-500">*</strong></label>
                                <select id="active_{{ $nav->id }}" name="active"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    <option value="">Pilih Status Keaktifan Menu</option>
                                    <option value="1" {{ $nav->active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$nav->active ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                            {{-- Ditampilkan --}}
                            <div class="">
                                <label for="" class="inline-block mb-2 text-base font-medium">Ditampilkan <strong class="text-red-500">*</strong></label>
                                <select id="display_{{ $nav->id }}" name="display"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    <option value="">Pilih Status Ditampilkan</option>
                                    <option value="1" {{ $nav->display ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ !$nav->display ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal Body --}}
                {{-- Start Modal Footer --}}
                <div
                    class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                    <button type="submit" id="btn-submit_{{ $nav->id }}"
                        class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600 w-full">
                        <i class="ri-save-line"></i> Simpan Perubahan Data Menu
                    </button>
                </div>
                {{-- End Modal Footer --}}
            </form>
        </div>
    </div>

    @if ($nav->child->count() > 0)
    {{-- Loop through child menus --}}
        @foreach ($nav->child as $child)
            {{-- MODAL FOR CHILD MENU --}}
            <div id="modal-edit-menu_{{ $child->id }}" modal-center
                class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                <div
                    class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                    <div
                        class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                        <h5 class="text-16" id="modal-title">Edit Menu - {{ $child->name }}</h5>
                        <button data-modal-close="modal-edit-menu_{{ $child->id }}"
                            class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                                data-lucide="x" class="size-5"></i></button>
                    </div>
                    <form action="{{ route('settings.navs.update', $child->id) }}" method="POST" id="form-edit-menu_{{ $child->id }}">
                        {{-- CSRF Token --}}
                        @csrf
                        @method('PUT')
                        {{-- Start Modal Body --}}
                        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                            <div class="row">
                                <div class="grid grid-cols-4 gap-1">
                                    {{-- Nama Menu --}}
                                    <div class="col-span-2">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Nama Menu <strong class="text-red-500">*</strong></label>
                                        <input type="text" id="name_{{ $child->id }}" name="name" value="{{ $child->name }}"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan nama menu disini">
                                    </div>
                                    {{-- Pengidentifikasi Hak Akses --}}
                                    <div class="">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Pengidentifikasi Hak Akses <strong class="text-red-500">*</strong></label>
                                        <input type="text" id="slug_{{ $child->id }}" name="slug" value="{{ $child->slug }}"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan pengidentifikasi hak akses disini">
                                    </div>
                                    {{-- Induk Menu --}}
                                    <div class="">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Induk Menu <i class="text-sky-500">Kosongkan induk menu apabila menu merupakan menu induk atau tunggal.</i></label>
                                        <select id="parent-id_{{ $child->id }}" name="parent_id"
                                            class=" form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800">
                                            <option value="">Pilih Induk Menu</option>
                                            {{-- Loop through parent menus --}}
                                            @foreach ($parentNavigations as $parentNav)
                                                <option value="{{ $parentNav->id }}" {{ $parentNav->id == $child->parent_id ? 'selected' : '' }}>{{ $parentNav->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Alamat Route --}}
                                    <div class="">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Alamat Route <strong class="text-red-500">*</strong></label>
                                        <input type="text" id="url_{{ $child->id }}" name="url" value="{{ $child->url }}"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan alamat route disini">
                                    </div>
                                    {{-- Icon --}}
                                    <div class="">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Icon <strong class="text-red-500">* Wajib menggunakan Lucide Icon <a href="https://lucide.dev/" class="text-blue-500"><u>https://lucide.dev/</u></a></strong></label>
                                        <input type="text" id="icon_{{ $child->id }}" name="icon" value="{{ $child->icon }}"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan icon disini">
                                    </div>
                                    {{-- No. Urut --}}
                                    <div class="-1">
                                        <label for="" class="inline-block mb-2 text-base font-medium">No. Urut <strong class="text-red-500">*</strong></label>
                                        <input type="number" id="order_{{ $child->id }}" name="order" value="{{ $child->order }}"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                            placeholder="Masukkan no. urut disini">
                                    </div>
                                    {{-- Status Aktif --}}
                                    <div class="-1">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Status Aktif <strong class="text-red-500">*</strong></label>
                                        <select id="active_{{ $child->id }}" name="active"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="">Pilih Status Keaktifan Menu</option>
                                            <option value="1" {{ $child->active ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ !$child->active ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    {{-- Ditampilkan --}}
                                    <div class="">
                                        <label for="" class="inline-block mb-2 text-base font-medium">Ditampilkan <strong class="text-red-500">*</strong></label>
                                        <select id="display_{{ $child->id }}" name="display"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                            <option value="">Pilih Status Ditampilkan</option>
                                            <option value="1" {{ $child->display ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ !$child->display ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Modal Body --}}
                        {{-- Start Modal Footer --}}
                        <div
                            class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                            <button type="submit"
                                class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600 w-full">
                                <i class="ri-save-line"></i> Simpan Perubahan Data Menu
                            </button>
                        </div>
                        {{-- End Modal Footer --}}
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endforeach
