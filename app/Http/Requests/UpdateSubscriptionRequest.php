<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'nullable|exists:companies,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,expired,cancelled,past_due,trial',
            'billing_cycle' => 'required|in:monthly,yearly,custom',
            'price_paid' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'starts_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
