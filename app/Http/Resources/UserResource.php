<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $base = parent::toArray($request);

        $response = [
            'id' => $this->hashid,
            'login_buffer_day' => $this->login_buffer_day,
            'login_username' => $this->login_username,
            'email' => $this->email,
            'billing_address' => $this->billing_address,
            'phone_number' => $this->phone_number,
            'account_status' => $this->account_status,
            'account_status_text' => $this->account_status->label(),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'dob' => $this->dob,
            'gender' => $this->gender->label(),
            'role' => $this->role,
        ];

        return $response + $base;
    }
}
