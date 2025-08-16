@foreach ($preferences as $preference)
    <div id="modal-edit_{{ $preference->id }}" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div
            class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div
                class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16" id="modal-title">Edit preferensi - {{ $preference->name ?? '-' }}</h5>
                <button data-modal-close="modal-edit_{{ $preference->id }}"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <form action="{{ route('settings.preferences.update', $preference->id) }}" method="POST" id="form_{{ $preference->id }}">
                @csrf
                @method('PUT')
                {{-- Start Modal Body --}}
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    {{-- Textarea --}}
                    <div class="">
                        <label for="value_{{ $preference->id }}" class="inline-block mb-2 text-base font-medium">Value <strong class="text-red-500">*</strong></label>
                        <textarea name="value"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            id="value_{{ $preference->id }}" rows="3">{{ $preference->value }}</textarea>
                    </div>
                </div>
                {{-- End Modal Body --}}
                {{-- Start Modal Footer --}}
                <div
                    class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                    <button type="submit"
                        class="btn bg-red-500 text-white hover:bg-red-600 focus:bg-red-600 w-full">
                        <i class="ri-save-line"></i> Simpan perubahan data
                    </button>
                </div>
                {{-- End Modal Footer --}}
            </form>
        </div>
    </div>
@endforeach