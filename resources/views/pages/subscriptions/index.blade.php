@extends('layouts.master')

@section('title', __('Subscriptions'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">{{ __('Management') }} /</span>
                {{ __('Subscriptions') }}</h4>
            <a href="{{ route('subscriptions.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; {{ __('New Subscription') }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">{{ __('All Subscriptions') }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Plan') }}</th>
                            <th>{{ __('Cycle') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Ends At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <td><strong>{{ $subscription->company->name ?? '-' }}</strong></td>
                                <td><span class="badge bg-label-primary">{{ $subscription->plan->name ?? '-' }}</span></td>
                                <td>{{ ucfirst($subscription->billing_cycle) }}</td>
                                <td>{{ $subscription->price_paid }} {{ $subscription->currency }}</td>
                                <td>
                                    @php
                                        $statusClass =
                                            [
                                                'active' => 'bg-label-success',
                                                'expired' => 'bg-label-warning',
                                                'cancelled' => 'bg-label-danger',
                                                'trial' => 'bg-label-info',
                                            ][$subscription->status] ?? 'bg-label-secondary';
                                    @endphp
                                    <span
                                        class="badge {{ $statusClass }} me-1">{{ ucfirst($subscription->status) }}</span>
                                </td>
                                <td>{{ $subscription->ends_at ? $subscription->ends_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('subscriptions.show', $subscription->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i> {{ __('Show') }}</a>
                                            @if ($subscription->status == 'active' || $subscription->status == 'trial')
                                            <form action="{{ route('subscriptions.cancel', $subscription->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item"><i
                                                        class="bx bx-x me-1"></i> {{ __('Cancel') }}</button>
                                            </form>
                                            @elseif ($subscription->status == 'trial' || $subscription->status == 'cancelled' || $subscription->status == 'expired')
                                            <form action="{{ route('subscriptions.activate', $subscription->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item"><i
                                                        class="bx bx-play me-1"></i> {{ __('Activate') }}</button>
                                            </form>
                                            @endif
                                            <form action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
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
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
@endsection
