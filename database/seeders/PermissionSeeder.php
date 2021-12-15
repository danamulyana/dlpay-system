<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Admin Management
            'super_admin',
            'users_management_access',
            'users_management_edit',
            'users_management_add',
            'users_management_delete',
            // Master Data
            'masterData_access',

            'departement_create',
            'departement_edit',
            'departement_show',
            'departement_delete',
            'subdepartement_create',
            'subdepartement_edit',
            'subdepartement_show',
            'subdepartement_delete',
            'pegawai_create',
            'pegawai_edit',
            'pegawai_show',
            'pegawai_delete',
            // Management Device
            'ManagementDevice_access',

            'location_create',
            'location_edit',
            'location_show',
            'location_delete',
            'attandanceDevice_create',
            'attandanceDevice_edit',
            'attandanceDevice_show',
            'attandanceDevice_delete',
            'doorlockDevice_create',
            'doorlockDevice_edit',
            'doorlockDevice_show',
            'doorlockDevice_delete',
            'remark_create',
            'remark_edit',
            'remark_show',
            'remark_delete',

            // Management Attandance
            'ManagementAttendance_access',

            // 
            'approval_create',
            'approval_edit',
            'approval_show',
            'approval_delete',
            'approval_access',
        ];

        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        };
    }
}
