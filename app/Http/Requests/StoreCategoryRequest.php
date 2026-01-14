<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('categories.manage');
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('retention_days') && $this->retention_days !== null && $this->retention_days !== '') {
            $this->merge([
                'retention_days' => (int) $this->retention_days,
            ]);
        } elseif ($this->has('retention_days') && ($this->retention_days === null || $this->retention_days === '')) {
            $this->merge([
                'retention_days' => null,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
            'retention_days' => ['nullable', 'integer', 'min:0', 'max:3650'],
        ];
    }
}