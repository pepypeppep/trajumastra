<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // The structure of each navigation item is as follows:
    // [
    //     'id' => null,
    //     'name' => '',
    //     'page' => 'admin', // or 'guest'
    //     'url' => '',
    //     'slug' => '',
    //     'icon' => '',
    //     'order' => 1,
    //     'parent_id' => null,
    //     'active' => true,
    //     'display' => true,
    // ],
    public function run(): void
    {
        $navigationsAdmin = [
            /* ---------------------------------------------------------
            *                      ADMIN PAGE
            ---------------------------------------------------------*/
            /*
            ! ============== Dashboard
            */
            [
                'id' => 1,
                'name' => 'Dashboard',
                'page' => 'admin',
                'url' => 'dashboard',
                'slug' => 'dashboard',
                'icon' => 'home',
                'order' => 1,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],

            /*
            ! ============== Master Data (Parent)
            */
            [
                'id' => 100,
                'name' => 'Master Data',
                'page' => 'admin', // or 'guest'
                'url' => '#',
                'slug' => 'master',
                'icon' => 'database-zap',
                'order' => 100,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],
            // Bidang
            [
                'id' => 101,
                'name' => 'Bidang',
                'page' => 'admin', // or 'guest'
                'url' => 'master.bidang.index',
                'slug' => 'bidang',
                'icon' => '',
                'order' => 1,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Bentuk Usaha
            [
                'id' => 102,
                'name' => 'Bentuk Usaha',
                'page' => 'admin', // or 'guest'
                'url' => 'master.bentuk-usaha.index',
                'slug' => 'bentuk-usaha',
                'icon' => '',
                'order' => 2,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Usaha
            [
                'id' => 103,
                'name' => 'Jenis Usaha',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-usaha.index',
                'slug' => 'jenis-usaha',
                'icon' => '',
                'order' => 3,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Usaha Sarana
            [
                'id' => 104,
                'name' => 'Jenis Usaha Sarana',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-usaha-sarana.index',
                'slug' => 'jenis-usaha-sarana',
                'icon' => '',
                'order' => 4,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Klasifikasi Usaha
            [
                'id' => 105,
                'name' => 'Jenis Klasifikasi Usaha',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-klasifikasi-usaha.index',
                'slug' => 'jenis-klasifikasi-usaha',
                'icon' => '',
                'order' => 5,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Range Penghasilan
            [
                'id' => 106,
                'name' => 'Range Penghasilan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.range-penghasilan.index',
                'slug' => 'range-penghasilan',
                'icon' => '',
                'order' => 6,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Penyuluhan
            [
                'id' => 107,
                'name' => 'Jenis Penyuluhan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-penyuluhan.index',
                'slug' => 'jenis-penyuluhan',
                'icon' => '',
                'order' => 7,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Materi
            [
                'id' => 108,
                'name' => 'Materi Penyuluhan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.materi.index',
                'slug' => 'master-materi',
                'icon' => '',
                'order' => 8,
                'parent_id' => 100,
                'active' => false,
                'display' => false,
            ],
            // Penyuluh
            [
                'id' => 109,
                'name' => 'Penyuluh (Pemateri)',
                'page' => 'admin', // or 'guest'
                'url' => 'master.penyuluh.index',
                'slug' => 'master-penyuluh',
                'icon' => '',
                'order' => 9,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Asset
            [
                'id' => 110,
                'name' => 'Jenis Asset',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-asset.index',
                'slug' => 'jenis-asset',
                'icon' => '',
                'order' => 10,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Asset Digunakan
            [
                'id' => 111,
                'name' => 'Asset Digunakan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.asset-digunakan.index',
                'slug' => 'asset-digunakan',
                'icon' => '',
                'order' => 11,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Alat Tangkap
            [
                'id' => 112,
                'name' => 'Alat Tangkap',
                'page' => 'admin', // or 'guest'
                'url' => 'master.alat-tangkap.index',
                'slug' => 'alat-tangkap',
                'icon' => '',
                'order' => 12,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Perahu
            [
                'id' => 113,
                'name' => 'Perahu',
                'page' => 'admin', // or 'guest'
                'url' => 'master.perahu.index',
                'slug' => 'perahu',
                'icon' => '',
                'order' => 13,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Ikan
            [
                'id' => 114,
                'name' => 'Jenis Ikan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-ikan.index',
                'slug' => 'jenis-ikan',
                'icon' => '',
                'order' => 14,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Perairan
            [
                'id' => 115,
                'name' => 'Jenis Perairan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-perairan.index',
                'slug' => 'jenis-perairan',
                'icon' => '',
                'order' => 15,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Pendaratan
            [
                'id' => 116,
                'name' => 'Jenis Pendaratan',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-pendaratan.index',
                'slug' => 'jenis-pendaratan',
                'icon' => '',
                'order' => 16,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // UU Rekomendasi
            [
                'id' => 117,
                'name' => 'UU Rekomendasi',
                'page' => 'admin', // or 'guest'
                'url' => 'master.uu-rekomendasi.index',
                'slug' => 'uu-rekomendasi',
                'icon' => '',
                'order' => 17,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],

            // Persyaratan Pengajuan BBM
            [
                'id' => 118,
                'name' => 'Persyaratan Pengajuan BBM',
                'page' => 'admin', // or 'guest'
                'url' => 'master.persyaratan-pengajuan.index',
                'slug' => 'persyaratan-pengajuan',
                'icon' => '',
                'order' => 18,
                'parent_id' => 100,
                'active' => false,
                'display' => false,
            ],
            // SPBU
            [
                'id' => 119,
                'name' => 'SPBU',
                'page' => 'admin', // or 'guest'
                'url' => 'master.spbu.index',
                'slug' => 'spbu',
                'icon' => '',
                'order' => 19,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],
            // Jenis Transaksi
            [
                'id' => 120,
                'name' => 'Jenis Transaksi',
                'page' => 'admin', // or 'guest'
                'url' => 'master.jenis-transaksi.index',
                'slug' => 'jenis-transaksi',
                'icon' => '',
                'order' => 20,
                'parent_id' => 100,
                'active' => true,
                'display' => true,
            ],

            /*
            ! ============== Kelola (Parent)
            */
            [
                'id' => 200,
                'name' => 'Kelola',
                'page' => 'admin',
                'url' => '#',
                'slug' => 'kelola',
                'icon' => 'pencil-ruler',
                'order' => 200,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],

            // Permohonan Rekomendasi BBM
            [
                'id' => 201,
                'name' => 'Permohonan Rekomendasi BBM',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.permohonan-rekomendasi-bbm.index',
                'slug' => 'kelola-permohonan-rekomendasi-bbm',
                'icon' => '',
                'order' => 1,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Stok Ikan
            [
                'id' => 202,
                'name' => 'Kelola Stok Ikan',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.stok-ikan.index',
                'slug' => 'kelola-stok-ikan',
                'icon' => '',
                'order' => 2,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Harga Ikan
            [
                'id' => 203,
                'name' => 'Kelola Harga Ikan',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.harga-ikan.index',
                'slug' => 'kelola-harga-ikan',
                'icon' => '',
                'order' => 3,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola UPTD
            [
                'id' => 204,
                'name' => 'Kelola UPTD',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.uptd.index',
                'slug' => 'kelola-uptd',
                'icon' => '',
                'order' => 4,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola TPI
            [
                'id' => 205,
                'name' => 'Kelola TPI',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.tpi.index',
                'slug' => 'kelola-tpi',
                'icon' => '',
                'order' => 5,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Jadwal Pendampingan
            [
                'id' => 209,
                'name' => 'Kelola Jadwal Pendampingan ',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.jadwal-pendampingan.index',
                'slug' => 'kelola-jadwal-pendampingan',
                'icon' => '',
                'order' => 9,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Pelaku Usaha
            [
                'id' => 210,
                'name' => 'Kelola Pelaku Usaha',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.pelaku-usaha.index',
                'slug' => 'kelola-pelaku-usaha',
                'icon' => '',
                'order' => 10,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // // Kelola Kelompok Binaan
            // [
            //     'id' => 211,
            //     'name' => 'Kelola Kelompok Binaan',
            //     'page' => 'admin', // or 'guest'
            //     'url' => 'kelola.kelompok-binaan.index',
            //     'slug' => 'kelola-kelompok-binaan',
            //     'icon' => '',
            //     'order' => 11,
            //     'parent_id' => 200,
            //     'active' => true,
            //     'display' => true,
            // ],

            // Kelola Pokdakan
            [
                'id' => 212,
                'name' => 'Kelola Pokdakan',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.pokdakan.index',
                'slug' => 'kelola-pokdakan',
                'icon' => '',
                'order' => 12,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Poklashar
            [
                'id' => 213,
                'name' => 'Kelola Poklashar',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.poklashar.index',
                'slug' => 'kelola-poklashar',
                'icon' => '',
                'order' => 12,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Pokmaswas
            [
                'id' => 214,
                'name' => 'Kelola Pokmaswas',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.pokmaswas.index',
                'slug' => 'kelola-pokmaswas',
                'icon' => '',
                'order' => 13,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],
            // Kelola Kelompok Usaha
            [
                'id' => 215,
                'name' => 'Kelola Kelompok Usaha',
                'page' => 'admin', // or 'guest'
                'url' => 'kelola.kelompok-usaha.index',
                'slug' => 'kelola-kelompok-usaha',
                'icon' => '',
                'order' => 11,
                'parent_id' => 200,
                'active' => true,
                'display' => true,
            ],

            /*
            ! ============== Laporan (Parent)
            */
            [
                'id' => 300,
                'name' => 'Laporan',
                'page' => 'admin',
                'url' => '#',
                'slug' => 'laporan',
                'icon' => 'book-open-text',
                'order' => 300,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],
            // Transaksi TPI
            [
                'id' => 301,
                'name' => 'Transaksi TPI',
                'page' => 'admin', // or 'guest'
                'url' => 'laporan.transaksi-tpi.index',
                'slug' => 'laporan-transaksi-tpi',
                'icon' => '',
                'order' => 1,
                'parent_id' => 300,
                'active' => true,
                'display' => true,
            ],
            // Transaksi BBI
            [
                'id' => 302,
                'name' => 'Transaksi BBI',
                'page' => 'admin', // or 'guest'
                'url' => 'laporan.transaksi-bbi.index',
                'slug' => 'laporan-transaksi-bbi',
                'icon' => '',
                'order' => 2,
                'parent_id' => 300,
                'active' => true,
                'display' => true,
            ],

            /*
            ! ============== Setting (Parent)
            */
            [
                'id' => 500,
                'name' => 'Profil Saya',
                'page' => 'admin',
                'url' => 'profile.edit',
                'slug' => 'profile',
                'icon' => 'user',
                'order' => 500,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],
            [
                'id' => 501,
                'name' => 'Pengaturan',
                'page' => 'admin',
                'url' => '#',
                'slug' => 'settings',
                'icon' => 'settings',
                'order' => 501,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],
            [
                'id' => 502,
                'name' => 'Pengguna',
                'page' => 'admin',
                'url' => 'settings.users.index',
                'slug' => 'settings-users',
                'icon' => '', // Assuming no icon specified
                'order' => 501,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
            ],
            [
                'id' => 503,
                'name' => 'Peran',
                'page' => 'admin',
                'url' => 'settings.roles.index',
                'slug' => 'settings-roles',
                'icon' => '', // Assuming no icon specified
                'order' => 502,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
            ],
            [
                'id' => 504,
                'name' => 'Menu',
                'page' => 'admin',
                'url' => 'settings.navs.index',
                'slug' => 'settings-navs',
                'icon' => '', // Assuming no icon specified
                'order' => 503,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
            ],
            [
                'id' => 505,
                'name' => 'Preferensi',
                'page' => 'admin',
                'url' => 'settings.preferences.index',
                'slug' => 'settings-preferences',
                'icon' => '', // Assuming no icon specified
                'order' => 504,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
            ],

        ];

        $navigationGuest = [
            /* ---------------------------------------------------------
            *                      GUEST PAGE
            ---------------------------------------------------------*/
            /* Dashboard */
            [
                'id' => 600,
                'name' => 'Beranda',
                'page' => 'guest',
                'url' => 'beranda.index',
                'slug' => 'beranda',
                'icon' => 'home',
                'order' => 600,
                'parent_id' => null,
                'active' => true,
                'display' => true,
            ],
        ];

        // Insert data into the 'navigations' table
        DB::table('navigations')->insert($navigationsAdmin);
        DB::table('navigations')->insert($navigationGuest);
    }
}
