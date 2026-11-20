{{-- Alias nama ikon lama -> ikon Iconoir di design system (lihat components/icon.blade.php) --}}
@php
    $iconAliases = [
        'home' => 'home-simple',
        'clock' => 'clock',
        'user' => 'user',
        'chart' => 'stats-report',
        'megaphone' => 'megaphone',
        'handshake' => 'community',
        'store' => 'shop',
        'headset' => 'headset-help',
        'box' => 'box-iso',
        'lightbulb' => 'light-bulb',
        'sparkle' => 'sparks',
        'clipboard' => 'paste-clipboard',
    ];
@endphp
<x-icon :name="$iconAliases[$name] ?? 'page'" :size="$size ?? 22" />
