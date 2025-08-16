@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content-admin')
<select name="roles[]" id="role-select-edit"
    class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
    multiple required>
    <option value="">1</option>
    <option value="">1</option>
    <option value="">1</option>
    <option value="">1</option>
</select>

<select name="pekerjaan_id" id="formPekerjaanWajibRetribusiAdd" required
    class="select2 w-full border py-2 px-3 text-13 rounded border-gray-400 placeholder:text-13 focus:border focus:border-gray-400 focus:ring-0 focus:outline-none text-gray-700 dark:bg-transparent placeholder:text-gray-600 dark:border-zink-50 dark:placeholder:text-zink-200">
    <option value="">1</option>
    <option value="">1</option>
    <option value="">1</option>
    <option value="">1</option>
</select>
@endsection

@push('scripts')
    <script>
        $('.select2').select2({
            width: '100%',
            placeholder: "Tuliskan placeholder disini ...",
            allowClear: true
        });

        // Script untuk selected di select2
            $('#form-edit').find('#role-select-edit').val(response.role_names).trigger('change');
    </script>
@endpush