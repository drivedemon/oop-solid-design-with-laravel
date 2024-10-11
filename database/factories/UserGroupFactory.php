<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\Group;
use App\Models\Layout;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserGroupFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pcm_group_uuid' => Group::factory()->create()->uuid,
            'pcm_layout_uuid' => Layout::factory()->create()->uuid,
            'is_custom' => false,
            'name' => fake()->name,
            'factor_1' => 'TH_TEAM',
            'factor_2' => 'TECH',
            'factor_3' => null,
            'factor_4' => null,
            'factor_1_column_name' => 'group_code',
            'factor_2_column_name' => 'plan',
            'factor_3_column_name' => null,
            'factor_4_column_name' => null,
            'logo_path' => null,
            'color' => null,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
