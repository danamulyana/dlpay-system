<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Dana mulyana',
                'username' => 'danamulyana',
                'email' => 'danabontot@gmail.com',
                'password' => '$2y$10$tK8g.RatqIUpZiqTmbbgge7fRtuv2aibT0GfoYBycBdRAels9E/ta', //12345678
            ]
        ]);
    }
}
