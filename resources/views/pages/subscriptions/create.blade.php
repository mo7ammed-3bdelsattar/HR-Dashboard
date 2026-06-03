@extends('layouts.master')

@section('title', __('New Subscription'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Subscriptions') }} /</span> {{ __('Create') }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Subscription Details') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="company_id">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id"
                                class="form-select @error('company_id') is-invalid @enderror" >
                                <option value="">{{ __('Select Company') }}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{ __('Status') }}</label>
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror"
                                >
                                <option value="trial" selected>Trial</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="plan_id">{{ __('Plan') }}</label>
                            <select id="plan_id" name="plan_id" class="form-select @error('plan_id') is-invalid @enderror">
                                <option value="">{{ __('Select Plan') }}</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ old('plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}
                                        ({{ $plan->price_monthly }} / month) ({{ $plan->price_yearly }} / year)
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
                                class="form-select @error('billing_cycle') is-invalid @enderror" >
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                            @error('billing_cycle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="starts_at">{{ __('Starts At') }}</label>
                            <input type="date" id="starts_at" name="starts_at"
                                class="form-control @error('starts_at') is-invalid @enderror"
                                value="{{ old('starts_at', date('Y-m-d')) }}" />
                            @error('starts_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="ends_at">{{ __('Ends At') }}</label>
                            <input type="date" id="ends_at" name="ends_at"
                                class="form-control @error('ends_at') is-invalid @enderror"
                                value="{{ old('ends_at') }}" />
                            @error('ends_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="price_paid">{{ __('Price Paid') }}</label>
                            <input type="number" step="0.01" id="price_paid" name="price_paid"
                                class="form-control @error('price_paid') is-invalid @enderror"
                                value="{{ old('price_paid', 0) }}"  />
                            @error('price_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <input type="text" id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror" value="{{ old('currency', 'USD') }}" />
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="notes">{{ __('Notes') }}</label>
                        <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Save Subscription') }}</button>
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
        
        if(!endsAtInput.value) {
            calculateEndDate();
        }
    });
</script>
@endpush
