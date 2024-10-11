<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class LayoutModuleResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'module_name' => $this->module_name,
            'display_name' => $this->display_name,
            'sequential' => $this->sequential,
        ];

        return $response + $base;
    }
}
