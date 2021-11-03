<?php

namespace Database\Seeders;

use App\Models\memployee;
use Illuminate\Database\Seeder;

class karyawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        memployee::factory(30)->create();
    }
}
