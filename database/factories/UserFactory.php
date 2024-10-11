<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Enums\User\Gender;
use App\Enums\User\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'census_uuid' => Str::uuid()->toString(),
            'login_buffer_day' => null,
            'login_username' => fake()->userName,
            'login_password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email' => fake()->unique()->safeEmail,
            'billing_address' => fake()->address,
            'phone_number' => fake()->numerify('+66########'),
            'account_status' => 1,
            'last_name' => fake()->lastName,
            'first_name' => fake()->firstName,
            'dob' => '1900-01-01',
            'gender' => fake()->randomElement(Gender::cases())->value,
            'role' => Role::USER,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
