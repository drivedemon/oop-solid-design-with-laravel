<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\DocumentType;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserGroupDocumentFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {
        return [
            'pcm_user_group_uuid' => UserGroup::factory()->create()->uuid,
            'file_name' => 'test_mockup_user_group_document_from_laravel.jpg',
            'file_path' => 'path/to/file',
            'sequential' => self::$order++,
            'expiry_date' => null,
            'pcm_document_type_uuid' => DocumentType::factory()->create()->uuid,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
