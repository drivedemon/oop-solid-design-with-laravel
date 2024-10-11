<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class LayoutResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'is_default' => $this->is_default,
            'name' => $this->name,
            'layout_modules' => LayoutModuleResource::collection($this->whenLoaded('layoutModules')),
        ];

        return $response + $base;
    }
}
