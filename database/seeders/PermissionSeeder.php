<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'super_admin',
            'users_management_access',
            'admin_create',
            'admin_edit',
            'admin_show',
            'admin_delete',
            'admin_access',
            'approval_create',
            'approval_edit',
            'approval_show',
            'approval_delete',
            'approval_access',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        };
    }
}
