<?php

namespace Database\Factories;

use App\Enums\RecordStatus;
use App\Models\DocumentType;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDocumentFactory extends Factory
{
    private static $order = 1;

    public function definition(): array
    {
        return [
            'pcm_user_uuid' => User::factory()->create()->uuid,
            'file_name' => 'test_mockup_user_document_from_laravel.jpg',
            'file_path' => 'path/to/file',
            'sequential' => self::$order++,
            'expiry_date' => null,
            'pcm_document_type_uuid' => DocumentType::factory()->create()->uuid,
            'pcm_group_uuid' => Group::factory()->create()->uuid,
            'record_status' => RecordStatus::NORMAL,
        ];
    }
}
