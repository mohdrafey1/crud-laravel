<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

        // Define permissions
        $permissions = [
            'edit products',
            'delete products',
            'create products',
            'view products',
        ];

        // Create permissions if they do not exist
        foreach ($permissions as $permission) {
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Create roles and assign created permissions

        $roles = [
            'admin' => Permission::all(),
            'editor' => ['edit products', 'create products', 'view products'],
            'viewer' => ['view products'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
