@extends('layouts.master')

@section('title', '...')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('users') }} --}}
@endsection


@section('content-admin')
    <button data-modal-target="largeModal" type="button"
    class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:focus:ring-custom-400/20">Large
    Modal</button>
    <div id="largeModal" modal-center
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div
            class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div
                class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16" id="modal-title">Modal Heading</h5>
                <button data-modal-close="largeModal"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <form action="" method="" id="form-">
                {{-- Start Modal Body --}}
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    {{-- Input with Placeholder --}}
                    <div class="">
                        <label for="" class="inline-block mb-2 text-base font-medium">Input with
                            Placeholder <strong class="text-red-500">*</strong></label>
                        <input type="text" id=""
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Placeholder">
                    </div>
                    {{-- Textarea --}}
                    <div class="">
                        <label for="textArea" class="inline-block mb-2 text-base font-medium">Textarea <strong class="text-red-500">*</strong></label>
                        <textarea
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            id="textArea" rows="3"></textarea>
                    </div>
                    {{-- Single Select --}}
                    <div class="">
                        <label for="inputPlaceholder" class="inline-block mb-2 text-base font-medium">Single Select <strong class="text-red-500">*</strong></label>
                        <select
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-choices name="choices-single-default" id="choices-single-default">
                            <option value="">This is a placeholder</option>
                            <option value="Choice 1">Choice 1</option>
                            <option value="Choice 2">Choice 2</option>
                            <option value="Choice 3">Choice 3</option>
                        </select>
                    </div>
                    {{-- Multiple Select --}}
                    <div class="">
                        <label for="" class="inline-block mb-2 text-base font-medium">Multiple Select <strong class="text-red-500">*</strong></label>
                        <select
                            id="choices-multiple-default[]"
                            name="choices-multiple-default"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            data-choices data-choices-removeItem multiple>
                            <option value="Choice 1" selected>Choice 1</option>
                            <option value="Choice 2">Choice 2</option>
                            <option value="Choice 3">Choice 3</option>
                            <option value="Choice 4" disabled>Choice 4</option>
                        </select>
                    </div>
                </div>
                {{-- End Modal Body --}}
                {{-- Start Modal Footer --}}
                <div
                    class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                    <button type="button" data-modal-close="modal-add"
                        class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
                        <i class="ri-save-line"></i> Simpan
                    </button>
                </div>
                {{-- End Modal Footer --}}
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush