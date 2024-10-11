<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'record_status' => $this->record_status,
            'record_status_text' => $this->record_status->label(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
