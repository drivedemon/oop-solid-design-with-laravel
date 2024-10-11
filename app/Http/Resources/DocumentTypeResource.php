<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->hashid,
            'type' => $this->type,
            'type_text' => $this->type->label(),
            'is_active' => $this->is_active,
        ];
    }
}
