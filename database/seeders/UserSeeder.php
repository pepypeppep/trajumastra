<?php

namespace Database\Seeders;

use App\Enums\ParentRelationshipEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\Navigation;


class UserSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions for navigation
        $navSlug = Navigation::pluck('slug')->toArray();
        $this->generatePermissions($navSlug);

        // create roles and assign existing permissions
        $developerRole = Role::create(['name' => RoleEnum::DEVELOPER->value]);
        $superAdminRole = Role::create(['name' => RoleEnum::SUPERADMIN->value]);
        $adminRole = Role::create(['name' => RoleEnum::ADMIN->value]);
        $adminTeknisRole = Role::create(['name' => RoleEnum::ADMIN_TEKNIS->value]);
        $kabidEselonIIIRole = Role::create(['name' => RoleEnum::KABID_ESELON_III->value]);
        $sekdinRole = Role::create(['name' => RoleEnum::SEKDIN->value]);
        $kepalaDinasRole = Role::create(['name' => RoleEnum::KEPALA_DINAS->value]);
        $petugasTPIRole = Role::create(['name' => RoleEnum::PETUGAS_TPI->value]);
        $petugasUPTDRole = Role::create(['name' => RoleEnum::PETUGAS_UPTD->value]);
        $penyuluhRole = Role::create(['name' => RoleEnum::PENYULUH->value]);
        $pelakuUsahaRole = Role::create(['name' => RoleEnum::PELAKU_USAHA->value]);

        // Sync permissions for each role
        $developerPermissions = Permission::all();
        $developerRole->syncPermissions($developerPermissions);

        // Sync permissions for petugas role
        $tpiPermissions = $developerPermissions->filter(fn($permission) => in_array($permission->name, [
            'dashboard.read',
            'kelola.read',
            'kelola.create',
            'kelola.update',
            'kelola.delete',
            'kelola-stok-ikan.read',
            'kelola-stok-ikan.create',
            'kelola-stok-ikan.update',
            'kelola-stok-ikan.delete',
            'transaksi.read',
            'transaksi.create',
            'transaksi.update',
            'transaksi.delete',
            'laporan.read',
            'laporan.create',
            'laporan.update',
            'laporan.delete',
            'laporan-transaksi-tpi.read',
            'laporan-transaksi-tpi.create',
            'laporan-transaksi-tpi.update',
            'laporan-transaksi-tpi.delete',
            'profile.read',
            'profile.create',
            'profile.update',
            'profile.delete',
        ]));
        $petugasTPIRole->syncPermissions($tpiPermissions);
        $uptdPermissions = $developerPermissions->filter(fn($permission) => in_array($permission->name, [
            'dashboard.read',
            'kelola.read',
            'kelola.create',
            'kelola.update',
            'kelola.delete',
            'kelola-stok-ikan.read',
            'kelola-stok-ikan.create',
            'kelola-stok-ikan.update',
            'kelola-stok-ikan.delete',
            'transaksi.read',
            'transaksi.create',
            'transaksi.update',
            'transaksi.delete',
            'laporan.read',
            'laporan.create',
            'laporan.update',
            'laporan.delete',
            'laporan-transaksi-uptd.read',
            'laporan-transaksi-uptd.create',
            'laporan-transaksi-uptd.update',
            'laporan-transaksi-uptd.delete',
            'profile.read',
            'profile.create',
            'profile.update',
            'profile.delete',
        ]));
        $petugasUPTDRole->syncPermissions($uptdPermissions);

        // Sync permissions for pelakuusaha role
        $rekomendasiBbmPermissions = $developerPermissions->filter(fn($permission) => in_array($permission->name, [
            'permohonan-rekomendasi-bbm.read',
            'permohonan-rekomendasi-bbm.create',
            'permohonan-rekomendasi-bbm.update',
        ]));
        $pelakuUsahaRole->syncPermissions($rekomendasiBbmPermissions);

        // Create Developer User Account
        $developerAccount = User::factory()->create([
            'name' => 'Trajumastra',
            'username' => 'admin',
            'email' => 'admin@admin.net'
        ]);
        $developerAccount->assignRole($developerRole);

        $petugasUPTDAccount = User::factory()->create([
            'uptd_id' => 1,
            'name' => 'Petugas UPTD',
            'username' => 'admin_uptd',
            'email' => 'uptd@uptd.net'
        ]);
        $petugasUPTDAccount->assignRole($petugasUPTDRole);

        $petugasTPIAccount = User::factory()->create([
            'uptd_id' => 7,
            'name' => 'Petugas TPI',
            'username' => 'admin_tpi',
            'email' => 'tpi@tpi.net'
        ]);
        $petugasTPIAccount->assignRole($petugasTPIRole);

        $penyuluhAccount = User::factory()->create([
            'name' => 'Penyuluh',
            'username' => 'penyuluh',
            'email' => 'penyuluh@penyuluh.net'
        ]);
        $penyuluhAccount->assignRole($penyuluhRole);

        $pelakuUsahaAccount = User::factory()->create([
            'name' => 'Pengusaha',
            'username' => 'pengusaha',
            'email' => 'pengusaha@pengusaha.net'
        ]);
        $pelakuUsahaAccount->assignRole($pelakuUsahaRole);
    }

    /**
     * Fungsi untuk menghasilkan permission berdasarkan slug navigasi
     */
    public function generatePermissions($navSlugs)
    {
        $permissionsList = [];
        foreach ($navSlugs as $slug) {
            $permissionsList[] = ['name' => $slug . '.read', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $slug . '.create', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $slug . '.update', 'guard_name' => 'web'];
            $permissionsList[] = ['name' => $slug . '.delete', 'guard_name' => 'web'];
        }

        // Transaksi
        $permissionsList[] = ['name' => 'transaksi.read', 'guard_name' => 'web'];
        $permissionsList[] = ['name' => 'transaksi.create', 'guard_name' => 'web'];
        $permissionsList[] = ['name' => 'transaksi.update', 'guard_name' => 'web'];
        $permissionsList[] = ['name' => 'transaksi.delete', 'guard_name' => 'web'];

        return Permission::insert($permissionsList);
    }
}
