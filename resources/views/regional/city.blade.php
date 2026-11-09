@extends('layouts.app')

@section('title', 'Program di ' . $city['name'] . ' - Houberg Academy')
@section('meta_description', 'Informasi katalog program pembelajaran dengan konteks ' . $city['name'] . ', Provinsi ' . $city['province'] . '. Telusuri program di 6 kategori. Konsultasi gratis via WhatsApp.')
@section('wa_message', $waMessage)

@section('content')
@php
    $schemeService = app(\App\Services\SchemeService::class);
    $allPrograms = $programs;
    $categories = collect($programs)->groupBy(fn ($item) => $item['category_label'] ?? 'Layanan Lainnya')->map(function ($items, $categoryName) use ($schemeService) {
        return [
            'name' => $categoryName,
            'slug' => \Illuminate\Support\Str::slug($categoryName),
            'items' => $items,
            'count' => $items->count(),
            'meta' => $schemeService::categoryMetadata($categoryName),
        ];
    })->sortBy('name')->values();
    $totalServices = count($programs);
    $waPhone = \App\Support\WhatsApp::normalizePhone(config('services.whatsapp.phone'));
@endphp

<noscript>
    <style>.scheme-extra[hidden]{display:block!important;}</style>
</noscript>

<!-- Breadcrumb -->
<div class="bg-sky-50 border-b border-border">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-3">
        <x-breadcrumb :items="[
            ['label' => 'Wilayah', 'url' => route('home') . '#wilayah'],
            ['label' => $city['province'], 'url' => route('regional.province', $city['province_slug'])],
            ['label' => $city['name'], 'url' => null],
        ]" />
    </div>
</div>

<!-- Hero -->
<section class="relative overflow-hidden section-py" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);">
    <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs><pattern id="grid-c" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="#FFF" stroke-width="1"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#grid-c)" />
        </svg>
    </div>
    <div class="relative mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
        <div class="max-w-3xl">
            <!-- Mobile hero image -->
            <div class="lg:hidden mb-5 -mx-4 sm:-mx-6 lg:-mx-8">
                <img src="/images/WILAYAH KOTA.jpg"
                     alt="Wilayah {{ $city['name'] }}"
                     width="1600"
                     height="900"
                     loading="eager"
                     fetchpriority="high"
                     decoding="async"
                     class="hero-image-mobile w-full object-cover object-center rounded-xl" />
            </div>
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Wilayah
            </span>
            <h1 id="city-hero-heading" class="mt-4 font-heading font-extrabold tracking-tight text-white leading-tight text-3xl sm:text-4xl lg:text-5xl">
                Program di <span class="text-primary">{{ $city['name'] }}</span>
            </h1>
            <p class="mt-6 text-body text-slate-300 leading-relaxed">
                Informasi katalog program dengan konteks <strong class="text-white">{{ $city['name'] }}</strong>, Provinsi {{ $city['province'] }}.
                Nama wilayah ini tidak menyatakan adanya kantor atau penyelenggaraan setempat.
            </p>
            <div class="mt-7 flex flex-col sm:flex-row gap-3 sm:gap-4 w-full">
                <x-wa-cta variant="wa" size="lg" :message="$waMessage" label="Konsultasi Wilayah {{ $city['name'] }}" class="w-full sm:w-auto font-bold shadow-lg justify-center" />
            </div>
            <div class="mt-8 pt-6 border-t border-navy-800 grid grid-cols-2 gap-4 sm:gap-6">
                <div class="min-w-0"><div class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider">Provinsi</div><div class="text-sm sm:text-base font-heading font-bold text-white mt-0.5 truncate">{{ $city['province'] }}</div></div>
                <div class="min-w-0"><div class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider">Pulau</div><div class="text-sm sm:text-base font-heading font-bold text-primary mt-0.5">{{ $city['island'] }}</div></div>
                <div class="min-w-0"><div class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider">Program</div><div class="text-sm sm:text-base font-heading font-bold text-white mt-0.5">{{ count($programs) }}</div></div>
                <div class="min-w-0"><div class="text-[10px] sm:text-xs text-slate-400 uppercase tracking-wider">Lingkup</div><div class="text-sm sm:text-base font-heading font-bold text-primary mt-0.5">Houberg Academy</div></div>
            </div>
        </div>
    </div>
</section>

<!-- Disclaimer -->
<section class="py-8 bg-amber-50 border-b border-amber-200">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="flex items-start gap-4">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <p class="text-body-sm text-amber-900 leading-relaxed">
                <strong class="text-amber-900">Catatan penting:</strong> Halaman ini adalah halaman informasi dan konsultasi program. Informasi program yang tercantum dapat ditinjau pada halaman ini. Jadwal dan penyelenggaraan perlu dikonfirmasi sesuai program yang diminati.
            </p>
        </div>
    </div>
</section>

<!-- Service Catalog -->
@include('components.service-catalog', ['catalogContext' => 'city', 'catalogGeographicSlug' => $city['slug']])

<!-- Proses & Syarat Umum -->
<section id="proses-syarat" class="section-py bg-sky-50" aria-labelledby="city-proses-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl mb-8">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Proses & Syarat
            </span>
            <h2 id="city-proses-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Proses &amp; Syarat Umum
            </h2>
            <p class="mt-3 text-body text-slate-600 leading-relaxed">
                Untuk mengetahui proses, persyaratan, materi, dan informasi program secara lengkap, silakan lihat halaman program terkait atau hubungi Houberg Academy melalui kanal resmi.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl">
            <div class="rounded-xl border border-border bg-white p-5">
                <h3 class="font-heading font-bold text-navy-900 mb-2">Rincian program</h3>
                <p class="text-body-sm text-slate-600 leading-relaxed">Rincian proses, persyaratan, dan materi setiap program dapat dilihat pada halaman program terkait.</p>
            </div>
            <div class="rounded-xl border border-border bg-white p-5">
                <h3 class="font-heading font-bold text-navy-900 mb-2">Konsultasi</h3>
                <p class="text-body-sm text-slate-600 leading-relaxed">Untuk rincian lebih lanjut, hubungi Houberg Academy melalui kanal resmi WhatsApp. Tautan WhatsApp tersedia pada halaman ini dan di halaman program.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="section-py bg-white" aria-labelledby="city-faq-heading">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="section-header text-center mb-12">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Tanya Jawab
            </span>
            <h2 id="city-faq-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Pertanyaan Umum: Program di {{ $city['name'] }}
            </h2>
        </div>
        <div class="space-y-3">
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Bagaimana cara mendapatkan informasi program di {{ $city['name'] }}?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Telusuri katalog program di halaman ini, lalu buka halaman detail program terkait untuk melihat rincian. Hubungi Houberg Academy melalui kanal resmi untuk konsultasi.</p>
            </details>
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Bagaimana cara mengetahui persyaratan program?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Persyaratan setiap program dapat dilihat pada halaman program terkait. Untuk rincian lebih lanjut, hubungi Houberg Academy melalui kanal resmi.</p>
            </details>
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Bagaimana cara mengetahui materi atau silabus program?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Materi atau silabus program tersedia pada halaman detail program terkait. Hubungi Houberg Academy untuk penjelasan lebih rinci.</p>
            </details>
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Bagaimana cara menghubungi Houberg Academy?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Gunakan tombol WhatsApp yang tersedia pada halaman ini atau halaman program. Seluruh konsultasi program disampaikan melalui kanal resmi Houberg Academy.</p>
            </details>
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Apakah informasi program dapat dikonsultasikan terlebih dahulu?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Ya. Anda dapat menghubungi Houberg Academy terlebih dahulu untuk membahas program yang diminati. Konsultasi tidak menjanjikan penetapan program tanpa konfirmasi.</p>
            </details>
        </div>
    </div>
</section>

<!-- Regional Map -->
<x-regional-map :citySlug="$city['slug']" :regionName="$city['name']" />

<!-- Articles -->
@if(isset($articles) && count($articles) > 0)
<section id="artikel" class="section-py bg-white border-b border-border" aria-labelledby="city-article-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-xl mb-8">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Insights
            </span>
            <h2 id="city-article-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Artikel &amp; Panduan di {{ $city['name'] }}
            </h2>
            <p class="mt-3 text-body text-slate-600">Artikel edukatif terkait pengembangan kompetensi untuk wilayah {{ $city['name'] }}.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $art)
                <article class="article-card group flex flex-col">
                    <div class="relative aspect-[16/9] overflow-hidden">
                        @if($art->featured_image)
                            <img src="/{{ ltrim($art->featured_image, '/') }}"
                                 alt="{{ $art->title }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        @else
                            <div class="w-full h-full bg-mint-50 flex items-center justify-center">
                                <svg class="w-12 h-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="card-content flex-1 flex flex-col">
                        <h3 class="font-heading font-bold text-navy-900 text-lg leading-snug mb-2 group-hover:text-primary transition-colors line-clamp-2">
                            <a href="{{ route('articles.show', $art->slug) }}" class="focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                                {{ $art->title }}
                            </a>
                        </h3>
                        <p class="text-body-sm text-slate-600 flex-1 leading-relaxed line-clamp-3">{{ $art->excerpt }}</p>
                        <div class="mt-4 pt-4 border-t border-border flex items-center justify-between">
                            <a href="{{ route('articles.show', $art->slug) }}"
                               class="text-body-sm font-bold text-primary hover:text-primary-dark inline-flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Nearby Cities -->
@if(count($nearbyCities) > 0)
<section class="section-py bg-sky-50 border-b border-border" aria-labelledby="city-nearby-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-xl mb-6">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Wilayah Terkait
            </span>
            <h2 id="city-nearby-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-xl sm:text-2xl">
                Kabupaten &amp; Kota Lain di Provinsi {{ $city['province'] }}
            </h2>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach($nearbyCities as $c)
            <a href="{{ route('regional.city', $c['slug']) }}" class="inline-flex px-4 py-2 rounded-full bg-white border border-border hover:border-primary text-body-sm text-slate-700 hover:text-primary transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                {{ $c['name'] }}
            </a>
            @endforeach
            <a href="{{ route('regional.province', $city['province_slug']) }}" class="inline-flex px-4 py-2 rounded-full bg-white border border-primary text-body-sm font-semibold text-primary hover:bg-sky-50 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                Lihat semua Provinsi {{ $city['province'] }} →
            </a>
        </div>
    </div>
</section>
@endif

<!-- Final CTA -->
<section class="section-py" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);" aria-labelledby="city-cta-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 id="city-cta-heading" class="font-heading font-extrabold text-white text-2xl sm:text-3xl lg:text-4xl leading-tight">
                Konsultasi Program <span class="text-primary">{{ $city['name'] }}</span>
            </h2>
            <p class="mt-4 text-body text-slate-300 leading-relaxed">
                Hubungi kami untuk menanyakan informasi program pelatihan yang tercantum dalam katalog Houberg Academy.
            </p>
            <div class="mt-7 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 w-full">
                <x-wa-cta variant="wa" size="lg" :message="$waMessage" label="Konsultasi Sekarang" class="w-full sm:w-auto font-bold shadow-lg justify-center" />
                <x-button :href="route('regional.province', $city['province_slug'])" variant="white" size="lg" class="w-full sm:w-auto">
                    Provinsi {{ $city['province'] }}
                </x-button>
            </div>
            <div class="mt-10 pt-8 border-t border-navy-800 flex flex-wrap justify-center gap-4 text-body-sm text-slate-500">
                <a href="{{ route('home') }}#program" class="hover:text-primary transition-colors">Program Pembelajaran</a>
                <span aria-hidden="true">•</span>
                <a href="{{ route('home') }}#wilayah" class="hover:text-primary transition-colors">Direktori Wilayah</a>
                <span aria-hidden="true">•</span>
                <a href="{{ route('regional.province', $city['province_slug']) }}" class="hover:text-primary transition-colors">Provinsi {{ $city['province'] }}</a>
            </div>
        </div>
    </div>
</section>
@endsection