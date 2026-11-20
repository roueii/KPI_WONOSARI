<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Pengguna | Capaian.id - Store Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/storemanager.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="app-container">
        <!-- 1. Header Bar Sesuai Desain Figma Halaman Profil.png -->
        <header class="fl-top-nav" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <a href="{{ route('storemanager.dashboard') }}" class="fl-nav-back-btn" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid var(--secondary-100); background: var(--white); display: flex; align-items: center; justify-content: center; color: var(--neutral-900); text-decoration: none;" aria-label="Kembali ke Dashboard">
                    <x-icon name="arrow-left" width="20" height="20" />
                </a>
                <h1 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0;">Profil</h1>
            </div>

            <!-- Hamburger Button -->
            <button class="menu-btn" id="menuToggle" aria-label="Buka menu navigasi" aria-expanded="false" style="width: 40px; height: 40px; border-radius: 12px; border: 1.5px solid var(--secondary-100); background: var(--white); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; cursor: pointer;">
                <span style="width: 18px; height: 2px; background: var(--neutral-900); border-radius: 2px;"></span>
                <span style="width: 18px; height: 2px; background: var(--neutral-900); border-radius: 2px;"></span>
                <span style="width: 18px; height: 2px; background: var(--neutral-900); border-radius: 2px;"></span>
            </button>
        </header>

        <!-- 2. Kartu Profil Pengguna Sesuai Figma -->
        <section style="background: var(--neutral-50); border: 1px solid var(--secondary-100); border-radius: 20px; padding: 28px 20px; text-align: center; margin-bottom: 24px;">
            <div style="width: 76px; height: 76px; border-radius: 50%; border: 1.5px solid var(--primary-200); background: var(--white); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: var(--neutral-500);">
                <x-icon name="user" width="38" height="38" />
            </div>

            <h2 style="font-size: var(--fs-22); font-weight: var(--fw-semibold); color: var(--neutral-900); margin: 0 0 6px;">{{ $user['name'] ?? 'User' }}</h2>

            <div style="margin-bottom: 8px;">
                <span style="display: inline-block; border: 1.5px solid var(--primary-700); background: var(--secondary-50); color: var(--primary-700); font-size: var(--fs-12); font-weight: var(--fw-semibold); padding: 3px 12px; border-radius: 999px; letter-spacing: 0.05em;">
                    {{ $user['role_label'] ?? 'STORE MANAGER' }}
                </span>
            </div>

            <div style="display: flex; align-items: center; justify-content: center; gap: 6px; font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--primary-600);">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: var(--primary-600);"></span>
                <span>{{ $user['status_label'] ?? 'Akun Aktif' }}</span>
            </div>
        </section>

        <!-- 3. Informasi Akun Sesuai Figma -->
        <div style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-400); letter-spacing: 0.05em; margin-bottom: 8px;">
            INFORMASI AKUN
        </div>

        <section style="background: var(--white); border: 1px solid var(--secondary-100); border-radius: 18px; padding: 6px 18px; margin-bottom: 28px;">
            <!-- Baris Email -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid var(--secondary-100);">
                <div style="display: flex; align-items: center; gap: 12px; color: var(--neutral-500); font-size: var(--fs-14); font-weight: 600;">
                    <x-icon name="mail" width="18" height="18" />
                    <span>Email</span>
                </div>
                <span style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900);">{{ $user['email'] ?? 'User@capaian.id' }}</span>
            </div>

            <!-- Baris Bergabung Sejak -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 14px 0;">
                <div style="display: flex; align-items: center; gap: 12px; color: var(--neutral-500); font-size: var(--fs-14); font-weight: 600;">
                    <x-icon name="calendar" width="18" height="18" />
                    <span>Bergabung Sejak</span>
                </div>
                <span style="font-size: var(--fs-14); font-weight: var(--fw-semibold); color: var(--neutral-900);">{{ $user['joined_at'] ?? 'Jan 2024' }}</span>
            </div>
        </section>

        <!-- 4. Tombol Keluar (Logout) Sesuai Figma -->
        <form action="{{ route('logout') }}" method="POST" style="margin-bottom: 32px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 15px; border-radius: 14px; border: none; background: var(--primary-500); color: var(--white); font-size: var(--fs-16); font-weight: var(--fw-semibold); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 14px rgba(249, 115, 22, 0.32);">
                <x-icon name="log-out" width="20" height="20" />
                <span>Keluar (Logout)</span>
            </button>
        </form>

        <!-- 5. Footer Branding Sesuai Figma -->
        <footer style="text-align: center; margin-bottom: 24px;">
            <div style="font-size: var(--fs-12); font-weight: var(--fw-semibold); color: var(--neutral-500); letter-spacing: 0.05em; margin-bottom: 4px;">
                CAPAIAN.ID
            </div>
            <div style="font-size: var(--fs-12); color: var(--neutral-400);">
                Sistem Pemantauan Kinerja Karyawan Toko Roti Wonosari
            </div>
        </footer>
    </div>

    <!-- Navigation Drawer -->
    @include('storemanager.partials.drawer')

    <script src="{{ asset('js/drawer.js') }}"></script>
</body>

</html>

