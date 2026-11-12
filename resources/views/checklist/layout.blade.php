<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | Capaian.id - {{ $cfg['page_title'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/driver.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/checklist.css') }}" />
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
        <script>
            (function () {
                const toggle = document.getElementById('menuToggle');
                const overlay = document.getElementById('drawerOverlay');
                const open = () => {
                    overlay.classList.add('is-open');
                    overlay.setAttribute('aria-hidden', 'false');
                    toggle?.setAttribute('aria-expanded', 'true');
                    document.body.style.overflow = 'hidden';
                };
                const close = () => {
                    overlay.classList.remove('is-open');
                    overlay.setAttribute('aria-hidden', 'true');
                    toggle?.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                };
                toggle?.addEventListener('click', open);
                document.getElementById('drawerCloseBtn')?.addEventListener('click', close);
                document.getElementById('drawerBackdrop')?.addEventListener('click', close);
                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape' && overlay.classList.contains('is-open')) close();
                });
            })();
        </script>
    @endif

    @stack('scripts')
</body>

</html>
