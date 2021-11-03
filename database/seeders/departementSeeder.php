<?php

namespace Database\Seeders;

use App\Models\mdepartement;
use Illuminate\Database\Seeder;

class departementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mdepartement::insert([
            [
                'nama' => 'Produksi',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'nama' => 'HRD',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'nama' => 'QA',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'nama' => 'Accounting',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'nama' => 'Warehouse',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
            [
                'nama' => 'IT',
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
                'updated_at' => now(), 
                'created_at' => now(), 
            ],
        ]);
    }
}
