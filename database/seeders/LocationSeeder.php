<?php

namespace Database\Seeders;

use App\Models\dataLocation;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dataLocation::insert([
            [
                'name' => 'Kantin',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'name' => 'Office',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'name' => 'Gerbang',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'name' => 'Pos Satpam',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'name' => 'Ruang Pruduksi',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
        ]);
    }
}
