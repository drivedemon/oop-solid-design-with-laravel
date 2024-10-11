<?php

namespace App\Http\Requests;

use App\Enums\User\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->user();

        return [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'email' => ['nullable', 'string', Rule::unique('pcm_user', 'email')->ignore($user->uuid, 'uuid')],
            'dob' => ['nullable', 'string'],
            'gender' => ['nullable', 'string', new Enum(Gender::class)],
            'mobile_number' => ['nullable', 'integer'],
        ];
    }
}
