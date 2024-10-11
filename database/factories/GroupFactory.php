<?php

namespace Database\Factories;

use App\Enums\Group\GroupType;
use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pcp_group_uuid' => Str::uuid()->toString(),
            'pcm_group_name' => 'TH_GROUP_TEAM',
            'responsibility_uuid' => Str::uuid()->toString(),
            'secondary_responsibility' => '',
            'group_type' => fake()->randomElement(GroupType::cases())->value,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
