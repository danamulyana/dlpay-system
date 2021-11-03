<?php

namespace Database\Seeders;

use App\Models\msubdepartement;
use Illuminate\Database\Seeder;

class subdepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        msubdepartement::insert(
        [
            [
                'nama' => 'Warehouse 1',
                'departement_id' => 5,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'Warehouse 2',
                'departement_id' => 5,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'Produksi 1',
                'departement_id' => 1,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'Produksi 2',
                'departement_id' => 1,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'HRD 1',
                'departement_id' => 2,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'HRD 2',
                'departement_id' => 2,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'QA 1',
                'departement_id' => 3,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'QA 2',
                'departement_id' => 3,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'Accounting 1',
                'departement_id' => 4,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'Accounting 2',
                'departement_id' => 4,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'IT 1',
                'departement_id' => 6,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
            [
                'nama' => 'IT 2',
                'departement_id' => 6,
                'createdBy' => 'admin',
                'updatedBy' => 'admin',
            ],
        ]);
    }
}
