<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('clients.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'kra_pin' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,dormant,archived'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_address' => ['nullable', 'string'],
            'company_website' => ['nullable', 'url', 'max:255'],
            'company_registration_number' => ['nullable', 'string', 'max:255'],
            'contact_name' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_position' => ['nullable', 'string', 'max:255'],
        ];
    }
}