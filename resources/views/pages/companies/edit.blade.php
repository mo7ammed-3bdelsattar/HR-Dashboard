@extends('layouts.master')

@section('title', __('Edit Company'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Companies') }} /</span> {{ __('Edit') }} /
            {{ $company->name }}</h4>

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Edit Company Details') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('companies.update', $company->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">{{ __('Company Name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $company->name) }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="subdomain">{{ __('Subdomain') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control @error('subdomain') is-invalid @enderror"
                                            id="subdomain" name="subdomain"
                                            value="{{ old('subdomain', $company->subdomain) }}" required />
                                        <span
                                            class="input-group-text">.{{ config('app.url_suffix', 'yourapp.com') }}</span>
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
                                        id="email" name="email" value="{{ old('email', $company->email) }}" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="status">{{ __('Status') }}</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="trial"
                                            {{ old('status', $company->status) == 'trial' ? 'selected' : '' }}>Trial
                                        </option>
                                        <option value="active"
                                            {{ old('status', $company->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="suspended"
                                            {{ old('status', $company->status) == 'suspended' ? 'selected' : '' }}>
                                            Suspended</option>
                                        <option value="cancelled"
                                            {{ old('status', $company->status) == 'cancelled' ? 'selected' : '' }}>
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
                                        id="phone1" name="phone1" value="{{ old('phone1', $company->phone1) }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="timezone">{{ __('Timezone') }}</label>
                                    <input type="text" class="form-control @error('timezone') is-invalid @enderror"
                                        id="timezone" name="timezone" value="{{ old('timezone', $company->timezone) }}"
                                        required />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="logo">{{ __('Company Logo') }}</label>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="logo"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    @endif
                                    <div class="button-wrapper">
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                            id="logo" name="logo" />
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">{{ __('Update Company') }}</button>
                            <a href="{{ route('companies.index') }}"
                                class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
