@extends('layouts.master')

@section('title', __('Subscription Details'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{ __('Management') }} / {{ __('Subscriptions') }} /</span> {{ __('Details') }}
        </h4>

        <div class="row">
            <!-- Main Details -->
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Subscription Overview') }}</h5>
                        <span
                            class="badge bg-label-primary">{{ $subscription->subscription_id ?? '#' . $subscription->id }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <small class="text-uppercase text-muted">{{ __('Current Plan') }}</small>
                                <h5 class="mb-0">{{ $subscription->plan->name }}</h5>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <small class="text-uppercase text-muted">{{ __('Billing Cycle') }}</small>
                                <h5 class="mb-0 text-primary">{{ ucfirst($subscription->billing_cycle) }}</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <small class="text-uppercase text-muted">{{ __('Status') }}</small>
                                <div>
                                    @php
                                        $statusClass =
                                            [
                                                'active' => 'bg-label-success',
                                                'expired' => 'bg-label-danger',
                                                'cancelled' => 'bg-label-warning',
                                                'trial' => 'bg-label-info',
                                            ][$subscription->status] ?? 'bg-label-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ ucfirst($subscription->status) }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <small class="text-uppercase text-muted">{{ __('Amount Paid') }}</small>
                                <h5 class="mb-0">{{ $subscription->price_paid }} {{ $subscription->currency }}</h5>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <p class="mb-1 fw-bold">{{ __('Effective Dates') }}</p>
                                <p class="mb-0 text-muted">{{ __('Started:') }}
                                    {{ $subscription->starts_at ? $subscription->starts_at->format('M d, Y') : '-' }}</p>
                                <p class="mb-0 text-muted">{{ __('Expires:') }}
                                    {{ $subscription->ends_at ? $subscription->ends_at->format('M d, Y') : '-' }}</p>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <p class="mb-1 fw-bold">{{ __('Created By') }}</p>
                                <p class="mb-0 text-muted">{{ $subscription->creator->name ?? __('System') }}</p>
                                <small class="text-muted">{{ $subscription->created_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>

                        @if ($subscription->notes)
                            <hr class="my-4">
                            <div class="mb-0">
                                <p class="mb-1 fw-bold">{{ __('Notes') }}</p>
                                <p class="text-muted">{{ $subscription->notes }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer border-top text-center py-3">
                        <a href="{{ route('subscriptions.edit', $subscription->id) }}"
                            class="btn btn-primary me-2">{{ __('Edit Subscription') }}</a>
                        <a href="{{ route('subscriptions.index') }}"
                            class="btn btn-outline-secondary">{{ __('Back to List') }}</a>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar Area -->
            <div class="col-xl-4 col-lg-5 col-md-12">
                <!-- Company Mini Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ __('Company Information') }}</h5>
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <div class="avatar avatar-md me-3">
                                @if ($subscription->company->logo)
                                    <img src="{{ asset('storage/' . $subscription->company->logo) }}" alt="logo"
                                        class="rounded">
                                @else
                                    <span
                                        class="avatar-initial rounded bg-label-secondary">{{ substr($subscription->company->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{ route('companies.show', $subscription->company_id) }}"
                                    class="text-body text-truncate fw-bold">{{ $subscription->company->name }}</a>
                                <small class="text-muted">{{ $subscription->company->subdomain }}</small>
                            </div>
                        </div>

                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Email:') }}</span>
                                    <span>{{ $subscription->company->email ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Phone:') }}</span>
                                    <span>{{ $subscription->company->phone1 ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Address:') }}</span>
                                    <span>{{ $subscription->company->address ?? '-' }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Status:') }}</span>
                                    <span class="badge bg-label-info">{{ ucfirst($subscription->company->status) }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Employees:') }}</span>
                                    <span>{{ 1 }}</span>
                                </li>
                                @if ($subscription->company->user)
                                    <hr class="my-4">
                                    <li class="mb-0">
                                        <p class="mb-2 fw-bold">{{ __('Company Admin') }}</p>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar-wrapper me-2">
                                                <div class="avatar avatar-sm">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-primary">{{ substr($subscription->company->user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="fw-semibold text-body">{{ $subscription->company->user->name }}</span>
                                                <small class="text-muted">{{ $subscription->company->user->email }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Features Summary -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ __('Included Features') }}</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach ($subscription->plan->features as $feature)
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bx bx-check-circle me-3 text-primary"></i>
                                    <div>
                                        <h6 class="mb-0">{{ $feature->label }}</h6>
                                        <small class="text-muted">{{ $feature->feature_value }}</small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
