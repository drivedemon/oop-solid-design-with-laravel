<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class LayoutFactory extends Factory
{
    public function definition(): array
    {
        return [
            'is_default' => true,
            'name' => fake()->name,
            'pcm_group_uuid' => Group::factory()->create()->uuid,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
