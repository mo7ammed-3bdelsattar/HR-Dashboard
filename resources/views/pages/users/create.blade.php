@extends('layouts.master')

@section('title', __('Add User'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Users') }} /</span> {{ __('Create') }}</h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('User Information') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{ __('Full Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password" class="form-control" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="role">{{ __('Role') }}</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="company_admin">{{ __('Company Admin') }}</option>
                                <option value="super_admin">{{ __('Super Admin') }}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="company_id">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id" class="form-select">
                                <option value="">{{ __('None (Super Admin)') }}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">{{ __('Phone Number') }}</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone') }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" id="avatar" name="avatar" class="form-control" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Create User') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
