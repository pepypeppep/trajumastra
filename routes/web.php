<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Guest\BerandaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Export\TransaksiExportController;
use App\Http\Controllers\Admin\Master\SpbuController;
use App\Http\Controllers\Admin\Master\BidangController;
use App\Http\Controllers\Admin\Master\MateriController;
use App\Http\Controllers\Admin\Master\PerahuController;
use App\Http\Controllers\Admin\Settings\RolesController;
use App\Http\Controllers\Admin\Settings\UsersController;
use App\Http\Controllers\Admin\Master\PenyuluhController;
use App\Http\Controllers\Admin\Kelola\KelolaTpiController;
use App\Http\Controllers\Admin\Master\JenisIkanController;
use App\Http\Controllers\Admin\Kelola\KelolaUptdController;
use App\Http\Controllers\Admin\Master\JenisAssetController;
use App\Http\Controllers\Admin\Master\JenisUsahaController;
use App\Http\Controllers\Admin\Master\AlatTangkapController;
use App\Http\Controllers\Admin\Master\BentukUsahaController;
use App\Http\Controllers\Admin\Laporan\TransaksiTpiController;
use App\Http\Controllers\Admin\Master\JenisPerairanController;
use App\Http\Controllers\Admin\Master\UuRekomendasiController;
use App\Http\Controllers\Admin\Settings\NavigationsController;
use App\Http\Controllers\Admin\Settings\PreferencesController;
use App\Http\Controllers\Admin\Kelola\KelolaPokdakanController;
use App\Http\Controllers\Admin\Kelola\KelolaStokIkanController;
use App\Http\Controllers\Admin\Laporan\TransaksiUptdController;
use App\Http\Controllers\Admin\Master\AssetDigunakanController;
use App\Http\Controllers\Admin\Master\JenisTransaksiController;
use App\Http\Controllers\Admin\Kelola\KelolaHargaIkanController;
use App\Http\Controllers\Admin\Kelola\KelolaPoklasharController;
use App\Http\Controllers\Admin\Kelola\KelolaPokmaswasController;
use App\Http\Controllers\Admin\Master\JenisPendaratanController;
use App\Http\Controllers\Admin\Master\JenisPenyuluhanController;
use App\Http\Controllers\Admin\Master\JenisUsahaSaranaController;
use App\Http\Controllers\Admin\Master\RangePenghasilanController;
use App\Http\Controllers\Admin\Kelola\KelolaPelakuUsahaController;
use App\Http\Controllers\Admin\Kelola\KelolaKelompokUsahaController;
use App\Http\Controllers\Admin\Kelola\KelolaKelompokBinaanController;
use App\Http\Controllers\Admin\Master\PersyaratanPengajuanController;
use App\Http\Controllers\Admin\Master\JenisKlasifikasiUsahaController;
use App\Http\Controllers\Admin\Kelola\KelolaJadwalPendampinganController;
use App\Http\Controllers\Admin\Kelola\PermohonanRekomendasiBbmController;

/** ======================== BYPASS SSO
 * !!! TOLONG ROUTE INI DIHAPUS JIKA SUDAH DI PRODUCTION !!!
 */
Route::get('ssobypass', App\Http\Controllers\Auth\SSOBypass::class);

/* ======================== GUEST */
Route::resource('/', BerandaController::class)->names(['beranda']);
Route::get('/register', [BerandaController::class, 'create'])->name('pendaftaran');
Route::post('/register-store', [BerandaController::class, 'store'])->name('pendaftaran.store');

/* ======================== ADMIN */
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });
    /* ---- Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::redirect('/', '/dashboard');

    /* ---- Master Data */
    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        /* Asset Digunakan */
        Route::resource('asset-digunakan', AssetDigunakanController::class)->names('asset-digunakan');
        /* Range Penghasilan */
        Route::resource('range-penghasilan', RangePenghasilanController::class)->names('range-penghasilan');
        /* Bentuk Usaha */
        Route::resource('bentuk-usaha', BentukUsahaController::class)->names('bentuk-usaha');
        /* Bidang */
        Route::resource('bidang', BidangController::class)->names('bidang');
        /* Alat Tangkap */
        Route::resource('alat-tangkap', AlatTangkapController::class)->names('alat-tangkap');
        /* Jenis Asset */
        Route::resource('jenis-asset', JenisAssetController::class)->names('jenis-asset');
        /* Jenis Ikan */
        Route::resource('jenis-ikan', JenisIkanController::class)->names('jenis-ikan');
        /* Jenis Pendaratan */
        Route::resource('jenis-pendaratan', JenisPendaratanController::class)->names('jenis-pendaratan');
        /* Jenis Perairan */
        Route::resource('jenis-perairan', JenisPerairanController::class)->names('jenis-perairan');
        /* Jenis Transaksi */
        Route::resource('jenis-transaksi', JenisTransaksiController::class)->names('jenis-transaksi');
        /* Jenis Usaha */
        Route::resource('jenis-usaha', JenisUsahaController::class)->names('jenis-usaha');
        /* Jenis Usaha Sarana */
        Route::resource('jenis-usaha-sarana', JenisUsahaSaranaController::class)->names('jenis-usaha-sarana');
        /* Jenis Klasifikasi Usaha */
        Route::resource('jenis-klasifikasi-usaha', JenisKlasifikasiUsahaController::class)->names('jenis-klasifikasi-usaha');
        /* Perahu */
        Route::resource('perahu', PerahuController::class)->names('perahu');
        /* SPBU */
        Route::resource('spbu', SpbuController::class)->names('spbu');
        /* UU Rekomendasi */
        Route::resource('uu-rekomendasi', UuRekomendasiController::class)->names('uu-rekomendasi');
        /* Persyaratan Pengajuan */
        Route::resource('persyaratan-pengajuan', PersyaratanPengajuanController::class)->names('persyaratan-pengajuan');
        /* Jenis Penyuluhan */
        Route::resource('jenis-penyuluhan', JenisPenyuluhanController::class)->names('jenis-penyuluhan');
        /* Kelola Penyuluh */
        Route::resource('penyuluh', PenyuluhController::class)->names('penyuluh');
        /* Kelola Materi */
        Route::get('/materi/attachment/{id}', [MateriController::class, 'attachment'])->name('materi.attachment');
        Route::resource('materi', MateriController::class)->names('materi');
    });

    /* ---- Kelola */
    Route::group(['prefix' => 'kelola', 'as' => 'kelola.'], function () {
        /* Permohonan Rekomendasi BBM */
        Route::resource('permohonan-rekomendasi-bbm', PermohonanRekomendasiBbmController::class)->names('permohonan-rekomendasi-bbm');
        /* Kelola Pelaku Usaha */
        Route::resource('pelaku-usaha', KelolaPelakuUsahaController::class)->names('pelaku-usaha');
        /* Kelola Jadwal Pendampingan */
        Route::get('/jadwal-pendampingan/attachment/{id}', [KelolaJadwalPendampinganController::class, 'attachmentDownload'])->name('jadwal-pendampingan.attachment-download');
        Route::resource('jadwal-pendampingan', KelolaJadwalPendampinganController::class)->names('jadwal-pendampingan');
        /* Kelola UPTD */
        Route::resource('uptd', KelolaUptdController::class)->names('uptd');
        /* Kelola TPI */
        Route::resource('tpi', KelolaTpiController::class)->names('tpi');
        /* Kelola Stok Ikan */
        Route::resource('stok-ikan', KelolaStokIkanController::class)->names('stok-ikan');
        /* Kelola Harga Ikan */
        Route::resource('harga-ikan', KelolaHargaIkanController::class)->names('harga-ikan');
        /* Kelola Kelompok Binaan */
        Route::resource('kelompok-binaan', KelolaKelompokBinaanController::class)->names('kelompok-binaan');
        /* Kelola Pokdakan */
        Route::resource('pokdakan', KelolaPokdakanController::class)->names('pokdakan');
        /* Kelola Poklashar */
        Route::resource('poklashar', KelolaPoklasharController::class)->names('poklashar');
        /* Kelola Pokmaswas */
        Route::resource('pokmaswas', KelolaPokmaswasController::class)->names('pokmaswas');
        /* Kelola Kelompok Usaha */
        Route::resource('kelompok-usaha', KelolaKelompokUsahaController::class)->names('kelompok-usaha');
        Route::get('kelompok-usaha/kelompok-binaan/{id}', [KelolaKelompokUsahaController::class, 'getKelompokBinaanById'])->name('kelompok-usaha.kelompok-binaan');
    });

    /* ---- Laporan */
    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        /* Transaksi TPI */
        Route::resource('transaksi-tpi', TransaksiTpiController::class)->names('transaksi-tpi');
        /* Transaksi BBI */
        Route::resource('transaksi-bbi', TransaksiUptdController::class)->names('transaksi-bbi');

        Route::get('/export', [TransaksiExportController::class, 'export'])->name('transaksi.export');
    });

    /* ---- My Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---- Settings */
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        /* Users */
        Route::resource('users', UsersController::class)->names('users');
        /* Roles */
        Route::resource('roles', RolesController::class)->names('roles');
        Route::put('/roles/{role}/permissions', [RolesController::class, 'givePermission'])->name('roles.permissions');
        /* Navigation */
        Route::resource('navs', NavigationsController::class)->names('navs');
        /* Preferences */
        Route::resource('preferences', PreferencesController::class)->names('preferences');
    });
});

require __DIR__ . '/auth.php';
