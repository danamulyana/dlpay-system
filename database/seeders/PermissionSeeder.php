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
        $permissions = [
            // Admin Management
            'super_admin',
            'users_management_access', //sudah
            'users_management_edit', //sudah
            'users_management_add', //sudah
            'users_management_delete', //sudah
            // Master Data
            'masterData_access', //sudah

            'departement_create',
            'departement_edit',
            'departement_show', //sudah
            'departement_delete',
            'subdepartement_create',
            'subdepartement_edit',
            'subdepartement_show', //sudah
            'subdepartement_delete',
            'pegawai_create',
            'pegawai_edit',
            'pegawai_show', //sudah
            'pegawai_delete',
            // Management Device
            'ManagementDevice_access', //sudah

            'location_create',
            'location_edit',
            'location_show', //sudah
            'location_delete',
            'attandanceDevice_create',
            'attandanceDevice_edit',
            'attandanceDevice_show',//sudah
            'attandanceDevice_delete',
            'doorlockDevice_create',
            'doorlockDevice_edit',
            'doorlockDevice_show',//sudah
            'doorlockDevice_delete',
            'remark_create',
            'remark_edit',
            'remark_show',//sudah
            'remark_delete',

            // Management Attandance
            'ManagementAttendance_access', //sudah

            'workingTime_create',
            'workingTime_edit',
            'workingTime_show',
            'workingTime_delete',
            'LeaveAndAbsence_create',
            'LeaveAndAbsence_edit',
            'LeaveAndAbsence_show',
            'LeaveAndAbsence_delete',

            // Payroll System
            'Payroll_access', //sudah

            'weeklyPayroll_access', //sudah
            'MonthlyPayroll_access', //sudah
            
            // Report
            'report_access', //sudah
            'DeviceHistoryReport_access', //sudah
            'AbsenceReport_access', //sudah
            'DoorlockReport_access', //sudah
        ];

        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        };

        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($permissions);

    }
}
