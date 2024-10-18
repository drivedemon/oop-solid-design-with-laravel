<?php

namespace Database\Factories;

use App\Enums\Policy\PolicyType;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolicyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'policy_id' => fake()->numerify('########'),
            'client_no' => null,
            'policy_type' => fake()->randomElement(PolicyType::cases())->value,
            'proposer' => fake()->word(),
            'region' => 'TH',
            'policy_number' => fake()->numerify('########'),
            'insurance_company' => 'John Doe Company',
            'renewal_responsibility' => null,
            'start_date' => now()->startOfYear(),
            'policy_end_date' => now()->endOfYear(),
            'service_office' => 'Thailand',
            'medical_responsibility' => null,
            'medical_currency' => null,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
