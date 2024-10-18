<?php

namespace App\Http\Requests;

use App\Enums\DocumentType\DocumentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_type' => ['nullable', 'string', new Enum(DocumentType::class)],
        ];
    }
}
