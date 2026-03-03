<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'nullable|email|max:255',
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:100|unique:companies',
            'domain' => 'nullable|string|max:255|unique:companies',
            'email' => 'required|email|max:255',
            'phone1' => 'required|string|max:30',
            'phone2' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:active,suspended,cancelled,trial',
            'timezone' => 'required|string|max:100',
        ];
    }
}
