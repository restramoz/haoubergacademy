@props([
    'variant' => 'filled',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none cursor-pointer text-center';

    $sizes = [
        'sm' => 'px-3.5 py-1.5 text-xs sm:text-sm gap-1.5 min-h-[38px]',
        'md' => 'px-5 py-2.5 text-sm sm:text-base gap-2 min-h-[44px]',
        'lg' => 'px-7 py-3 text-base sm:text-lg gap-2.5 min-h-[48px]',
    ];

    // Button variants using new Houberg Academy design tokens
    // Primary: teal #0F766E, hover: teal-dark #0B5F59
    // Outline: transparent bg, teal border/text, hover: teal bg, white text
    // White: white bg, navy text, border, hover: sky-50 bg
    // WA: WhatsApp green #25D366
    $variants = [
        'filled' => 'bg-primary hover:bg-primary-dark text-white shadow-sm active:opacity-90 font-bold',
        'outline' => 'bg-transparent hover:bg-primary hover:text-white text-primary font-bold border-2 border-primary active:bg-primary',
        'white' => 'bg-white hover:bg-sky-50 text-navy-900 font-semibold shadow-sm border border-border active:bg-sky-50',
        'wa' => 'bg-[#25D366] hover:bg-[#1DB954] text-white shadow-sm active:opacity-90 font-bold',
        'dark' => 'bg-navy-900 hover:bg-navy-800 text-white font-bold shadow-sm border border-neutral-700 active:bg-navy-900',
    ];

    $sizeClasses = $sizes[$size] ?? $sizes['md'];
    $variantClasses = $variants[$variant] ?? $variants['filled'];
    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif