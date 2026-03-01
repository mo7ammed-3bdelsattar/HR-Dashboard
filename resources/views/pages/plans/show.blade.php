@extends('layouts.master')

@section('title', __('Plan Details') . ' - ' . $plan->name)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{ __('Management') }} / {{ __('Plans') }} /</span> {{ __('Details') }}
        </h4>

        <div class="row">
            <!-- Plan Overview -->
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="badge bg-label-primary rounded p-2 mb-2">
                                <i class="bx bx-package bx-md"></i>
                            </div>
                            <h4 class="mb-1">{{ $plan->name }}</h4>
                            <p class="text-muted">{{ $plan->slug }}</p>
                        </div>

                        <div class="d-flex justify-content-center mb-4">
                            <div class="d-flex align-items-start">
                                <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">{{ $plan->currency }}</sup>
                                <h1 class="display-3 fw-bold mb-0 text-primary">{{ $plan->price_monthly }}</h1>
                                <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/{{ __('mo') }}</sub>
                            </div>
                        </div>

                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bx bx-check-circle me-2 text-primary"></i>
                                <span>{{ __('Yearly Price:') }} <strong>{{ $plan->price_yearly }}
                                        {{ $plan->currency }}</strong></span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bx bx-check-circle me-2 text-primary"></i>
                                <span>{{ __('Max Employees:') }}
                                    <strong>{{ $plan->max_employees ?? __('Unlimited') }}</strong></span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="bx bx-check-circle me-2 text-primary"></i>
                                <span>{{ __('Duration:') }} <strong>{{ $plan->duration_days }}
                                        {{ __('days') }}</strong></span>
                            </li>
                        </ul>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('plans.edit', $plan->id) }}"
                                class="btn btn-primary">{{ __('Edit Plan') }}</a>
                            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-label-danger">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan Features & Subscriptions -->
            <div class="col-xl-8 col-lg-7 col-md-7">
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Description') }}</h5>
                    <div class="card-body">
                        <p>{{ $plan->description ?? __('No description provided.') }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Plan Features') }}</h5>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addFeatureModal">{{ __('Add Feature') }}</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-top">
                            <thead>
                                <tr>
                                    <th>{{ __('Feature Key') }}</th>
                                    <th>{{ __('Value') }}</th>
                                    <th>{{ __('Label') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plan->features as $feature)
                                    <tr>
                                        <td><code>{{ $feature->feature_key }}</code></td>
                                        <td>{{ $feature->feature_value }}</td>
                                        <td>{{ $feature->label }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">{{ __('No features added yet.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
