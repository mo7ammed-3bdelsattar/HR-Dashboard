<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'subdomain' => [
                'required',
                'string',
                'max:100',
                Rule::unique('companies')->ignore($this->company),
            ],
            'domain' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('companies')->ignore($this->company),
            ],
            'email' => 'nullable|email|max:255',
            'phone1' => 'nullable|string|max:30',
            'phone2' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:active,suspended,cancelled,trial',
            'trial_ends_at' => 'nullable|date',
            'timezone' => 'required|string|max:100',
        ];
    }
}
