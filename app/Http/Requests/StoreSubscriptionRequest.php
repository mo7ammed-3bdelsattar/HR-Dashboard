<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,expired,cancelled,past_due,trial',
            'billing_cycle' => 'required|in:monthly,yearly,custom',
            'price_paid' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:3',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
            'trial_ends_at' => 'nullable|date',
            'max_employees_override' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
