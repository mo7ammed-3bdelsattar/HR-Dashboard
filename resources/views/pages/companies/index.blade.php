@extends('layouts.master')

@section('title', __('Companies'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">{{ __('Management') }} /</span>
                {{ __('Companies') }}</h4>
            <a href="{{ route('companies.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; {{ __('Add Company') }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">{{ __('Companies List') }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Logo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Subdomain') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Trial Ends') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($companies as $company)
                            <tr>
                                <td>
                                    <img src="{{ asset($company->logo ?? 'uploads/default.png') }}" alt="logo"
                                        class="rounded-circle" width="40" height="40">
                                </td>
                                <td><strong>{{ $company->name }}</strong></td>
                                <td><code>{{ $company->subdomain }}</code></td>
                                <td>
                                    @php
                                        $statusClass =
                                            [
                                                'active' => 'bg-label-success',
                                                'suspended' => 'bg-label-danger',
                                                'cancelled' => 'bg-label-warning',
                                                'trial' => 'bg-label-info',
                                            ][$company->status] ?? 'bg-label-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }} me-1">{{ ucfirst($company->status) }}</span>
                                </td>
                                <td>{{ $company->trial_ends_at ? $company->trial_ends_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('companies.show', $company->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i> {{ __('Show') }}</a>
                                            <a class="dropdown-item" href="{{ route('companies.edit', $company->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> {{ __('Edit') }}</a>
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                                onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"><i
                                                        class="bx bx-trash me-1"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
@endsection
