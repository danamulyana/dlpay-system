<?php

namespace Database\Seeders;

use App\Models\Golongan;
use App\Models\memployee;
use Database\Factories\karyawanFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(departementSeeder::class);
        $this->call(subdepartementSeeder::class);
        $this->call(bankdataSeeder::class);
        $this->call(LocationSeeder::class);
        // $this->call(AbsenceSeeder::class);
        $this->call(prisetSeeder::class);
        memployee::factory(20)->create();
        $this->call([GolonganSeeder::class]);
    }
}
