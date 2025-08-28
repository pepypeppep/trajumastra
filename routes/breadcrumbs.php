<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Example Breadcrumbs
 */

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Dashboard
 */

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Master
 */

Breadcrumbs::for('master', function (BreadcrumbTrail $trail) {
    $trail->push('Master', "javascript:void(0)");
});

/* Asset Digunakan */
Breadcrumbs::for('master.asset-digunakan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Asset Digunakan', route('master.asset-digunakan.index'));
});

/* Range Penghasilan */
Breadcrumbs::for('master.range-penghasilan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Range Penghasilan', route('master.range-penghasilan.index'));
});
/* Jenis Penyuluhan */
Breadcrumbs::for('master.jenis-penyuluhan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Penyuluhan', route('master.jenis-penyuluhan.index'));
});

/* Bentuk Usaha */
Breadcrumbs::for('master.bentuk-usaha', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Bentuk Usaha', route('master.bentuk-usaha.index'));
});

/* Bidang */
Breadcrumbs::for('master.bidang', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Bidang', route('master.bidang.index'));
});

/* Alat Tangkap */
Breadcrumbs::for('master.alat-tangkap', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Alat Tangkap', route('master.alat-tangkap.index'));
});

/* Jenis Asset */
Breadcrumbs::for('master.jenis-asset', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Asset', route('master.jenis-asset.index'));
});

/* Jenis Ikan */
Breadcrumbs::for('master.jenis-ikan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Ikan', route('master.jenis-ikan.index'));
});

/* Jenis Pendaratan */
Breadcrumbs::for('master.jenis-pendaratan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Pendaratan', route('master.jenis-pendaratan.index'));
});

/* Jenis Perairan */
Breadcrumbs::for('master.jenis-perairan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Perairan', route('master.jenis-perairan.index'));
});

/* Jenis Transaksi */
Breadcrumbs::for('master.jenis-transaksi', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Transaksi', route('master.jenis-transaksi.index'));
});

/* Jenis Usaha */
Breadcrumbs::for('master.jenis-usaha', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Usaha', route('master.jenis-usaha.index'));
});

/* Jenis Usaha Sarana */
Breadcrumbs::for('master.jenis-usaha-sarana', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Usaha Sarana', route('master.jenis-usaha-sarana.index'));
});

/* Jenis Klasifikasi Usaha */
Breadcrumbs::for('master.jenis-klasifikasi-usaha', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Klasifikasi Usaha', route('master.jenis-klasifikasi-usaha.index'));
});

/* Perahu */
Breadcrumbs::for('master.perahu', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Perahu', route('master.perahu.index'));
});

/* SPBU */
Breadcrumbs::for('master.spbu', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('SPBU', route('master.spbu.index'));
});

/* UU Rekomendasi */
Breadcrumbs::for('master.uu-rekomendasi', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('UU Rekomendasi', route('master.uu-rekomendasi.index'));
});

/* Persyaratan Pengajuan */
Breadcrumbs::for('master.persyaratan-pengajuan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Persyaratan Pengajuan', route('master.persyaratan-pengajuan.index'));
});

/* Penyuluh */
Breadcrumbs::for('master.penyuluh', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Penyuluh', route('master.penyuluh.index'));
});

/* Materi */
Breadcrumbs::for('master.materi', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Materi Penyuluhan', route('master.materi.index'));
});


/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Kelola
 */
Breadcrumbs::for('kelola', function (BreadcrumbTrail $trail) {
    $trail->push('Kelola', "javascript:void(0)");
});

/* Permohonan Rekomendasi BBM */
Breadcrumbs::for('kelola.permohonan-rekomendasi-bbm', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Permohonan Rekomendasi BBM', route('kelola.permohonan-rekomendasi-bbm.index'));
});

/* Kelola Pelaku Usaha */
Breadcrumbs::for('kelola.pelaku-usaha', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Pelaku Usaha', route('kelola.pelaku-usaha.index'));
});

/* Kelola Kelompok Binaan */
Breadcrumbs::for('kelola.kelompok-binaan', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Kelompok Binaan', route('kelola.kelompok-binaan.index'));
});

/* Kelola Berita */
Breadcrumbs::for('kelola.berita', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Berita', route('kelola.berita.index'));
});

/* Kelola Jadwal Pendampingan */
Breadcrumbs::for('kelola.jadwal-pendampingan', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Jadwal Pendampingan atau Penyuluhan', route('kelola.jadwal-pendampingan.index'));
});

/* Kelola UPTD */
Breadcrumbs::for('kelola.uptd', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('UPTD', route('kelola.uptd.index'));
});

/* Kelola Koordinator UPTD TPI */
Breadcrumbs::for('kelola.uptd-tpi', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('UPTD TPI', route('kelola.koordinator-uptd-tpi.index'));
});

/* Kelola TPI */
Breadcrumbs::for('kelola.tpi', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('TPI', route('kelola.tpi.index'));
});

/* Kelola Stok Ikan */
Breadcrumbs::for('kelola.stok-ikan', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Stok Ikan', route('kelola.stok-ikan.index'));
});

/* Kelola Harga Ikan */
Breadcrumbs::for('kelola.harga-ikan', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Harga Ikan', route('kelola.harga-ikan.index'));
});

/* Kelola Pokdakan */
Breadcrumbs::for('kelola.pokdakan', function (BreadcrumbTrail $trail) {
    $trail->parent('kelola');
    $trail->push('Pokdakan', route('kelola.pokdakan.index'));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Laporan
 */
Breadcrumbs::for('laporan', function (BreadcrumbTrail $trail) {
    $trail->push('Laporan', "javascript:void(0)");
});

/* Transaksi TPI */
Breadcrumbs::for('laporan.transaksi-tpi', function (BreadcrumbTrail $trail) {
    $trail->parent('laporan');
    $trail->push('Transaksi TPI', route('laporan.transaksi-tpi.index'));
});

/* Transaksi UPTD */
Breadcrumbs::for('laporan.transaksi-uptd', function (BreadcrumbTrail $trail) {
    $trail->parent('laporan');
    $trail->push('Transaksi UPTD', route('laporan.transaksi-uptd.index'));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Profile
 */
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil Saya', route('profile.edit'));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Settings
 */

Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaturan', "javascript:void(0)");
});

Breadcrumbs::for('navigations', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Menu', route('settings.navs.index'));
});

Breadcrumbs::for('navigation-edit', function (BreadcrumbTrail $trail, $nav, $title = null) {
    $trail->parent('navigation');
    $trail->push("Edit Menu $title", route('settings.navs.edit', $nav));
});

Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Pengguna', route('settings.users.index'));
});

Breadcrumbs::for('users-create', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push('Tambah Pengguna', route('settings.users.create'));
});

Breadcrumbs::for('users-edit', function (BreadcrumbTrail $trail, $user, $name = null) {
    $trail->parent('users');
    $trail->push("Edit Pengguna $name", route('settings.users.edit', $user));
});

Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Peran', route('settings.roles.index'));
});

Breadcrumbs::for('roles-permissions', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push("Hak Akses Peran {$role->name}", route('settings.roles.show', $role->id));
});

Breadcrumbs::for('preferences', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Preferensi', route('settings.preferences.index'));
});
