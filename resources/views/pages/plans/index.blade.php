@extends('layouts.master')

@section('title', __('Plans'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">{{ __('Management') }} /</span>
                {{ __('Plans') }}</h4>
            <a href="{{ route('plans.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; {{ __('Add Plan') }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-none border @if ($plan->is_featured) border-primary @endif">
                        @if ($plan->is_featured)
                            <div class="card-header d-flex justify-content-between">
                                <span class="badge bg-primary">{{ __('Featured') }}</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold mb-1">{{ $plan->name }}</h3>
                                <p class="text-muted">{{ $plan->description }}</p>
                            </div>
                            <div class="text-center mb-4">
                                <div class="d-flex justify-content-center">
                                    <sup class="h5 pricing-currency mt-3 mb-0 me-1 text-primary">{{ $plan->currency }}</sup>
                                    <h1 class="display-3 fw-bold mb-0 text-primary">{{ $plan->price_monthly }}</h1>
                                    <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/{{ __('month') }}</sub>
                                </div>
                                <p class="text-muted small">Yearly: {{ $plan->price_yearly }} {{ $plan->currency }}</p>
                            </div>

                            <ul class="list-unstyled mb-4 pb-1">
                                <li class="mb-3">
                                    <i class="bx bx-check-circle me-2 text-primary"></i>
                                    {{ __('Max Employees:') }} @if ($plan->max_employees)
                                        {{ $plan->max_employees }}
                                    @else
                                        {{ __('Unlimited') }}
                                    @endif
                                </li>
                                <li class="mb-3">
                                    <i class="bx bx-check-circle me-2 text-primary"></i>
                                    {{ __('Duration:') }} {{ $plan->duration_days }} {{ __('days') }}
                                </li>
                                <li class="mb-3">
                                    <i class="bx bx-check-circle me-2 text-primary"></i>
                                    {{ __('Status:') }}
                                    <span class="badge {{ $plan->is_active ? 'bg-label-success' : 'bg-label-secondary' }}">
                                        {{ $plan->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </li>
                            </ul>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-outline-info"><i
                                        class="bx bx-show me-1"></i> {{ __('View') }}</a>
                                <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-outline-primary"><i
                                        class="bx bx-edit-alt me-1"></i> {{ __('Edit') }}</a>
                                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $plans->links() }}
        </div>
    </div>
@endsection
