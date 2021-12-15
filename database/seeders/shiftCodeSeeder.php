<?php

namespace Database\Seeders;

use App\Models\workingTime;
use Illuminate\Database\Seeder;

class shiftCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        workingTime::insert([
            [
                'shift_name' => 'Testing',
                'jam_masuk' => now(),
                'jam_keluar' => now(),
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ]
        ]);
    }
}
