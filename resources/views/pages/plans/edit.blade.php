@extends('layouts.master')

@section('title', __('Edit Plan'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Plans') }} /</span> {{ __('Edit') }} /
            {{ $plan->name }}</h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Edit Plan Details') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{ __('Plan Name') }}</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $plan->name) }}" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="slug">{{ __('Slug') }}</label>
                            <input type="text" id="slug" name="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $plan->slug) }}" />
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">{{ __('Description') }}</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3">{{ old('description', $plan->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="price_monthly">{{ __('Monthly Price') }}</label>
                            <input type="number" step="0.01" id="price_monthly" name="price_monthly"
                                class="form-control @error('price_monthly') is-invalid @enderror"
                                value="{{ old('price_monthly', $plan->price_monthly) }}" />
                            @error('price_monthly')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="price_yearly">{{ __('Yearly Price') }}</label>
                            <input type="number" step="0.01" id="price_yearly" name="price_yearly"
                                class="form-control @error('price_yearly') is-invalid @enderror"
                                value="{{ old('price_yearly', $plan->price_yearly) }}" />
                            @error('price_yearly')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <input type="text" id="currency" name="currency" class="form-control"
                                value="{{ old('currency', $plan->currency) }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="max_employees">{{ __('Max Employees (0 = Unlimited)') }}</label>
                            <input type="number" id="max_employees" name="max_employees"
                                class="form-control @error('max_employees') is-invalid @enderror"
                                value="{{ old('max_employees', $plan->max_employees) }}" />
                            @error('max_employees')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="duration_days">{{ __('Duration (Days)') }}</label>
                            <input type="number" id="duration_days" name="duration_days"
                                class="form-control @error('duration_days') is-invalid @enderror"
                                value="{{ old('duration_days', $plan->duration_days) }}" />
                            @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ $plan->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1" {{ $plan->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">{{ __('Featured') }}</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="sort_order">{{ __('Sort Order') }}</label>
                            <input type="number" id="sort_order" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $plan->sort_order) }}" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Update Plan') }}</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
