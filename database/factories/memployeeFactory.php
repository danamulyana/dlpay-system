<?php

namespace Database\Factories;

use App\Models\memployee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as faker;

class memployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = memployee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nip' => $this->faker->nik(),
            'rfid_number' => $this->faker->unique()->randomNumber(5, true),
            'attendance_type' => implode(" ",$this->faker->randomElements([1,2])),
            'nama' => $this->faker->name(),
            'job_title' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'noHandphone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->safeEmail(),
            'departement_id' => implode('',$this->faker->randomElements([1,2,3,4,5,6])),
            'subdepartement_id' => implode('',$this->faker->randomElements([1,2,3,4,5,6])),
            'payment_mode' => implode('',$this->faker->randomElements(['weekly','monthly'])),
            'basic_salary' => $this->faker->randomNumber(7, true),
            'transfer_type' => implode('',$this->faker->randomElements([1,2])),
            'bank_name' => $this->faker->name(),
            'bank_account' => $this->faker->randomNumber(1, true),
            'credited_accont' => $this->faker->creditCardNumber(),
            'createdBy' => 'admin',
            'updatedBy' => 'admin',
        ];
    }
}
