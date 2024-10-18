<?php

namespace Database\Factories;

use App\Enums\DocumentType\ActiveStatus;
use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(DocumentType::cases())->value,
            'is_active' => ActiveStatus::ACTIVE,
        ];
    }
}
