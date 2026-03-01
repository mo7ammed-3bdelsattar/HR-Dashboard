@extends('layouts.master')

@section('title', __('Add Company'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Companies') }} /</span> {{ __('Add New') }}
        </h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Company Details') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">{{ __('Company Name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="subdomain">{{ __('Subdomain') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control @error('subdomain') is-invalid @enderror"
                                            id="subdomain" name="subdomain" value="{{ old('subdomain') }}" required />
                                        <span class="input-group-text">.{{ config('app.url_suffix', 'yourapp.com') }}</span>
                                        @error('subdomain')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="status">{{ __('Status') }}</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="trial" {{ old('status') == 'trial' ? 'selected' : '' }}>Trial
                                        </option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>
                                            Suspended</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone1">{{ __('Phone 1') }}</label>
                                    <input type="text" class="form-control @error('phone1') is-invalid @enderror"
                                        id="phone1" name="phone1" value="{{ old('phone1') }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="timezone">{{ __('Timezone') }}</label>
                                    <input type="text" class="form-control @error('timezone') is-invalid @enderror"
                                        id="timezone" name="timezone" value="{{ old('timezone', 'UTC') }}" required />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="logo">{{ __('Company Logo') }}</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" />
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save Company') }}</button>
                            <a href="{{ route('companies.index') }}"
                                class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
