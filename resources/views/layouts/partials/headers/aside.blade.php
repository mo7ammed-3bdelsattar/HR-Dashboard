<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <div class="text-center">
                <img src="{{ asset('logo.jpg') }}" alt="Logo" class="mx-auto rounded-circle"
                    style="height: 60px; width: auto; object-fit: contain; max-width: 200px;">
            </div>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ config('app.name') }}</span>

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i
                class="bx {{ app()->getLocale() == 'ar' ? 'bx-chevron-right' : 'bx-chevron-left' }} bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <hr>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>{{ __('Dashboard') }}</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('Management') }}</span>
        </li>

        <!-- Companies -->
        <li class="menu-item {{ request()->routeIs('companies.*') ? 'active' : '' }}">
            <a href="{{ route('companies.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div>{{ __('Companies') }}</div>
            </a>
        </li>

        <!-- Plans -->
        <li class="menu-item {{ request()->routeIs('plans.*') ? 'active' : '' }}">
            <a href="{{ route('plans.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div>{{ __('Plans') }}</div>
            </a>
        </li>

        <!-- Subscriptions -->
        <li class="menu-item {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
            <a href="{{ route('subscriptions.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div>{{ __('Subscriptions') }}</div>
            </a>
        </li>

        <!-- Users -->
        <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>{{ __('Users') }}</div>
            </a>
        </li>
    </ul>
</aside>
