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

            'departement_create', //sudah
            'departement_edit', //sudah
            'departement_show', //sudah
            'departement_delete', //sudah
            'subdepartement_create', //sudah
            'subdepartement_edit', //sudah
            'subdepartement_show', //sudah
            'subdepartement_delete', //sudah
            'pegawai_create', //sudah
            'pegawai_edit', //sudah
            'pegawai_show', //sudah
            'pegawai_delete', //sudah
            // Management Device
            'ManagementDevice_access', //sudah

            'location_create', //sudah
            'location_edit', //sudah
            'location_show', //sudah
            'location_delete', //sudah
            'attandanceDevice_create', //sudah
            'attandanceDevice_edit', //sudah
            'attandanceDevice_show',//sudah
            'attandanceDevice_delete', //sudah
            'doorlockDevice_create', //sudah
            'doorlockDevice_edit', //sudah
            'doorlockDevice_show',//sudah
            'doorlockDevice_delete', //sudah
            'remark_create', //sudah
            'remark_edit', //sudah
            'remark_show',//sudah
            'remark_delete', //sudah

            // Management Attandance
            'ManagementAttendance_access', //sudah

            'workingTime_create', //sudah
            'workingTime_edit', //sudah
            'workingTime_show',
            'workingTime_delete', //sudah
            'LeaveAndAbsence_create', //sudah
            'LeaveAndAbsence_edit',//sudah
            'LeaveAndAbsence_show',
            'LeaveAndAbsence_delete', //sudah

            // Management Schadule
            'schadule_show',
            'schadule_create', //sudah
            'schadule_edit', //sudah
            'schadule_delete', //sudah

            // Payroll System
            'Payroll_access', //sudah

            'weeklyPayroll_access', //sudah
            'MonthlyPayroll_access', //sudah
            'PayrollApproval_access', //sudah
            
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
