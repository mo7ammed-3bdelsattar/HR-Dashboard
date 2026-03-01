@extends('layouts.master')

@section('title', __('Edit User'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Users') }} /</span> {{ __('Edit') }} /
            {{ $user->name }}</h4>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Edit User Information') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{ __('Full Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                for="password">{{ __('Password (Leave blank to keep current)') }}</label>
                            <input type="password" id="password" name="password" class="form-control" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="role">{{ __('Role') }}</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="company_admin" {{ $user->role == 'company_admin' ? 'selected' : '' }}>
                                    {{ __('Company Admin') }}</option>
                                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>
                                    {{ __('Super Admin') }}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="company_id">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id" class="form-select">
                                <option value="">{{ __('None (Super Admin)') }}</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $user->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">{{ __('Phone Number') }}</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}" />
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" id="avatar" name="avatar" class="form-control" />
                        </div>
                        <div class="mb-3 col-md-2 d-flex align-items-center">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded"
                                    width="50">
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{ __('Update User') }}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
