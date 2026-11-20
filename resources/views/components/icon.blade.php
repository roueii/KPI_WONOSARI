{{--
    Ikon design system (Figma: section "icon") — set Iconoir v6, stroke 1.5, grid 24px.
    File SVG ada di resources/icons/{name}.svg.

    Pemakaian:
        <x-icon name="check" />                 -> 24px
        <x-icon name="arrow-right" size="20" />
        <x-icon name="cancel" class="foo" />    -> ukuran mengikuti CSS / atribut width & height
    Warna mengikuti `color` (currentColor).
--}}
@props(['name', 'size' => null])
@php
    $iconPath = resource_path('icons/' . $name . '.svg');
    $iconInner = is_file($iconPath)
        ? preg_replace(['~^.*?<svg[^>]*>~s', '~</svg>\s*$~', '~\s*\n\s*~'], ['', '', ''], file_get_contents($iconPath))
        : '';
    $iconDefaults = ['viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke-width' => '1.5', 'aria-hidden' => 'true'];
    if ($size !== null) {
        $iconDefaults['width'] = $size;
        $iconDefaults['height'] = $size;
    }
@endphp
<svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->class(['ds-icon'])->merge($iconDefaults) }}>{!! $iconInner !!}</svg>
