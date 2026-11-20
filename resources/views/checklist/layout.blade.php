<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | Capaian.id - {{ $cfg['page_title'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/checklist.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        @if (session('status'))
            <div class="ck-flash" role="status">{{ session('status') }}</div>
        @endif

        @yield('content')

        @hasSection('with-drawer')
            @include('checklist.partials.drawer')
        @endif
    </div>

    @hasSection('with-drawer')
        <script src="{{ asset('js/drawer.js') }}"></script>
    @endif

    @stack('scripts')
</body>

</html>
