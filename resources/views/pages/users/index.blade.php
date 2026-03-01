@extends('layouts.master')

@section('title', __('Users'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">{{ __('Management') }} /</span>
                {{ __('Users') }}</h4>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; {{ __('Add User') }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">{{ __('Users List') }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Company') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar-wrapper me-3">
                                            <div class="avatar avatar-sm">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                        class="rounded-circle">
                                                @else
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-primary">{{ substr($user->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($user->company)
                                        <span class="badge bg-label-info">{{ $user->company->name }}</span>
                                    @else
                                        <span class="badge bg-label-secondary">{{ __('System (Super Admin)') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-truncate d-flex align-items-center">
                                        <i
                                            class="bx @if ($user->role == 'super_admin') bx-crown @else bx-user @endif me-2"></i>
                                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $user->is_active ? 'bg-label-success' : 'bg-label-danger' }}">
                                        {{ $user->is_active ? __('Active') : __('Inactive') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i
                                                    class="bx bx-show-alt me-1"></i> {{ __('Show') }}</a>
                                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> {{ __('Edit') }}</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
