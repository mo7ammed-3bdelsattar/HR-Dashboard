@extends('layouts.master')
@section('title', __('Company Details') . ' - ' . $company->name)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{ __('Management') }} / {{ __('Companies') }} /</span> {{ __('Details') }}
        </h4>

        <div class="row">
            <!-- Company Information -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                @if ($company->logo)
                                    <img class="img-fluid rounded my-4" src="{{ asset('storage/' . $company->logo) }}"
                                        height="110" width="110" alt="Company Logo" />
                                @else
                                    <div class="avatar avatar-xl my-4">
                                        <span
                                            class="avatar-initial rounded bg-label-primary">{{ substr($company->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ $company->name }}</h4>
                                    <span class="badge bg-label-secondary">{{ ucfirst($company->status) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-user bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">1</h5>
                                    <span>{{ __('Employees') }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">{{ $company->subscriptions()->where('status', 'active')->count() }}
                                    </h5>
                                    <span>{{ __('Active Subs') }}</span>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4">{{ __('Details') }}</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Subdomain:') }}</span>
                                    <span>{{ $company->subdomain }}.{{ config('app.domain') }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Email:') }}</span>
                                    <span>{{ $company->email ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Plan:') }}</span>
                                    <span>{{ $company->currentSubscription->plan->name ?? __('No Active Plan') }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Phone 1:') }}</span>
                                    <span>{{ $company->phone1 ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Phone 2:') }}</span>
                                    <span>{{ $company->phone2 ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Address:') }}</span>
                                    <span>{{ $company->address ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Timezone:') }}</span>
                                    <span>{{ $company->timezone }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="btn btn-primary me-3">{{ __('Edit') }}</a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-label-danger suspend-user">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Subscriptions & Users -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- Subscriptions Tab -->
                <div class="card mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header">{{ __('Subscription History') }}</h5>
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#addSubscriptionModal">
                            {{ __('Add Subscription') }}
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Billing') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Ends At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company->subscriptions as $sub)
                                    <tr>
                                        <td><strong>{{ $sub->plan->name }}</strong></td>
                                        <td>{{ $sub->price_paid }} {{ $sub->currency }}</td>
                                        <td>{{ ucfirst($sub->billing_cycle) }}</td>
                                        <td><span class="badge bg-label-info">{{ ucfirst($sub->status) }}</span></td>
                                        <td>{{ $sub->ends_at ? $sub->ends_at->format('Y-m-d') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Users Tab -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Company Admin') }}</h5>
                    <div class="table-responsive">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar-wrapper me-2">
                                                <div class="avatar avatar-sm">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-primary">{{ substr($company->user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold text-body">{{ $company->user->name }}</span>
                                                <small class="text-muted">{{ $company->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ ucfirst($company->user->role) }}</td>
                                    <td><span
                                            class="badge {{ $company->user->is_active ? 'bg-label-success' : 'bg-label-secondary' }}">{{ $company->user->is_active ? __('Active') : __('Inactive') }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Add Subscription Modal -->
    <div class="modal fade" id="addSubscriptionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="address-title">{{ __('Add New Subscription') }}</h3>
                        <p class="address-subtitle">{{ __('Setup a new subscription for') }} {{ $company->name }}</p>
                    </div>
                    <form action="{{ route('subscriptions.store') }}" method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company->id }}">

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="plan_id">{{ __('Plan') }}</label>
                            <select id="plan_id" name="plan_id"
                                class="form-select @error('plan_id') is-invalid @enderror" required>
                                <option value="">{{ __('Select Plan') }}</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }} ({{ $plan->price_monthly }} / month)
                                        ({{ $plan->price_yearly }} / year)
                                    </option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="status">{{ __('Status') }}</label>
                            <select id="status" name="status"
                                class="form-select @error('status') is-invalid @enderror" required>
                                <option value="trial" selected>{{ __('Trial') }}</option>
                                <option value="active">{{ __('Active') }}</option>
                                <option value="expired">{{ __('Expired') }}</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="billing_cycle">{{ __('Billing Cycle') }}</label>
                            <select id="billing_cycle" name="billing_cycle"
                                class="form-select @error('billing_cycle') is-invalid @enderror" required>
                                <option value="monthly">{{ __('Monthly') }}</option>
                                <option value="yearly">{{ __('Yearly') }}</option>
                            </select>
                            @error('billing_cycle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="starts_at">{{ __('Starts At') }}</label>
                            <input type="date" id="starts_at" name="starts_at"
                                class="form-control @error('starts_at') is-invalid @enderror"
                                value="{{ old('starts_at', date('Y-m-d')) }}" required />
                            @error('starts_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="price_paid">{{ __('Price Paid') }}</label>
                            <input type="number" step="0.01" id="price_paid" name="price_paid"
                                class="form-control @error('price_paid') is-invalid @enderror"
                                value="{{ old('price_paid', 0) }}" required />
                            @error('price_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <input type="text" id="currency" name="currency"
                                class="form-control @error('currency') is-invalid @enderror"
                                value="{{ old('currency', 'USD') }}" required />
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="notes">{{ __('Notes') }}</label>
                            <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('Submit') }}</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">{{ __('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
