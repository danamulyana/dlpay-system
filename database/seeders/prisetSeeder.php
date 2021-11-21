<?php

namespace Database\Seeders;

use App\Models\mpriset;
use Illuminate\Database\Seeder;

class prisetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mpriset::insert([
            [
                'name' => 'ke kantin',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'name' => 'ngambil biji plastik',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'name' => 'ngemil',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'name' => 'testing',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
        ]);
    }
}
