<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('files.upload');
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'financial_year' => ['required', 'string', 'size:9', 'regex:/^\d{4}-\d{4}$/'],
        ];
    }
}