@extends('layouts.master')

@section('title', __('User Profile') . ' - ' . $user->name)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">{{ __('Management') }} / {{ __('Users') }} /</span> {{ __('Profile') }}
        </h4>

        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                @if ($user->avatar)
                                    <img class="img-fluid rounded my-4" src="{{ asset('storage/' . $user->avatar) }}"
                                        height="110" width="110" alt="User avatar" />
                                @else
                                    <div class="avatar avatar-xl my-4">
                                        <span
                                            class="avatar-initial rounded bg-label-primary">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ $user->name }}</h4>
                                    <span
                                        class="badge bg-label-info">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                                </div>
                            </div>
                        </div>

                        <h5 class="pb-2 border-bottom mb-4">{{ __('Details') }}</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Email:') }}</span>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Status:') }}</span>
                                    <span class="badge {{ $user->is_active ? 'bg-label-success' : 'bg-label-secondary' }}">
                                        {{ $user->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Company:') }}</span>
                                    <span>{{ $user->company->name ?? __('System') }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">{{ __('Phone:') }}</span>
                                    <span>{{ $user->phone ?? '-' }}</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center pt-3">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-primary me-3">{{ __('Edit') }}</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-label-danger">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Data Column -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- Company Info Box -->
                @if ($user->company)
                    <div class="card mb-4">
                        <h5 class="card-header">{{ __('Company Association') }}</h5>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar avatar-md me-3">
                                    @if ($user->company->logo)
                                        <img src="{{ asset('storage/' . $user->company->logo) }}" alt="logo"
                                            class="rounded">
                                    @else
                                        <span
                                            class="avatar-initial rounded bg-label-secondary">{{ substr($user->company->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $user->company->name }}</h6>
                                    <small
                                        class="text-muted">{{ $user->company->subdomain }}.{{ config('app.domain') }}</small>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('companies.show', $user->company->id) }}"
                                        class="btn btn-sm btn-outline-primary">{{ __('View Company') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Activity Logs Placeholder -->
                <div class="card mb-4">
                    <h5 class="card-header">{{ __('Recent Activity') }}</h5>
                    <div class="card-body">
                        <p class="text-muted">{{ __('No recent activity logs found for this user.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
