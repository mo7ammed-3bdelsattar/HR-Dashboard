<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') - Analytics | {{ env('APP_NAME') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    @if (app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
        <style>
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            .menu-item,
            .navbar-nav,
            .dropdown-item,
            .btn {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @endif

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

    <style>
        /* Manual Dark Mode Overrides */
        .dark-style {
            --bs-body-bg: #0d0d12;
            --bs-body-color: #9292af;
            --bs-paper-bg: #14141d;
            --bs-border-color: #272733;

            background-color: var(--bs-body-bg) !important;
            color: var(--bs-body-color) !important;
        }

        .dark-style .bg-menu-theme {
            background-color: #14141d !important;
            color: #9292af !important;
        }

        .dark-style .bg-navbar-theme {
            background-color: rgba(20, 20, 29, 0.9) !important;
            color: #9292af !important;
        }

        .dark-style .card {
            background-color: #14141d !important;
            color: #9292af !important;
            border-color: #272733 !important;
        }

        .dark-style .menu-link,
        .dark-style .menu-header-text {
            color: #9292af !important;
        }

        .dark-style .menu-item.active>.menu-link {
            background-color: rgba(105, 108, 255, 0.12) !important;
        }

        .dark-style .footer {
            background-color: #14141d !important;
            color: #9292af !important;
        }

        .dark-style h1,
        .dark-style h2,
        .dark-style h3,
        .dark-style h4,
        .dark-style h5,
        .dark-style h6,
        .dark-style .fw-bold {
            color: #e2e2f3 !important;
        }

        .dark-style .table {
            color: #9292af !important;
        }

        .dark-style .table th {
            color: #e2e2f3 !important;
            background-color: #1c1c28 !important;
        }

        .dark-style .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(124, 125, 182, 0.03) !important;
            color: #9292af !important;
        }

        .dark-style .table-striped tbody tr:nth-of-type(even) {
            background-color: #14141d !important;
            color: #9292af !important;
        }

        /* Input Fixes for Dark Mode */
        .dark-style .form-control,
        .dark-style .form-select,
        .dark-style .input-group-text {
            background-color: #14141d !important;
            border-color: #272733 !important;
            color: #9292af !important;
        }

        .dark-style .form-control:focus,
        .dark-style .form-select:focus {
            background-color: #14141d !important;
            color: #9292af !important;
            border-color: #696cff !important;
        }

        .dark-style .form-control::placeholder {
            color: rgba(146, 146, 175, 0.5) !important;
        }

        .dark-style .form-label {
            color: #e2e2f3 !important;
        }

        /* Modal & Dropdown Dark Mode Fixes */
        .dark-style .modal-content {
            background-color: #14141d !important;
            color: #9292af !important;
            border-color: #272733 !important;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.4) !important;
        }

        .dark-style .modal-header,
        .dark-style .modal-footer {
            border-color: #272733 !important;
        }

        .dark-style .dropdown-menu {
            background-color: #14141d !important;
            color: #9292af !important;
            border-color: #272733 !important;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.45) !important;
        }

        .dark-style .dropdown-item {
            color: #9292af !important;
        }

        .dark-style .dropdown-item:hover,
        .dark-style .dropdown-item:focus {
            background-color: rgba(124, 125, 182, 0.08) !important;
            color: #e2e2f3 !important;
        }

        .dark-style .dropdown-divider {
            border-color: #272733 !important;
        }

        /* List Group Fixes */
        .dark-style .list-group-item {
            background-color: #14141d !important;
            color: #9292af !important;
            border-color: #272733 !important;
        }

        /* Alert Fixes */
        .dark-style .alert-primary {
            background-color: rgba(105, 108, 255, 0.12) !important;
            border-color: rgba(105, 108, 255, 0.08) !important;
            color: #7d80ff !important;
        }

        /* Sidebar Menu Shadow & Scrollbar Fixes */
        .dark-style .menu-inner-shadow {
            background: linear-gradient(#14141d 5%, rgba(20, 20, 29, 0) 100%) !important;
        }

        .dark-style .layout-menu {
            box-shadow: 0 0.125rem 0.375rem 0 rgba(0, 0, 0, 0.3) !important;
        }

        /* Scrollbar for Dark Mode */
        .dark-style ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .dark-style ::-webkit-scrollbar-track {
            background: #0d0d12 !important;
        }

        .dark-style ::-webkit-scrollbar-thumb {
            background: #272733 !important;
            border-radius: 10px;
        }

        .dark-style ::-webkit-scrollbar-thumb:hover {
            background: #36364d !important;
        }

        /* Manual RTL Support Overrides */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }

        [dir="rtl"] .me-auto {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .me-3 {
            margin-left: 1rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .ms-2 {
            margin-right: 0.5rem !important;
            margin-left: 0 !important;
        }

        /* Sidebar RTL Positioning */
        @media (min-width: 1200px) {
            [dir="rtl"] .layout-menu {
                left: auto !important;
                right: 0 !important;
                border-left: 1px solid var(--bs-border-color);
                border-right: none !important;
            }

            [dir="rtl"] .layout-page {
                padding-left: 0 !important;
                padding-right: 16.25rem !important;
            }

            [dir="rtl"] .layout-navbar-fixed .layout-navbar {
                left: 0 !important;
                right: 16.25rem !important;
            }
        }

        /* Float and Text alignment fixes */
        [dir="rtl"] .text-end {
            text-align: left !important;
        }

        [dir="rtl"] .text-start {
            text-align: right !important;
        }

        [dir="rtl"] .float-end {
            float: left !important;
        }

        [dir="rtl"] .float-start {
            float: right !important;
        }

        /* Dropdown RTL Fixes */
        [dir="rtl"] .dropdown-menu-end {
            left: 0 !important;
            right: auto !important;
        }

        [dir="rtl"] .dropdown-menu {
            text-align: right !important;
        }
    </style>

    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-style');
                document.documentElement.classList.remove('light-style');
            } else {
                document.documentElement.classList.add('light-style');
                document.documentElement.classList.remove('dark-style');
            }
        })();
    </script>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/apex-charts/apex-charts.css" />

    @stack('styles')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
