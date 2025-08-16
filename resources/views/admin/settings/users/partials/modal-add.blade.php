<div id="modal-add" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Tambah Pengguna Baru</h5>
            <button data-modal-close="modal-add"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('settings.users.store') }}" method="POST">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4 mb-1">
                    <div class="col-span">
                        {{-- Nama --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Nama <strong
                            class="text-red-500">*</strong></label>
                            <input type="text" id="name" name="name"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan nama pengguna" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Username --}}
                        <div class="">
                            <label for="" name="username" class="inline-block mb-2 text-base font-medium">Username <strong
                            class="text-red-500">*</strong></label>
                            <input type="text" id="username" name="username"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan username pengguna" required>
                        </div>
                    </div>
                </div>
                {{-- Email --}}
                <div class="mb-1">
                    <label for="" class="inline-block mb-2 text-base font-medium">Email <strong
                            class="text-red-500">*</strong></label>
                    <input type="email" id="email" name="email"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan email pengguna" required>
                </div>
                {{-- Peran --}}
                <div class="">
                    <label for="" class="inline-block mb-2 text-base font-medium">Peran <strong
                            class="text-red-500">*</strong></label>
                    <select name="roles[]" id="role-select-add"
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        multiple required>
                        @foreach ($roles as $role)
                            @if ($role->name !== \App\Enums\RoleEnum::DEVELOPER->value)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- End Modal Body --}}
            {{-- Start Modal Footer --}}
            <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                <button type="submit"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
                    <i class="ri-save-line"></i> Simpan data pengguna baru
                </button>
            </div>
            {{-- End Modal Footer --}}
        </form>
    </div>
</div>

@push('scripts')
<script>
    $('#role-select-add').select2({
        width: '100%',
        placeholder: "Pilih peran pengguna, bisa lebih dari satu peran",
        allowClear: true
    });
</script>
@endpush
