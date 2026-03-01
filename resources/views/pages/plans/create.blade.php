@extends('layouts.master')

@section('title', __('Add Plan'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Plans') }} /</span> {{ __('Create') }}</h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Plan Details') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('plans.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{ __('Plan Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="slug">{{ __('Slug') }}</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ old('slug') }}" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">{{ __('Description') }}</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="price_monthly">{{ __('Monthly Price') }}</label>
                            <input type="number" step="0.01" id="price_monthly" name="price_monthly"
                                class="form-control" value="{{ old('price_monthly') }}" required />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="price_yearly">{{ __('Yearly Price') }}</label>
                            <input type="number" step="0.01" id="price_yearly" name="price_yearly" class="form-control"
                                value="{{ old('price_yearly') }}" required />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="currency">{{ __('Currency') }}</label>
                            <input type="text" id="currency" name="currency" class="form-control"
                                value="{{ old('currency', 'USD') }}" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="max_employees">{{ __('Max Employees (0 = Unlimited)') }}</label>
                            <input type="number" id="max_employees" name="max_employees" class="form-control"
                                value="{{ old('max_employees') }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="duration_days">{{ __('Duration (Days)') }}</label>
                            <input type="number" id="duration_days" name="duration_days" class="form-control"
                                value="{{ old('duration_days', 30) }}" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-4 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 d-flex align-items-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1">
                                <label class="form-check-label" for="is_featured">{{ __('Featured') }}</label>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="sort_order">{{ __('Sort Order') }}</label>
                            <input type="number" id="sort_order" name="sort_order" class="form-control"
                                value="{{ old('sort_order', 0) }}" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Save Plan') }}</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
