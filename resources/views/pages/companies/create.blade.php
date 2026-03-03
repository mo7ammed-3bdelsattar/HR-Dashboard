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
                                    <label class="form-label" for="admin_name">{{ __('Admin Name') }}</label>
                                    <input type="text" class="form-control @error('admin_name') is-invalid @enderror"
                                        id="admin_name" name="admin_name" value="{{ old('admin_name') }}" />
                                    @error('admin_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="admin_email">{{ __('Admin Email') }} (Optional)</label>
                                    <input type="text" class="form-control @error('admin_email') is-invalid @enderror"
                                        id="admin_email" name="admin_email" value="{{ old('admin_email') }}" />
                                    @error('admin_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="name">{{ __('Company Name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="subdomain">{{ __('Subdomain') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control @error('subdomain') is-invalid @enderror"
                                            id="subdomain" name="subdomain" value="{{ old('subdomain') }}" />
                                        <span
                                            class="input-group-text">.{{ config('app.url_suffix', 'gosorsolutions.com') }}</span>
                                        @error('subdomain')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

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
                                        name="status">
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

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone1">{{ __('Phone 1') }}</label>
                                    <input type="text" class="form-control @error('phone1') is-invalid @enderror"
                                        id="phone1" name="phone1" value="{{ old('phone1') }}" />
                                    @error('phone1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone2">{{ __('Phone 2') }}</label>
                                    <input type="text" class="form-control @error('phone2') is-invalid @enderror"
                                        id="phone2" name="phone2" value="{{ old('phone2') }}" />
                                    @error('phone2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="timezone">{{ __('Timezone') }}</label>
                                    <input type="text" class="form-control @error('timezone') is-invalid @enderror"
                                        id="timezone" name="timezone" value="{{ old('timezone', 'UTC') }}" />
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
