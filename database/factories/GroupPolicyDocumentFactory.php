<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\DocumentType;
use App\Models\GroupPolicySetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupPolicyDocumentFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {
        return [
            'pcm_group_policy_setting_uuid' => GroupPolicySetting::factory()->create()->uuid,
            'file_name' => 'test_mockup_group_policy_document_from_laravel.jpg',
            'file_path' => 'path/to/file',
            'sequential' => self::$order++,
            'expiry_date' => null,
            'pcm_document_type_uuid' => DocumentType::factory()->create()->uuid,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
