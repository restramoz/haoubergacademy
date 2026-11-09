@extends('layouts.app')

@section('title', $pageTitle ?? $program['meta_title'])
@section('meta_description', $pageDescription ?? $program['meta_description'])
@if(isset($region))
    @section('canonical_url', $region['canonicalUrl'])
@endif
@section('wa_message', $waMessage ?? $program['wa_message'])

@php
    $schemeService = app(\App\Services\SchemeService::class);

    // Map category to image file using the category metadata from SchemeService
    $categoryImages = [
        'Alat Berat, Crane & Rigging' => 'categories/alat-berat-crane-rigging.jpg',
        'Bisnis, Manajemen & Administrasi' => 'categories/bisnis-manajemen-administrasi.jpg',
        'Desain, Kreatif & Komunikasi' => 'categories/desain-kreatif-komunikasi.jpg',
        'Energi, Kimia & Proses' => 'categories/energi-kimia-proses.jpg',
        'Keamanan, Pengamanan & Tanggap Darurat' => 'categories/keamanan-pengamanan-tanggap-darurat.jpg',
        'Kecantikan, Spa & Kebugaran' => 'categories/kecantikan-spa-kebugaran.jpg',
        'Keselamatan Kerja (K3)' => 'categories/keselamatan-kerja-k3.jpg',
        'Keuangan, Perbankan & Asuransi' => 'categories/keuangan-perbankan-asuransi.jpg',
        'Konstruksi & Bangunan' => 'categories/konstruksi-bangunan.jpg',
        'Layanan Sosial & Umum' => 'categories/layanan-sosial-umum.jpg',
        'Lingkungan, Limbah & Pengolahan Air' => 'categories/lingkungan-limbah-pengolahan-air.jpg',
        'Listrik, Elektronika & Instrumentasi' => 'categories/listrik-elektronika-instrumentasi.jpg',
        'Manufaktur, Fabrikasi & Metalurgi' => 'categories/manufaktur-fabrikasi-metalurgi.jpg',
        'Pariwisata, Perhotelan & Kuliner' => 'categories/pariwisata-perhotelan-kuliner.jpg',
        'Pendidikan, Pelatihan & Sertifikasi' => 'categories/pendidikan-pelatihan-sertifikasi.jpg',
        'Pertambangan, Migas & Geologi' => 'categories/pertambangan-migas-geologi.jpg',
        'Pertanian, Perkebunan & Kehutanan' => 'categories/pertanian-perkebunan-kehutanan.jpg',
        'Peternakan, Perikanan & Kelautan' => 'categories/peternakan-perikanan-kelautan.jpg',
        'Teknis & Profesi Lainnya' => 'categories/teknis-profesi-lainnya.jpg',
        'Teknologi Informasi & Digital' => 'categories/teknologi-informasi-digital.jpg',
        'Transportasi, Logistik & Pengemudi' => 'categories/transportasi-logistik-pengemudi.jpg',
    ];

    $programCategory = $program['category_label'] ?? '';
    $programImage = $categoryImages[$programCategory] ?? 'HERO.jpg';
    $programImageAlt = $programCategory ? "Ilustrasi kategori {$programCategory}" : 'Houberg Academy';

    // Add image to other programs
    foreach ($otherPrograms as &$other) {
        $otherCat = $other['category_label'] ?? '';
        $other['image'] = $categoryImages[$otherCat] ?? 'HERO.jpg';
    }
@endphp

@section('content')
<!-- BREADCRUMB NAVIGATION -->
<div class="bg-sky-50 border-b border-border">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-3">
        @if(isset($region))
            <x-breadcrumb :items="[
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => $region['name'], 'url' => $region['landingUrl']],
                ['label' => $program['title'], 'url' => null],
            ]" />
        @else
            <x-breadcrumb :items="[
                ['label' => $program['category_label'] ?? 'Program', 'url' => route('home') . '#program'],
                ['label' => $program['title'], 'url' => null],
            ]" />
        @endif
    </div>
</div>

<!-- HERO SECTION -->
<section class="relative overflow-hidden" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);" aria-labelledby="program-hero-heading">
    <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="program-grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#FFFFFF" stroke-width="1" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#program-grid-pattern)" />
        </svg>
    </div>

    <div class="relative mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
        <div class="max-w-3xl">
            <!-- Program Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary/20 border border-primary/40 text-primary text-xs sm:text-sm font-semibold mb-5">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span>{{ isset($region) ? $region['name'] : $program['badge'] }}</span>
            </div>

            <!-- Main Heading -->
            <h1 id="program-hero-heading" class="font-heading font-extrabold tracking-tight text-white leading-tight text-3xl sm:text-4xl lg:text-5xl">
                @if(isset($region))
                    {{ $program['title'] }}
                @else
                    {{ $program['hero_heading'] }} <span class="text-primary">{{ $program['hero_highlight'] }}</span>
                @endif
            </h1>

            <!-- Subheading -->
            <p class="mt-5 text-body text-slate-300 leading-relaxed max-w-2xl">
                @if(isset($region))
                    Informasi {{ $program['title'] }} untuk {{ $region['name'] }}. Uraian layanan berikut tetap bersifat umum.
                @else
                    {{ $program['hero_subheading'] }}
                @endif
            </p>

            <!-- Action Buttons -->
            <div class="mt-7 flex flex-col sm:flex-row gap-3 sm:gap-4 w-full">
                <x-wa-cta variant="wa" size="lg" :message="$waMessage ?? $program['wa_message']" :label="'Konsultasi ' . explode('(', $program['title'])[0]" class="w-full sm:w-auto shadow-lg font-bold justify-center" />
                <x-button href="#informasi-program" variant="white" size="lg" class="w-full sm:w-auto">
                    Rincian &amp; Persyaratan
                </x-button>
            </div>

            <!-- Key Attributes Bar -->
            <div class="mt-8 pt-6 border-t border-navy-800 grid grid-cols-2 gap-4 sm:gap-6">
                <div class="min-w-0">
                    <div class="text-[10px] sm:text-xs font-heading font-semibold uppercase tracking-wider text-slate-400">Kategori</div>
                    <div class="text-base sm:text-lg font-heading font-extrabold text-primary mt-0.5 truncate">{{ $program['level'] }}</div>
                </div>
                <div class="min-w-0">
                    <div class="text-[10px] sm:text-xs font-heading font-semibold uppercase tracking-wider text-slate-400">Program</div>
                    <div class="text-base sm:text-lg font-heading font-extrabold text-white mt-0.5">{{ $program['category_label'] ?? 'Pelatihan & Sertifikasi' }}</div>
                </div>
                <div class="min-w-0">
                    <div class="text-[10px] sm:text-xs font-heading font-semibold uppercase tracking-wider text-slate-400">Sifat Program</div>
                    <div class="text-base sm:text-lg font-heading font-extrabold text-primary mt-0.5">Skema Kompetensi</div>
                </div>
                <div class="min-w-0">
                    <div class="text-[10px] sm:text-xs font-heading font-semibold uppercase tracking-wider text-slate-400">Penyelenggara</div>
                    <div class="text-base sm:text-lg font-heading font-extrabold text-white mt-0.5 truncate">{{ $program['lsp'] ?? 'Perlu konfirmasi' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: PENGENALAN & SASARAN PESERTA -->
<section id="pengenalan" class="section-py bg-white" aria-labelledby="pengenalan-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            <!-- Left: Intro Narrative -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2">
                    <span class="eyebrow">
                        Tujuan &amp; Ruang Lingkup
                    </span>
                </div>
                <img src="/images/{{ $programImage }}"
                     alt="{{ $programImageAlt }}"
                     width="900"
                     height="500"
                     loading="lazy"
                     decoding="async"
                     onerror="this.onerror=null;this.src='/images/HERO.jpg';"
                     class="w-full aspect-video max-h-[360px] object-cover object-center rounded-[1.5rem] shadow-card mb-6" />
                <h2 id="pengenalan-heading" class="font-heading font-extrabold text-navy-900 text-2xl sm:text-3xl tracking-tight">
                    Mengenal Lebih Dekat {{ $program['title'] }}
                </h2>
                <p class="text-body text-slate-600 leading-relaxed">
                    {{ $program['introduction'] }}
                </p>
                <div class="p-5 rounded-xl bg-sky-50 border border-border shadow-sm">
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-body-sm text-slate-600 leading-relaxed">
                            <span class="font-heading font-bold text-navy-900 block mb-0.5">Catatan Kepatuhan</span>
                            Program bersifat pembinaan kompetensi. Kewajiban regulasi keselamatan kerja di tempat kerja berlaku secara umum; rujukan regulasi spesifik dikonfirmasi kepada pihak yang berwenang tanpa ditegaskan di sini.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Target Audience Card -->
            <div class="lg:col-span-5">
                <div class="bg-sky-50 rounded-[1.5rem] border border-border p-6 sm:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading font-bold text-navy-900 text-lg">Sasaran &amp; Sektor Terkait</h3>
                            <p class="text-body-sm text-slate-500">Profil yang relevan untuk program ini</p>
                        </div>
                    </div>

                    <ul class="space-y-3.5" role="list">
                        @foreach ($program['target_audience'] as $audience)
                            <li class="flex items-start gap-3 text-body-sm text-slate-600">
                                <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $audience }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-6 pt-6 border-t border-border">
                        <x-wa-cta variant="outline" size="sm" :message="$waMessage ?? $program['wa_message']" label="Konsultasikan Kebutuhan Anda" class="w-full justify-center" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: RUANG LINGKUP & TANGGUNG JAWAB -->
<section id="tanggung-jawab" class="section-py bg-sky-50" aria-labelledby="tanggung-jawab-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl mb-12">
            <span class="eyebrow">
                Ruang Lingkup Teknis
            </span>
            <h2 id="tanggung-jawab-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Kompetensi &amp; Output Kerja
            </h2>
            <p class="mt-4 text-body text-slate-600 leading-relaxed">
                Gambaran komprehensif mengenai ruang lingkup pelaksanaan teknis dan kepatuhan yang dihasilkan melalui program {{ $program['title'] }}.
            </p>
        </div>

        <!-- Deliverables Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($program['roles_and_responsibilities'] as $index => $item)
                <div class="flex flex-col bg-white rounded-[1.5rem] border border-border p-6 shadow-sm hover:shadow-card transition">
                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-heading font-bold text-sm mb-4">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="font-heading font-bold text-navy-900 text-base mb-2">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-body-sm text-slate-600 leading-relaxed flex-1">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Regulatory Advisory Note -->
        <div class="mt-10 p-6 rounded-[1.5rem] bg-white border border-border shadow-sm text-slate-600">
            <div class="flex items-start gap-3.5">
                <svg class="w-6 h-6 text-primary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="text-body-sm space-y-1">
                    <h4 class="font-heading font-bold text-navy-900">Perhatian: Persyaratan Program</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Persyaratan peserta dan dokumen dapat berbeda menurut program dan penyelenggara. Periksa ketentuan yang berlaku untuk program yang diminati sebelum mendaftar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: INFORMASI PELAKSANAAN & TRANSPARANSI DATA -->
<section id="informasi-program" class="section-py bg-white" aria-labelledby="informasi-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl mb-12">
            <span class="eyebrow">
                Transparansi Layanan
            </span>
            <h2 id="informasi-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Informasi Penyelenggaraan &amp; Pelaksanaan
            </h2>
            <p class="mt-4 text-body text-slate-600 leading-relaxed">
                Informasi jadwal, biaya, dan penyelenggaraan tidak dirinci dalam katalog ini. Silakan konsultasikan program yang diminati untuk menanyakan rincian lebih lanjut.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Verified Parameters Grid -->
            <div class="lg:col-span-7 space-y-4">
                <div class="bg-white rounded-[1.5rem] border border-border overflow-hidden shadow-sm divide-y divide-border">
                    @foreach ($program['training_info'] as $key => $info)
                        <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                            <div class="sm:w-1/3">
                                <span class="text-xs font-heading font-bold uppercase tracking-wider text-navy-900 block mb-1">
                                    {{ $info['label'] }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-sky-50 text-slate-600 border border-border">
                                    {{ $info['status'] }}
                                </span>
                            </div>
                            <div class="sm:w-2/3">
                                <p class="text-body-sm text-slate-600 leading-relaxed">
                                    {{ $info['detail'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Transparency Disclaimer Card -->
                <div class="p-5 rounded-xl bg-sky-50 border border-border text-body-sm text-slate-600 leading-relaxed space-y-2">
                    <div class="flex items-center gap-2 font-heading font-bold text-navy-900 text-sm">
                        <svg class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Komitmen Keterbukaan Informasi Kami</span>
                    </div>
                    <p>
                        Rincian biaya, persyaratan, dan silabus dapat berbeda untuk tiap program. Silakan konsultasikan program yang diminati untuk memperoleh informasi yang tersedia.
                    </p>
                </div>
            </div>

            <!-- Right: Competency Topics Preview & CTA Card -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-sky-50 rounded-[1.5rem] border border-border p-6 sm:p-8 shadow-sm">
                    <h3 class="font-heading font-bold text-navy-900 text-lg mb-2">
                        Pokok Materi &amp; Tahapan Kerja
                    </h3>
                    <p class="text-body-sm text-slate-500 mb-5 leading-relaxed">
                        Cakupan materi mengacu pada struktur skema kompetensi yang tersedia:
                    </p>

                    @if (!empty($program['curriculum_topics']))
                        <ul class="space-y-3 mb-6" role="list">
                            @foreach ($program['curriculum_topics'] as $topic)
                                <li class="flex items-start gap-2.5 text-body-sm text-slate-600">
                                    <svg class="w-4 h-4 text-primary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span>{{ $topic }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-6 text-body-sm text-slate-600 leading-relaxed">
                            Materi detail ditetapkan berdasarkan kebutuhan pelatihan yang dipilih. Rincian topik, durasi, dan modul dikonfirmasi saat konsultasi.
                        </p>
                    @endif

                    <div class="pt-5 border-t border-border">
                        <x-wa-cta variant="filled" size="md" :message="$waMessage ?? $program['wa_message']" label="Tanya Program via WhatsApp →" class="w-full justify-center font-bold" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: LAYANAN TERKAIT LAINNYA -->
@if(!empty($otherPrograms))
<section id="program-lain" class="section-py bg-sky-50" aria-labelledby="program-lain-heading">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header text-center max-w-3xl mx-auto mb-12">
            <span class="eyebrow">
                Program Terkait
            </span>
            <h2 id="program-lain-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Program Terkait Lainnya
            </h2>
            <p class="mt-4 text-body text-slate-600">
                Bandingkan program pembelajaran lainnya untuk menemukan yang paling sesuai dengan kebutuhan Anda.
            </p>
        </div>

        <!-- Other Programs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach (array_slice($otherPrograms, 0, 3) as $other)
                <article class="category-card group">
                    <!-- Category Image -->
                    <div class="relative overflow-hidden">
                        <img src="/images/{{ $other['image'] }}"
                             alt="{{ $other['title'] }}"
                             width="800"
                             height="500"
                             loading="lazy"
                             decoding="async"
                             onerror="this.onerror=null;this.src='/images/HERO.jpg';"
                             class="card-image transition-transform duration-500 group-hover:scale-105" />

                        <!-- Teal circular badge overlapping bottom-left of image -->
                        <div class="absolute bottom-4 left-4">
                            <span class="inline-flex items-center justify-center rounded-full bg-primary text-white shadow-lg"
                                  style="width: 3rem; height: 3rem;"
                                  aria-hidden="true">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <path d="M13 5l7 7-7 7M5 12h14" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-50 border border-border text-primary text-xs font-heading font-bold w-fit mb-4">
                            <span>{{ $other['level'] }}</span>
                        </div>
                        <h3 class="font-heading font-bold text-navy-900 text-lg mb-2">
                            {{ $other['title'] }}
                        </h3>
                        <p class="text-body-sm text-slate-600 leading-relaxed mb-6 flex-1">
                            {{ Str::limit($other['introduction'], 120) }}
                        </p>
                        @php
                            $detailUrl = isset($region)
                                ? (request()->routeIs('province.program.detail')
                                    ? route('province.program.detail', ['region' => $region['slug'], 'program' => $other['slug']])
                                    : route('region.program.detail', ['region' => $region['slug'], 'program' => $other['slug']]))
                                : route('program.show', $other['slug']);
                        @endphp
                        <a href="{{ $detailUrl }}"
                           class="inline-flex items-center gap-1.5 text-body-sm font-semibold text-primary hover:text-primary-dark transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded"
                           aria-label="Lihat detail {{ $other['title'] }}">
                            Lihat detail
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 12h14"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(isset($region) && isset($articles) && $articles->isNotEmpty())
    <section class="border-b border-border bg-sky-50 section-py" aria-labelledby="service-articles-heading">
        <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
            <h2 id="service-articles-heading" class="font-heading font-bold text-navy-900 text-2xl mb-6">
                Artikel terkait {{ $program['title'] }}
            </h2>
            <p class="mt-2 text-body-sm text-slate-600">Artikel umum untuk program ini, dapat dibaca dari halaman wilayah mana pun.</p>
            <div class="mt-7 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach($articles as $article)
                    <article class="article-card group flex flex-col">
                        <div class="relative aspect-[16/9] overflow-hidden">
                            @if($article->featured_image)
                                <img src="/{{ ltrim($article->featured_image, '/') }}"
                                     alt="{{ $article->title }}"
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
                            <h3 class="font-heading font-bold text-navy-900 text-base leading-snug flex-1">
                                <a href="{{ route('articles.show', $article->slug) }}"
                                   class="transition-colors hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            @if($article->excerpt)
                                <p class="mt-2 text-body-sm text-slate-600 line-clamp-3">{{ $article->excerpt }}</p>
                            @endif
                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="mt-4 inline-flex items-center text-body-sm font-bold text-primary hover:text-primary-dark">
                                Baca
                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- SECTION 5: FAQ KHUSUS PROGRAM -->
<section id="faq" class="section-py bg-white" aria-labelledby="faq-heading">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="section-header text-center max-w-2xl mx-auto mb-12">
            <span class="eyebrow">
                Tanya Jawab
            </span>
            <h2 id="faq-heading" class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Pertanyaan Umum Seputar {{ $program['title'] }}
            </h2>
            <p class="mt-4 text-body text-slate-600">
                Jawaban faktual untuk pertanyaan yang sering diajukan mengenai program ini.
            </p>
        </div>

        <div class="space-y-4">
            @foreach ($program['faqs'] as $index => $faq)
                <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                    <summary class="flex items-center justify-between gap-4 font-heading font-semibold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                        <span>{{ $faq['question'] }}</span>
                        <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">
                        {{ $faq['answer'] }}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 6: FINAL CONVERSION & KONSULTASI -->
<section id="konsultasi" class="section-py relative overflow-hidden" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);" aria-labelledby="konsultasi-heading">
    <!-- Background image -->
    <img src="/images/KONSULTASI PROGRAM.jpg"
         alt="Konsultasi Program"
         class="absolute inset-0 w-full h-full object-cover opacity-10" aria-hidden="true" />

    <div class="relative mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
            <span class="eyebrow inline-block">
                Layanan Konsultasi Responsif
            </span>
            <h2 id="konsultasi-heading" class="mt-3 font-heading font-extrabold text-white text-2xl sm:text-3xl lg:text-4xl leading-tight">
                Konsultasikan Program <span class="text-primary">{{ $program['title'] }}</span> Anda
            </h2>
            <p class="mt-4 text-body text-slate-300 leading-relaxed">
                Konsultasikan informasi lebih lanjut mengenai program dan rincian penyelenggaraannya.
            </p>

            <div class="mt-7 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 w-full">
                <x-wa-cta variant="wa" size="lg" :message="$waMessage ?? $program['wa_message']" label="Tanyakan Program" class="w-full sm:w-auto shadow-lg font-bold justify-center" />
                <x-button :href="route('home')" variant="white" size="lg" class="w-full sm:w-auto">
                    Kembali ke Beranda
                </x-button>
            </div>
        </div>
    </div>
</section>
@endsection