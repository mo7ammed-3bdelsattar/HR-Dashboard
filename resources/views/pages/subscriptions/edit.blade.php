@extends('layouts.master')

@section('title', __('Edit Subscription'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Subscriptions') }} /</span> {{ __('Edit') }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Edit Subscription Details') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="company_id">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id"
                                class="form-select @error('company_id') is-invalid @enderror" disabled>
                                <option value="{{ $subscription->company->id }}">{{ $subscription->company->name }}</option>
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{ __('Status') }}</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="trial" {{ $subscription->status == 'trial' ? 'selected' : '' }}>Trial
                                </option>
                                <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired
                                </option>
                                <option value="cancelled" {{ $subscription->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="plan_id">{{ __('Plan') }}</label>
                            <select id="plan_id" name="plan_id"
                                class="form-select @error('plan_id') is-invalid @enderror">
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ $subscription->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="billing_cycle">{{ __('Billing Cycle') }}</label>
                            <select id="billing_cycle" name="billing_cycle"
                                class="form-select @error('billing_cycle') is-invalid @enderror">
                                <option value="monthly" {{ $subscription->billing_cycle == 'monthly' ? 'selected' : '' }}>
                                    Monthly</option>
                                <option value="yearly" {{ $subscription->billing_cycle == 'yearly' ? 'selected' : '' }}>
                                    Yearly</option>
                            </select>
                            @error('billing_cycle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="price_paid">{{ __('Price Paid') }}</label>
                            <input type="number" step="0.01" id="price_paid" name="price_paid"
                                class="form-control @error('price_paid') is-invalid @enderror"
                                value="{{ old('price_paid', $subscription->price_paid) }}" />
                            @error('price_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <input type="text" id="currency" name="currency"
                                class="form-control @error('currency') is-invalid @enderror"
                                value="{{ old('currency', $subscription->currency) }}" />
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="starts_at">{{ __('Starts At') }}</label>
                            <input type="date" id="starts_at" name="starts_at"
                                class="form-control @error('starts_at') is-invalid @enderror"
                                value="{{ old('starts_at', $subscription->starts_at ? $subscription->starts_at->format('Y-m-d') : '') }}" />
                            @error('starts_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="ends_at">{{ __('Ends At') }}</label>
                            <input type="date" id="ends_at" name="ends_at"
                                class="form-control @error('ends_at') is-invalid @enderror"
                                value="{{ old('ends_at', $subscription->ends_at ? $subscription->ends_at->format('Y-m-d') : '') }}" />
                            @error('ends_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="notes">{{ __('Notes') }}</label>
                        <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes', $subscription->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Update Subscription') }}</button>
                    <a href="{{ route('subscriptions.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startsAtInput = document.getElementById('starts_at');
        const endsAtInput = document.getElementById('ends_at');
        const billingCycleSelect = document.getElementById('billing_cycle');

        function calculateEndDate() {
            if (!startsAtInput.value) return;
            
            const startDate = new Date(startsAtInput.value);
            if (isNaN(startDate.getTime())) return;
            
            const cycle = billingCycleSelect.value;
            const endDate = new Date(startDate);
            
            if (cycle === 'monthly') {
                endDate.setMonth(endDate.getMonth() + 1);
            } else if (cycle === 'yearly') {
                endDate.setFullYear(endDate.getFullYear() + 1);
            } else {
                return;
            }
            
            const year = endDate.getFullYear();
            const month = String(endDate.getMonth() + 1).padStart(2, '0');
            const day = String(endDate.getDate()).padStart(2, '0');
            
            endsAtInput.value = `${year}-${month}-${day}`;
        }

        startsAtInput.addEventListener('change', calculateEndDate);
        billingCycleSelect.addEventListener('change', calculateEndDate);
    });
</script>
@endpush
