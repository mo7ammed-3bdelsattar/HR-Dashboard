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
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after_or_equal:starts_at',
            'notes' => 'nullable|string',
        ];
    }
}
