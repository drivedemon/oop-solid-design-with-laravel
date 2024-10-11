<?php

namespace Database\Factories;

use App\Enums\LayoutModule\ModuleName;
use App\Enums\RecordStatus;
use App\Models\Layout;
use Illuminate\Database\Eloquent\Factories\Factory;

class LayoutModuleFactory extends Factory
{
    public function definition(): array
    {
        $selectedModule = array_rand(ModuleName::cases());

        return [
            'module_name' => ModuleName::cases()[$selectedModule]->value,
            'display_name' => ModuleName::cases()[$selectedModule]->label(),
            'sequential' => ModuleName::cases()[$selectedModule]->sequential(),
            'pcm_layout_uuid' => Layout::factory()->create()->uuid,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
