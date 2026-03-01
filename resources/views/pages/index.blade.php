@extends('layouts.master')

@section('title', __('Dashboard'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ __('Welcome back,') }} {{ auth()->user()->name }}! 🎉
                                </h5>
                                <p class="mb-4">
                                    {{ __('You have') }} <span class="fw-bold">{{ $stats['active_subscriptions'] }}</span>
                                    {{ __('active subscriptions across') }} <span
                                        class="fw-bold">{{ $stats['total_companies'] }}</span> {{ __('companies.') }}
                                </p>
                                <a href="{{ route('companies.index') }}"
                                    class="btn btn-sm btn-outline-primary">{{ __('Manage Companies') }}</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-start">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bx-buildings text-primary"></i></span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">{{ __('Companies') }}</span>
                                <h3 class="card-title mb-2">{{ $stats['total_companies'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-success p-2"><i
                                                class="bx bx-user text-success"></i></span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">{{ __('Users') }}</span>
                                <h3 class="card-title mb-2">{{ $stats['total_users'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-info p-2"><i class="bx bx-package text-info"></i></span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">{{ __('Plans') }}</span>
                                <h3 class="card-title mb-2">{{ $stats['total_plans'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-warning p-2"><i
                                                class="bx bx-dollar text-warning"></i></span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">{{ __('Revenue') }}</span>
                                <h3 class="card-title mb-2 text-nowrap">${{ number_format($stats['total_revenue'], 2) }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Companies -->
            <div class="col-md-6 col-lg-6 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">{{ __('Recent Companies') }}</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="{{ route('companies.index') }}">{{ __('View All') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach ($recent_companies as $company)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        @if ($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="company"
                                                class="rounded">
                                        @else
                                            <span
                                                class="avatar-initial rounded bg-label-primary">{{ substr($company->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $company->subdomain }}</small>
                                            <h6 class="mb-0">{{ $company->name }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <span class="badge bg-label-info">{{ ucfirst($company->status) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="col-md-6 col-lg-6 order-3 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">{{ __('Recent Users') }}</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="{{ route('users.index') }}">{{ __('View All') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach ($recent_users as $user)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="user"
                                                class="rounded-circle">
                                        @else
                                            <span
                                                class="avatar-initial rounded-circle bg-label-success">{{ substr($user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $user->email }}</small>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <small class="fw-semibold">{{ $user->company->name ?? __('System') }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
