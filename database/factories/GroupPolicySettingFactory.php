<?php

namespace Database\Factories;

use App\Enums\GroupPolicySetting\AccessMode;
use App\Enums\GroupPolicySetting\ClaimManagementType;
use App\Enums\RecordStatus;
use App\Models\Group;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupPolicySettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pcm_group_uuid' => Group::factory()->create()->uuid,
            'pcm_policy_uuid' => Policy::factory()->create()->uuid,
            'access_mode' => AccessMode::WRITE,
            'policy_name' => 'John Doe Policy',
            'policy_number' => fake()->numerify('########'),
            'insurer_name' => 'John Doe',
            'proposer_name' => fake()->word(),
            'claim_management_type' => fake()->randomElement(ClaimManagementType::cases())->value,
            'claim_buffer_day' => 0,
            'effective_date' => now()->startOfYear(),
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
