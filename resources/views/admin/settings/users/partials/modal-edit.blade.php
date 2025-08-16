
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

{{-- Trigger Modal Edit --}}
<button data-modal-target="modal-edit" id="trigger-open-modal-edit" type="button"></button>

<div id="modal-edit" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16" id="modal-title">Edit Pengguna</h5>
            <button data-modal-close="modal-edit"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('settings.users.store') }}" method="POST" id="form-edit">
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
                <div class="mb-[100px]" style="margin-bottom: 19rem !important;">
                    <label for="" class="inline-block mb-2 text-base font-medium">Peran <strong
                            class="text-red-500">*</strong></label>
                    <select name="roles[]" id="role-select-edit"
                        class="w-full select2-multiple form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        multiple required>
                        <option value="">Pilih peran pengguna, bisa lebih dari satu peran</option>
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
                    <i class="ri-save-line"></i> Simpan perubahan data pengguna
                </button>
            </div>
            {{-- End Modal Footer --}}
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                theme: 'classic',
                placeholder: "Pilih peran pengguna, bisa lebih dari satu peran",
                allowClear: true
            });
        });
    </script>
    <script>
        // -- End Edit User (Modal)
        $(document).on('click', '#btn-modal-edit-user', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-edit').click();

            // User Id
            var userId = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
            // Send request to get user data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    // Modal title
                    $('#modal-title').text('Edit Data Pengguna - ' + response.name);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#name').val(response.name);
                    $('#form-edit').find('#username').val(response.username);
                    $('#form-edit').find('#email').val(response.email);
                    $('#form-edit').find('#role-select-edit').prop("selected", function () {
                        return ~$.inArray(this.text, response.role_names);
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data desa.',
                    });
                }
            });
        });        
        // -- End Edit User (Modal)
    </script>
@endpush
