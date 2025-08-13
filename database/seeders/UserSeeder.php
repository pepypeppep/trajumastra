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
use App\Models\Navigation as ModelsNavigation;


class UserSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions for navigation
        $navSlug = ModelsNavigation::pluck('slug')->toArray();
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
        $penyuluhRole = Role::create(['name' => RoleEnum::PENYULUH->value]);
        $pelakuUsahaRole = Role::create(['name' => RoleEnum::PELAKU_USAHA->value]);

        // Sync permissions for each role
        $developerPermissions = Permission::all();
        $developerRole->syncPermissions($developerPermissions);

        // Create Developer User Account
        $developerAccount = User::factory()->create([
            'name' => 'Trajumastra Developer',
            'username' => 'trajumastra_developer',
            'email' => 'trajumastra@developer.com',
            'password' => Hash::make('123456789'),
        ]);
        $developerAccount->assignRole($developerRole);
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
        return Permission::insert($permissionsList);
    }
}
