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

                    <form action="#!">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                            <div class="xl:col-span-4">
                                <label for="jenisUsaha" class="inline-block mb-2 text-base font-medium">Jenis Usaha</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="jenisUsaha" id="jenisUsaha">
                                    <option value="">Pilih Jenis Usaha</option>
                                    <option value="Mobiles, Computers">Mobiles, Computers</option>
                                    <option value="TV, Appliances, Electronics">TV, Appliances, Electronics</option>
                                    <option value="Men's Fashion">Men's Fashion</option>
                                    <option value="Women's Fashion">Women's Fashion</option>
                                    <option value="Home, Kitchen, Pets">Home, Kitchen, Pets</option>
                                    <option value="Beauty, Health, Grocery">Beauty, Health, Grocery</option>
                                    <option value="Books">Books</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="bentukUsaha" class="inline-block mb-2 text-base font-medium">Bentuk
                                    Usaha</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="bentukUsaha" id="bentukUsaha">
                                    <option value="">Pilih Bentuk Usaha</option>
                                    <option value="Single">Single</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Boxed">Boxed</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="kelompokBinaan" class="inline-block mb-2 text-base font-medium">Kelompok
                                    Binaan</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="kelompokBinaan" id="kelompokBinaan">
                                    <option value="">Pilih Kelompok Binaan</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="npwp" class="inline-block mb-2 text-base font-medium">No. NPWP</label>
                                <input type="number" id="npwp"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan Nomor NPWP Anda" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="nib" class="inline-block mb-2 text-base font-medium">NIB</label>
                                <input type="text" id="nib"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan NIB Anda" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="rangePenghasilan" class="inline-block mb-2 text-base font-medium">Range
                                    Penghasilan</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="rangePenghasilan" id="rangePenghasilan">
                                    <option value="">Pilih Range Penghasilan</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="nik" class="inline-block mb-2 text-base font-medium">NIK</label>
                                <input type="number" id="nik"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan 16 digit NIK" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="phone" class="inline-block mb-2 text-base font-medium">Telepon</label>
                                <input type="number" id="phone"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan Nomor HP / Telepon Aktif" required>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="email" class="inline-block mb-2 text-base font-medium">E-mail</label>
                                <input type="email" id="email"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Masukkan E-mail Anda" required>
                            </div><!--end col-->

                            <div class="xl:col-span-4">
                                <label for="kabupaten" class="inline-block mb-2 text-base font-medium">Kabupaten</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="kabupaten" id="kabupaten">
                                    <option value="">Pilih Kabupaten</option>
                                    <option value="Mobiles, Computers">Mobiles, Computers</option>
                                    <option value="TV, Appliances, Electronics">TV, Appliances, Electronics</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="kecamatan" class="inline-block mb-2 text-base font-medium">Kecamatan</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="kecamatan" id="kecamatan">
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="Single">Single</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Boxed">Boxed</option>
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="kalurahan" class="inline-block mb-2 text-base font-medium">Kalurahan</label>
                                <select
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices data-choices-search-false name="kalurahan" id="kalurahan">
                                    <option value="">Pilih Kalurahan</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div><!--end col-->

                            <div class="lg:col-span-2 xl:col-span-12">
                                <div>
                                    <label for="alamat" class="inline-block mb-2 text-base font-medium">Alamat</label>
                                    <textarea
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                        id="alamat" placeholder="Masukkan Alamat Lengkap Anda" rows="5"></textarea>
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
