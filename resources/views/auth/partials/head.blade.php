  <head>
      <meta charset="utf-8" />
      <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>{{ __('Login') }} - {{ config('app.name') }}</title>

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
              .form-label,
              .btn {
                  font-family: 'Cairo', sans-serif !important;
              }
          </style>
      @endif

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      @if (app()->getLocale() == 'ar')
          <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/core.css"
              class="template-customizer-core-css" />
          <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/rtl/theme-default.css"
              class="template-customizer-theme-css" />
      @else
          <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css"
              class="template-customizer-core-css" />
          <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
              class="template-customizer-theme-css" />
      @endif
      <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

      <!-- Vendors CSS -->
      <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-auth.css" />
      <!-- Helpers -->
      <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="{{ asset('assets') }}/js/config.js"></script>
  </head>
