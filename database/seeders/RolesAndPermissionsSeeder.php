<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = PermissionsEnum::values();
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        Role::create(['name' => RolesEnum::ADMIN])->givePermissionTo($permissions);
        Role::create(['name' => RolesEnum::USER])->givePermissionTo([
            PermissionsEnum::LIST_USERS,
            PermissionsEnum::VIEW_USER,
            PermissionsEnum::CREATE_USER,
            PermissionsEnum::EDIT_USER
        ]);
        Role::create(['name' => RolesEnum::TRAINER])->givePermissionTo([
            PermissionsEnum::LIST_USERS,
            PermissionsEnum::VIEW_USER,
        ]);

        Role::create(['name' => RolesEnum::STUDENT]);
    }
}
