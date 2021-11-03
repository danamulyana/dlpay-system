<?php

namespace Database\Seeders;

use App\Models\leaveAndAbsence;
use Illuminate\Database\Seeder;

class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        leaveAndAbsence::insert([
            [
                'category' => 'payroll deductions',
                'remark' => 'pemotongan',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'category' => 'salary increase',
                'remark' => 'penambahan',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
        ]);
    }
}
