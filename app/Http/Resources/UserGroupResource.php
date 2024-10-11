<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserGroupResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'is_custom' => $this->is_custom,
            'name' => $this->name,
            'factor_1' => $this->factor_1,
            'factor_2' => $this->factor_2,
            'factor_3' => $this->factor_3,
            'factor_4' => $this->factor_4,
            'factor_1_column_name' => $this->factor_1_column_name,
            'factor_2_column_name' => $this->factor_2_column_name,
            'factor_3_column_name' => $this->factor_3_column_name,
            'factor_4_column_name' => $this->factor_4_column_name,
            'logo_path' => $this->logo_path,
            'color' => $this->color,
        ];

        return $response + $base;
    }
}
