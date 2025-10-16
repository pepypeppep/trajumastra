@extends('layouts.guest.master')

@section('title', 'Privacy Policy')

@section('content')
    @include('guest.home')

    <section class="relative py-24 xl:py-32" id="pelaku-usaha">
        <div class="absolute top-0 left-0 size-64 bg-purple-500/10 blur-3xl"></div>
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <header class="p-6 md:p-10 border-b border-gray-100">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900">
                    Kebijakan Privasi Trajumastra
                </h1>
                <p class="mt-3 text-sm text-gray-600">
                    <em>Terakhir diperbarui: 16 Oktober 2025</em>
                </p>
            </header>

            <div class="p-6 md:p-10 space-y-6 leading-relaxed">
                <p>
                    Dokumen ini menjelaskan bagaimana <strong>Trajumastra</strong> (&quot;kami&quot;) mengumpulkan,
                    menggunakan, mengungkapkan, dan melindungi data pribadi pengguna ketika Anda menggunakan aplikasi
                    mobile dan situs web kami, termasuk fitur master database, penjadwalan penyuluhan, transaksi pada
                    TPI/BBI untuk perhitungan retribusi, serta manajemen pelaku usaha, kelompok usaha, dan kelompok
                    binaan.
                </p>

                <hr class="border-t border-gray-200 my-4" />

                <h2 class="text-2xl font-semibold text-gray-900">1) Siapa Kami</h2>
                <ul class="list-disc pl-6 space-y-1">
                    <li>Pengelola: <strong>Dinas Kelautan dan Perikanan Kabupaten Bantul</strong></li>
                    <li>Nama aplikasi: <strong>Trajumastra</strong></li>
                    <li>Email: <a class="text-blue-600 hover:underline" href="mailto:dkp@bantulkab.go.id"><strong>dkp@bantulkab.go.id</strong></a></li>
                    <li>Telepon: <a class="text-blue-600 hover:underline" href="tel:0274-367509"><strong>0274-367509</strong></a></li>
                    <li>Alamat :&nbsp;Komplek Perkantoran Terpadu Pemda II, Jl. Lingkar Timur Manding Trirenggo Bantul
                        Kabupaten Bantul, Daerah Istimewa Yogyakarta 55714</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900">2) Ruang Lingkup</h2>
                <p>
                    Kebijakan ini berlaku hanya bagi pengguna internal Trajumastra, yaitu Administrator dan Petugas
                    Lapangan (Petugas TPI dan Petugas BBI). Pengguna di luar kategori tersebut tidak termasuk cakupan
                    layanan. Kebijakan ini mencakup data yang diproses untuk:
                </p>
                <ul class="list-disc pl-6 space-y-1">
                    <li>Pembuatan dan pengelolaan akun,</li>
                    <li>Penjadwalan dan pencatatan kegiatan penyuluhan,</li>
                    <li>Transaksi pada <strong>TPI</strong> (Tempat Pelelangan Ikan) dan <strong>BBI</strong> (Balai
                        Benih Ikan), termasuk perhitungan retribusi,</li>
                    <li>Manajemen dan pelaporan data pelaku usaha, kelompok usaha, kelompok binaan,</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900">3) Data yang Kami Kumpulkan</h2>
                <p>
                    Bergantung pada peran Anda dan fitur yang digunakan, kami dapat memproses kategori data berikut:
                </p>
                <ol class="list-decimal pl-6 space-y-1">
                    <li><strong>Data Akun &amp; Identitas</strong>: nama lengkap, NIB/NPWP, kata sandi (disimpan dalam
                        bentuk terenkripsi), peran/otorisasi pengguna.</li>
                    <li><strong>Data Kontak</strong>: nomor telepon, alamat email, alamat domisili/kantor.</li>
                    <li><strong>Data Pelaku Usaha &amp; Kelompok</strong>: nama usaha, jenis usaha, legalitas,
                        keanggotaan kelompok binaan/kelompok usaha.</li>
                    <li><strong>Data Transaksi &amp; Retribusi</strong>: catatan transaksi TPI/BBI, rincian item,
                        jumlah/berat, harga, tarif retribusi, bukti pembayaran.</li>
                    <li><strong>Penjadwalan &amp; Kegiatan</strong>: jadwal penyuluhan, pemateri, materi.</li>
                    <li><strong>Lokasi &amp; Perangkat (Mobile)</strong>: data lokasi perkiraan/tepat (jika diaktifkan),
                        ID perangkat, OS, model perangkat, log error/crash.</li>
                    <li><strong>Konten yang Diunggah</strong>: Transaksi yang terjadi di BBI atau TPI.</li>
                    <li><strong>Data Teknis &amp; Cookie (Web)</strong>: alamat IP, user-agent, cookie/pixel/SDK
                        analytics, log server, preferensi bahasa.</li>
                </ol>

                <h2 class="text-2xl font-semibold text-gray-900">4) Tujuan Pemrosesan Data</h2>
                <p>Kami menggunakan data untuk:</p>
                <ul class="list-disc pl-6 space-y-1">
                    <li>Menyediakan dan mengoperasikan fungsi aplikasi (otentikasi, otorisasi, penjadwalan, transaksi,
                        perhitungan retribusi, pelaporan).</li>
                </ul>

                <h2 class="text-2xl font-semibold text-gray-900">5) Berbagi Data dengan Pihak Ketiga</h2>
                <p>
                    Kami dapat membagikan data dengan kategori penerima berikut, sesuai prinsip minimisasi data dan
                    perjanjian pemrosesan:
                </p>
                <ul class="list-disc pl-6 space-y-1">
                    <li><strong>Penyedia layanan (processors)</strong>: Hosting (Dinas komunikasi dan informatika
                        kabupaten bantul),</li>
                    <li><strong>Mitra Operasional</strong>: pengelola TPI/BBI, instansi pembina/penyuluh terkait, hanya
                        sebatas yang diperlukan untuk operasional dan pelaporan,</li>
                    <li><strong>Perubahan organisasi</strong>: dalam hal merger/akuisisi/transfer layanan, dengan
                        perlindungan yang setara.</li>
                </ul>
                <p class="italic">Kami <strong>tidak</strong> menjual data pribadi.</p>

                <h2 class="text-2xl font-semibold text-gray-900">6) Penyimpanan &amp; Retensi</h2>
                <p>
                    Kami menyimpan data selama akun aktif dan selama diperlukan untuk memenuhi tujuan pemrosesan atau
                    kewajiban hukum. Setelah itu, data akan dihapus atau dianonimkan. Anda dapat meminta penghapusan
                    lebih awal, dengan mempertimbangkan batasan hukum/operasional.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">9) Keamanan</h2>
                <p>
                    Kami menerapkan langkah-langkah teknis dan organisatoris yang wajar (kontrol akses berbasis peran,
                    pencatatan aktivitas, backup berkala). Walau demikian, tidak ada metode yang 100% aman; kami
                    mendorong penggunaan kata sandi kuat, menjaga kredensial, dan memperbarui aplikasi secara berkala.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">10) Hak-Hak Anda</h2>
                <p>Bergantung pada hukum yang berlaku, Anda mungkin berhak untuk:</p>
                <ul class="list-disc pl-6 space-y-1">
                    <li>Mengakses, memperbaiki, memperbarui data Anda,</li>
                    <li>Menarik persetujuan,</li>
                    <li>Menolak/ membatasi pemrosesan tertentu,</li>
                    <li>Meminta penghapusan,</li>
                    <li>Meminta salinan portabel data Anda.</li>
                </ul>
                <p>
                    Untuk menggunakan hak-hak tersebut, hubungi Email&nbsp;<a class="text-blue-600 hover:underline"
                        href="mailto:dkp@bantulkab.go.id">dkp@bantulkab.go.id</a>&nbsp;atau Telepon <a
                        class="text-blue-600 hover:underline" href="tel:0274-367509"><strong>0274-367509</strong></a>.
                    Kami dapat meminta verifikasi identitas untuk melindungi akun Anda.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">12) Cookie &amp; Teknologi Pelacakan</h2>
                <p>
                    Pada situs web, kami menggunakan cookie/SDK untuk fungsi esensial (login, preferensi), analitik.
                    Anda dapat mengelola preferensi cookie melalui browser. Menonaktifkan cookie tertentu dapat
                    memengaruhi fungsi situs.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">13) Tautan Pihak Ketiga</h2>
                <p>
                    Layanan dapat memuat tautan ke situs/aplikasi pihak ketiga. Aktivitas Anda pada layanan pihak ketiga
                    tunduk pada kebijakan masing-masing pihak.&nbsp;Anda setuju dan mengakui bahwa kami tidak
                    bertanggung jawab atas setiap akses tidak sah atau kerugian apapun atas data biometrik yang
                    tersimpan di perangkat seluler anda.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">14) Perubahan Kebijakan</h2>
                <p>
                    Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Jika perubahan material dilakukan, kami
                    akan memberi tahu melalui aplikasi/situs atau email.
                </p>

                <h2 class="text-2xl font-semibold text-gray-900">15) Kontak</h2>
                <p>
                    Pertanyaan atau permintaan terkait kebijakan ini dapat dikirim ke Email :&nbsp;<a
                        class="text-blue-600 hover:underline"
                        href="mailto:dkp@bantulkab.go.id"><strong>dkp@bantulkab.go.id</strong></a> atau Telepon
                    0274-367509 atau alamat kantor di Komplek Perkantoran Terpadu Pemda II, Jl. Lingkar Timur Manding
                    Trirenggo Bantul Kabupaten Bantul, Daerah Istimewa Yogyakarta 55714.
                </p>
            </div>
        </div>
    </section>

@endsection
