@extends('checklist.layout')

@section('title', 'Profil')
@section('with-drawer', true)

@php $r = $cfg['route']; @endphp
@section('content')
    <header class="fl-profile-header-bar">
        <div class="fl-profile-header-left">
            <a href="{{ route($r . '.dashboard') }}" class="fl-step-close-btn" aria-label="Kembali ke Dashboard">
                <x-icon name="arrow-left" />
            </a>
            <h1 class="fl-profile-header-title">Profil</h1>
        </div>
        <button class="menu-btn" id="menuToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>

    <section class="fl-user-profile-card" aria-label="Profil karyawan">
        <div class="fl-user-profile-avatar" aria-hidden="true">
            <x-icon name="user" />
        </div>
        <h2 class="fl-user-profile-name">{{ $user['name'] }}</h2>
        <span class="fl-user-profile-badge">{{ $cfg['badge'] }}</span>
        <div class="fl-user-profile-status">
            <span class="fl-user-profile-dot"></span>
            <span>{{ $user['status_label'] }}</span>
        </div>
    </section>

    <section aria-labelledby="heading-info-akun">
        <h3 class="fl-account-info-heading" id="heading-info-akun">INFORMASI AKUN</h3>
        <div class="fl-account-info-card">
            <div class="fl-account-info-row">
                <div class="fl-account-info-left">
                    <x-icon name="mail" class="fl-account-info-icon" aria-hidden="true" />
                    <span>Email</span>
                </div>
                <span class="fl-account-info-val">{{ $user['email'] }}</span>
            </div>
            <div class="fl-account-info-row">
                <div class="fl-account-info-left">
                    <x-icon name="calendar" class="fl-account-info-icon" aria-hidden="true" />
                    <span>Bergabung Sejak</span>
                </div>
                <span class="fl-account-info-val">{{ $user['joined_at'] }}</span>
            </div>
        </div>
    </section>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="fl-btn-logout">
            <x-icon name="log-out" width="20" height="20" aria-hidden="true" />
            <span>Keluar (Logout)</span>
        </button>
    </form>

    <footer class="fl-profile-footer-brand">
        <span class="fl-profile-footer-name">CAPAIAN.ID</span>
        <span class="fl-profile-footer-sub">Sistem Pemantauan Kinerja Karyawan Toko Roti Wonosari</span>
    </footer>
@endsection
