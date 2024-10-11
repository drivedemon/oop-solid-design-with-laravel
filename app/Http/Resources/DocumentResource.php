<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class DocumentResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'file_name' => $this->file_name,
            'file_path' => $this->file_path,
            'sequential' => $this->sequential,
            'expiry_date' => $this->expiry_date,
            'document_type' => new DocumentTypeResource($this->whenLoaded('documentType')),
            'group_policy_setting' => new GroupPolicySettingResource($this->whenLoaded('groupPolicySetting')),
            'user' => new UserResource($this->whenLoaded('user')),
            'user_group' => new UserGroupResource($this->whenLoaded('userGroup')),
        ];

        return $response + $base;
    }
}
