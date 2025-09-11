@extends('layouts.guest.master')

@section('title', 'Pedaftaran Pelaku Usaha')

@section('content')
    <section class="relative pb-28 xl:pb-36 pt-44 xl:pt-52" id="beranda">
        <div class="absolute top-0 left-0 size-64 bg-custom-500 opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 size-64 bg-purple-500/10 blur-3xl"></div>
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-15"> Form Pendaftaran Pelaku Usaha Kelautan dan Perikanan </h6>

                    <form action="{{ route('pendaftaran.store') }}" method="POST" id="registerForm">
                        @csrf
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-4">
                                <label for="jenisUsaha" class="inline-block mb-2 text-base font-medium">Jenis Usaha
                                    <span class="text-red-500">*</span></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices name="jenisUsaha" id="jenisUsaha" required>
                                    <option value="">Pilih Jenis Usaha</option>
                                    @foreach ($jenisUsahas as $jenisUsaha)
                                        <option value="{{ $jenisUsaha->id }}"
                                            {{ old('jenisUsaha') == $jenisUsaha->id ? 'selected' : '' }}>
                                            {{ $jenisUsaha->name }}</option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="bentukUsaha" class="inline-block mb-2 text-base font-medium">Bentuk
                                    Usaha
                                    <span class="text-red-500">*</span></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices name="bentukUsaha" id="bentukUsaha" required>
                                    <option value="">Pilih Bentuk Usaha</option>
                                    @foreach ($bentukUsahas as $bentukUsaha)
                                        <option value="{{ $bentukUsaha->id }}"
                                            {{ old('bentukUsaha') == $bentukUsaha->id ? 'selected' : '' }}>
                                            {{ $bentukUsaha->name }}</option>
                                    @endforeach
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="kelompokBinaan" class="inline-block mb-2 text-base font-medium">Kelompok
                                    Binaan
                                    <span class="text-red-500">*</span></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices name="kelompokBinaan" id="kelompokBinaan" required>
                                    <option value="">Pilih Kelompok Binaan</option>
                                    @foreach ($kelompokBinaans as $kelompokBinaan)
                                        <option value="{{ $kelompokBinaan->id }}"
                                            {{ old('kelompokBinaan') == $kelompokBinaan->id ? 'selected' : '' }}>
                                            {{ $kelompokBinaan->name }} ({{ $kelompokBinaan->jenis_kelompok }})
                                        </option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="npwp" class="inline-block mb-2 text-base font-medium">No. NPWP
                                    <span class="text-red-500">*</span></label>
                                <input type="number" id="npwp" name="npwp"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan Nomor NPWP Anda" value="{{ old('npwp') }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="siup" class="inline-block mb-2 text-base font-medium">SIUP
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="siup" name="siup"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan SIUP Anda" value="{{ old('siup') }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="rangePenghasilan" class="inline-block mb-2 text-base font-medium">Range
                                    Penghasilan
                                    <span class="text-red-500">*</span></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="rangePenghasilan" id="rangePenghasilan"
                                    required>
                                    <option value="">Pilih Range Penghasilan</option>
                                    @foreach ($penghasilans as $penghasilan)
                                        <option value="{{ $penghasilan->id }}"
                                            {{ old('rangePenghasilan') == $penghasilan->id ? 'selected' : '' }}>
                                            {{ $penghasilan->name }}</option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="phone" class="inline-block mb-2 text-base font-medium">Telepon
                                    <span class="text-red-500">*</span></label>
                                <input type="number" id="phone" name="phone"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan Nomor HP / Telepon Aktif" value="{{ old('phone') }}" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="email" class="inline-block mb-2 text-base font-medium">E-mail
                                    <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan E-mail Anda" value="{{ old('email') }}" required>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="kalurahan" class="inline-block mb-2 text-base font-medium">Kalurahan
                                    <span class="text-red-500">*</span></label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices name="kalurahan" id="kalurahan" required>
                                    <option value="">Pilih Kalurahan</option>
                                    @foreach ($kalurahans as $kalurahan)
                                        <option value="{{ $kalurahan->id }}"
                                            {{ old('kalurahan') == $kalurahan->id ? 'selected' : '' }}>
                                            {{ $kalurahan->name }} - {{ $kalurahan->kecamatan->name }} -
                                            {{ $kalurahan->kecamatan->kabupaten->name }}</option>
                                    @endforeach
                                </select>
                            </div><!--end col-->

                            <div class="lg:col-span-2 xl:col-span-12">
                                <div>
                                    <label for="alamat" class="inline-block mb-2 text-base font-medium">Alamat
                                        <span class="text-red-500">*</span></label>
                                    <textarea
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        id="alamat" name="alamat" placeholder="Masukkan Alamat Lengkap Anda" rows="5" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div><!--end grid-->
                        <div class="flex justify-center gap-2 mt-4">
                            <button type="submit"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Simpan</button>
                        </div>
                    </form>
                </div>
            </div><!--end card-->
        </div>
    </section><!--end -->

@endsection
@push('styles')
    <style>
        .grecaptcha-badge {
            bottom: 20% !important;
            /* Adjust vertical position */
            /* left: 20px !important; */
            /* Adjust horizontal position */
            /* right: unset !important; */
            /* Remove default right positioning */
        }
    </style>
@endpush
<!-- Sweet Alert Template Script -->
{{-- @include('layouts.sweet-alerts') --}}
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!--sweet alert init js-->
    <script src="{{ URL::asset('assets/js/pages/sweetalert.init.js') }}"></script>
    <!-- Start Confirm Submit -->
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $message)
                Swal.fire({
                    title: 'GAGAL',
                    text: ' @json($message)',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endforeach
        @endif
        @foreach (['success', 'error', 'warning', 'info'] as $type)
            @if ($message = Session::get($type))
                @php
                    $title = match ($type) {
                        'success' => 'Berhasil',
                        'error' => 'Gagal',
                        'warning' => 'Peringatan',
                        'info' => 'Informasi',
                        default => null,
                    };
                @endphp
                Swal.fire({
                    title: '{{ $title }}',
                    text: '{{ $message }}',
                    icon: '{{ $type }}',
                    timer: 3000,
                    confirmButtonText: 'OK'
                })
            @endif
        @endforeach
        $("#registerForm").on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi data',
                text: "Pastikan data yang Anda masukkan benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    grecaptcha.ready(function() {
                        grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {
                            action: 'subscribe_newsletter'
                        }).then(function(token) {
                            $('#registerForm').prepend(
                                '<input type="hidden" name="g-recaptcha-response" value="' +
                                token + '">');
                            // Submit the form
                            $("#registerForm").unbind('submit').submit();
                        });
                    });
                }
            });
        });
    </script>
    <!-- End Confirm Submit -->
@endpush
