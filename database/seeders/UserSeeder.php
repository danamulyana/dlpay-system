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
        $user = new User();
        $user->name = 'Dana mulyana';
        $user->username = 'danamulyana';
        $user->email = 'danabontot@gmail.com';
        $user->password = '$2y$10$tK8g.RatqIUpZiqTmbbgge7fRtuv2aibT0GfoYBycBdRAels9E/ta'; //12345678
        $user->save();
        $user->assignRole('Admin');
    }
}
