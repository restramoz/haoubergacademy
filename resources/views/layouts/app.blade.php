<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F8FAFC] text-[#0F172A] antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

@php
    // Brand appears exactly once: only append when not already present
    // (case-insensitive), e.g. scheme meta_title already ends with the brand.
    $brandName = trim((string) config('app.name', 'Houberg Academy'));
    $brandTitle = trim((string) View::getSection('title'));
    if ($brandTitle === '') {
        $brandTitle = $brandName;
    } elseif (! str_contains(mb_strtolower($brandTitle), mb_strtolower($brandName))) {
        $brandTitle .= ' — '.$brandName;
    }
@endphp

    <!-- Isi judul section sudah di-escape di titik penyimpanannya (startSection), jadi cetak apa adanya. -->
    <title>{!! $brandTitle !!}</title>
    <meta name="description" content="@yield('meta_description', 'Houberg Academy adalah platform Learning & Development untuk pengembangan kompetensi profesional. Jelajahi 4.177+ program di 21 kategori, tersedia di 38 provinsi. Konsultasi gratis via WhatsApp.')">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', rtrim(config('app.url'), '/') . request()->getPathInfo())">

    <!-- Open Graph / Meta -->
    <meta property="og:title" content="{!! $brandTitle !!}">
    <meta property="og:description" content="@yield('meta_description', 'Houberg Academy adalah platform Learning & Development untuk pengembangan kompetensi profesional. Jelajahi 4.177+ program di 21 kategori, tersedia di 38 provinsi. Konsultasi gratis via WhatsApp.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical_url', rtrim(config('app.url'), '/') . request()->getPathInfo())">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{!! $brandTitle !!}">
    <meta name="twitter:description" content="@yield('meta_description', 'Houberg Academy menyediakan akses terarah ke 4.177+ program pembelajaran di 21 kategori. Temukan jalur pengembangan kompetensi yang sesuai dengan tujuan karir Anda.')">

    <!-- Theme Color -->
    <meta name="theme-color" content="#4F46E5">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @hasSection('robots')
    <meta name="robots" content="@yield('robots')">
    @endif

    @stack('schema')
    @stack('styles')
</head>
<body class="min-h-full flex flex-col bg-[#F8FAFC] text-[#0F172A] antialiased selection:bg-[#14B8A6] selection:text-white">
    <!-- Accessible Skip Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 z-50 bg-[#14B8A6] text-white font-bold px-4 py-2 rounded-md shadow-lg outline-none ring-2 ring-[#0F172A]">
        Lewati ke konten utama
    </a>

    <!-- Site Header -->
    <x-header />

    <!-- Main Content Landmark -->
    <main id="main-content" class="flex-grow focus:outline-none" tabindex="-1">
        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    <!-- Site Footer -->
    <x-footer />

    <!-- Floating WhatsApp CTA -->
    <x-wa-float :message="View::hasSection('wa_message') ? View::getSection('wa_message') : null" />

    @stack('scripts')
</body>
</html>
