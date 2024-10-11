<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pcm_group_uuid' => Group::factory()->create()->uuid,
            'pcm_user_uuid' => User::factory()->create()->uuid,
            'pcm_user_group_uuid' => UserGroup::factory()->create()->uuid,
            'census_uuid' => Str::uuid()->toString(),
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
