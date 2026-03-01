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
                            <select id="company_id" name="company_id" class="form-select" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $subscription->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="plan_id">{{ __('Plan') }}</label>
                            <select id="plan_id" name="plan_id" class="form-select" required>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ $subscription->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="status">{{ __('Status') }}</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="trial" {{ $subscription->status == 'trial' ? 'selected' : '' }}>Trial
                                </option>
                                <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired
                                </option>
                                <option value="cancelled" {{ $subscription->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="billing_cycle">{{ __('Billing Cycle') }}</label>
                            <select id="billing_cycle" name="billing_cycle" class="form-select" required>
                                <option value="monthly" {{ $subscription->billing_cycle == 'monthly' ? 'selected' : '' }}>
                                    Monthly</option>
                                <option value="yearly" {{ $subscription->billing_cycle == 'yearly' ? 'selected' : '' }}>
                                    Yearly</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="price_paid">{{ __('Price Paid') }}</label>
                            <input type="number" step="0.01" id="price_paid" name="price_paid" class="form-control"
                                value="{{ $subscription->price_paid }}" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="starts_at">{{ __('Starts At') }}</label>
                            <input type="date" id="starts_at" name="starts_at" class="form-control"
                                value="{{ $subscription->starts_at ? $subscription->starts_at->format('Y-m-d') : '' }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="ends_at">{{ __('Ends At') }}</label>
                            <input type="date" id="ends_at" name="ends_at" class="form-control"
                                value="{{ $subscription->ends_at ? $subscription->ends_at->format('Y-m-d') : '' }}" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="notes">{{ __('Notes') }}</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3">{{ old('notes', $subscription->notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Update Subscription') }}</button>
                    <a href="{{ route('subscriptions.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
