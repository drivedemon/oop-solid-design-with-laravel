<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class GroupPolicySettingResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'access_mode' => $this->access_mode,
            'access_mode_text' => $this->access_mode->label(),
            'policy_name' => $this->policy_name,
            'policy_number' => $this->policy_number,
            'insurer_name' => $this->insurer_name,
            'proposer_name' => $this->proposer_name,
            'claim_management_type' => $this->claim_management_type,
            'claim_management_type_text' => $this->claim_management_type->label(),
            'claim_management_type_description' => $this->claim_management_type->description(),
            'claim_buffer_day' => $this->claim_buffer_day,
            'effective_date' => $this->effective_date,
        ];

        return $response + $base;
    }
}
