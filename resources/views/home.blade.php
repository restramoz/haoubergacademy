@extends('layouts.app')

@section('title', 'Houberg Academy - Learning & Development')

@section('meta_description', 'Houberg Academy adalah platform Learning & Development untuk pengembangan kompetensi profesional. Jelajahi 4.177+ program di 21 kategori, tersedia di 38 provinsi. Konsultasi gratis via WhatsApp.')

@section('content')
@php
    $regionalService = resolve(\App\Services\RegionalService::class);
    $provinces = $regionalService->getAllProvinces();

    $schemeService = app(\App\Services\SchemeService::class);
    $allPrograms = $schemeService->all();

    /*
     * Kelompokkan berdasarkan kategori resmi dari SchemeService.
     * Menggunakan metadata representatif untuk setiap 21 kategori.
     */
    $categories = collect($allPrograms)
        ->groupBy(fn ($item) => $item['category_label'] ?? 'Layanan Lainnya')
        ->map(function ($items, $categoryName) use ($schemeService) {
            $slug = \Illuminate\Support\Str::slug($categoryName);
            return [
                'name' => $categoryName,
                'slug' => $slug,
                'items' => $items,
                'count' => $items->count(),
                'meta' => $schemeService::categoryMetadata($categoryName),
            ];
        })
        ->sortBy('name')
        ->values();

    $totalServices = count($allPrograms);
    $totalCategories = $categories->count();

    // Query artikel terpublikasi asli dari database
    $latestArticles = $latestArticles ?? (
        \Illuminate\Support\Facades\Schema::hasTable('articles')
            ? \App\Models\Article::published()->orderBy('published_at', 'desc')->take(3)->get()
            : collect()
    );

    $waPhone = \App\Support\WhatsApp::normalizePhone(config('services.whatsapp.phone'));
@endphp

{{-- =========================================================
     A. HERO SECTION
========================================================= --}}
<section id="home"
         class="relative overflow-hidden"
         style="background: linear-gradient(180deg, #F3F8FA 0%, #FFFFFF 100%);"
         aria-labelledby="hero-heading">

    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-12 lg:gap-12 xl:gap-16 py-16 sm:py-20 lg:py-24 xl:py-28">

            <!-- Hero Text Content -->
            <div class="flex flex-col justify-center lg:col-span-7">

                <!-- Eyebrow -->
                <span class="inline-flex self-start items-center gap-2 font-heading font-extrabold uppercase tracking-[0.16em] text-primary text-sm sm:text-base">
                    HOUBERG ACADEMY
                </span>

                <!-- H1: Navy + Teal highlight -->
                <h1 id="hero-heading"
                    class="mt-4 font-heading font-extrabold leading-[1.1] tracking-tight text-navy-900 text-4xl sm:text-5xl lg:text-6xl xl:text-7xl">
                    Belajar lebih terarah.
                    <span class="block text-primary">Tumbuh lebih cepat.</span>
                </h1>

                <!-- Description -->
                <p class="mt-6 max-w-2xl text-body text-slate-600 leading-relaxed">
                    Houberg Academy menyediakan akses terarah ke {{ number_format($totalServices, 0, ',', '.') }}+ program pembelajaran di {{ $totalCategories }} kategori.
                    Temukan jalur pengembangan kompetensi yang sesuai dengan tujuan karir Anda.
                </p>

                <!-- Hero Actions -->
                <div class="mt-8 flex flex-col gap-3.5 sm:flex-row">
                    <x-button href="#program" variant="filled" size="lg" class="w-full sm:w-auto">
                        Jelajahi Program →
                    </x-button>
                    <x-button href="#tentang" variant="outline" size="lg" class="w-full sm:w-auto">
                        Kenali Houberg Academy
                    </x-button>
                </div>

                <!-- Hero Statistics -->
                <div class="mt-10 grid grid-cols-3 gap-6 sm:gap-8">
                    <div class="stat-item border-r border-border last:border-r-0">
                        <p class="stat-value text-primary">{{ number_format($totalServices, 0, ',', '.') }}<span class="text-h3 font-semibold text-slate-500">+</span></p>
                        <p class="stat-label">Program</p>
                    </div>
                    <div class="stat-item border-r border-border last:border-r-0">
                        <p class="stat-value text-primary">{{ $totalCategories }}</p>
                        <p class="stat-label">Kategori Program</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-value text-primary">{{ count($provinces) }}</p>
                        <p class="stat-label">Provinsi</p>
                    </div>
                </div>
            </div>

            <!-- Hero Photography Visual -->
            <div class="relative lg:col-span-5">
                <div class="relative overflow-hidden rounded-[1.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)]">
                    <img src="/images/HERO.jpg"
                         alt="Houberg Academy - Learning &amp; Development"
                         width="1200"
                         height="900"
                         loading="eager"
                         fetchpriority="high"
                         decoding="async"
                         onerror="this.onerror=null;this.src='/images/home/hero-industrial.jpg';"
                         class="w-full aspect-[4/3] object-cover" />

                    <!-- White fade on left side -->
                    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/50 to-transparent pointer-events-none" aria-hidden="true"></div>

                    <!-- Teal diagonal triangle at top-right -->
                    <div class="absolute top-0 right-0 w-48 h-48 bg-primary transform rotate-45 translate-x-1/2 -translate-y-1/2 pointer-events-none" aria-hidden="true"></div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================
     B. SERVICE CATEGORY CATALOG (MAIN PRIORITY)
     Reference implementation: Canonical 21 categories from SchemeService
========================================================= --}}
@include('components.service-catalog', ['catalogContext' => 'general'])


{{-- =========================================================
     C. TENTANG HOUBERG ACADEMY
========================================================= --}}
<section id="tentang"
         class="section-py bg-white"
         aria-labelledby="tentang-heading">

    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-12 gap-12 items-center">

            <!-- Left: Building Image (bleed left) -->
            <div class="lg:col-span-6 relative -ml-4 sm:ml-0 lg:-ml-8">
                <div class="relative aspect-[3/4] overflow-hidden rounded-[1.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.15)]">
                    <img src="/images/ABOUT HOUBERG ACADEMY.jpg"
                         alt="Gedung Houberg Academy"
                         width="1000"
                         height="1300"
                         loading="lazy"
                         decoding="async"
                         class="w-full h-full object-cover" />
                </div>
            </div>

            <!-- Right: Content -->
            <div class="lg:col-span-6">
                <div class="section-header max-w-xl">
                    <span class="eyebrow inline-flex items-center gap-2">
                        <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                        Tentang Kami
                    </span>
                    <h2 id="tentang-heading"
                        class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-3xl sm:text-4xl">
                        Tempat untuk memperluas kemampuan dengan cara yang praktis.
                    </h2>
                    <p class="mt-4 text-body text-slate-600 leading-relaxed">
                        Houberg Academy hadir sebagai mitra Learning &amp; Development yang memahami kebutuhan pengembangan kompetensi profesional. Kami menyediakan akses ke program-program berkualitas dari berbagai bidang, dengan pendekatan yang fleksibel dan terarah.
                    </p>
                </div>

                <!-- 4 Steps - Responsive: Stack on Mobile, Horizontal on Desktop -->
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $steps = [
                            ['num' => '01', 'title' => 'Eksplorasi', 'desc' => 'Telusuri katalog program sesuai minat dan kebutuhan Anda.', 'image' => 'LEARNING APPROACH EKSPLORASI.jpg'],
                            ['num' => '02', 'title' => 'Pelajari', 'desc' => 'Pelajari detail kurikulum, durasi, dan hasil pembelajaran.', 'image' => 'LEARNING APPROACH PELAJARI.jpg'],
                            ['num' => '03', 'title' => 'Tentukan Langkah', 'desc' => 'Konsultasikan dengan tim kami untuk menentukan program terbaik.', 'image' => 'LEARNING APPROACH TENTUKAN LANGKAH.jpg'],
                            ['num' => '04', 'title' => 'Berkembang', 'desc' => 'Terapkan kompetensi baru dan lihat dampaknya pada karir Anda.', 'image' => 'LEARNING APPROACH BERKEMBANG.jpg'],
                        ];
                    @endphp
                    @foreach ($steps as $index => $step)
                        <div class="step-item" style="--step-index: {{ $index + 1 }};">
                            <div class="relative aspect-[4/3] overflow-hidden rounded-xl mb-3">
                                <img src="/images/{{ $step['image'] }}"
                                     alt="{{ $step['title'] }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-cover" />
                            </div>
                            <div class="step-number">{{ $step['num'] }}</div>
                            <h4 class="step-title">{{ $step['title'] }}</h4>
                            <p class="step-desc">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- =========================================================
     D. DIREKTORI WILAYAH
     Reference implementation: 38 Provinces from RegionalService
========================================================= --}}
<section id="wilayah"
         class="section-py bg-sky-50 border-t border-border"
         aria-labelledby="wilayah-heading">

    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">

        <div class="max-w-2xl">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Direktori Wilayah
            </span>

            <h2 id="wilayah-heading"
                class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-3xl sm:text-4xl">
                Temukan Program di Provinsi Anda
            </h2>

            <p class="mt-4 text-body text-slate-600 leading-relaxed">
                Jelajahi ketersediaan informasi wilayah berdasarkan {{ count($provinces) }} provinsi di Indonesia untuk menemukan informasi program dan kota mitra.
            </p>

            <p class="mt-2 text-sm font-bold text-primary">
                {{ count($provinces) }} provinsi tersedia dalam direktori wilayah Houberg Academy.
            </p>
        </div>

        <!-- Provinces Grid -->
        <div id="wilayah-grid"
             data-show-group
             class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">

            @foreach ($provinces as $prov)
                <a href="{{ route('regional.province', $prov['slug']) }}"
                   class="rounded-xl border border-border bg-white px-4 py-3.5 shadow-sm transition hover:border-primary hover:bg-mint-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary {{ $loop->index >= 12 ? 'scheme-extra' : '' }}"
                   @if ($loop->index >= 12) hidden @endif>
                    <span class="block truncate text-xs font-bold text-navy-900 sm:text-sm">
                        {{ $prov['name'] }}
                    </span>
                </a>
            @endforeach

        </div>

        @if (count($provinces) > 12)
            <div class="mt-8 text-center sm:text-left">
                <button type="button"
                        class="js-show-all inline-flex min-h-[44px] items-center justify-center rounded-xl border border-primary bg-white px-5 py-3 text-sm font-bold text-primary transition hover:bg-primary hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                        data-all-label="Lihat Semua {{ count($provinces) }} Provinsi"
                        data-less-label="Tampilkan Lebih Sedikit"
                        aria-expanded="false"
                        aria-controls="wilayah-grid">
                    Lihat Semua {{ count($provinces) }} Provinsi
                </button>
            </div>
        @endif

    </div>
</section>


{{-- =========================================================
     E. INSIGHTS & ARTIKEL (EDITORIAL HIGHLIGHT)
     Visually distinct editorial cards communicating "CONTENT / INSIGHTS"
========================================================= --}}
<section id="artikel"
         class="section-py bg-white border-t border-border relative overflow-hidden"
         aria-labelledby="artikel-heading">

    <!-- Ambient background pattern -->
    <div class="pointer-events-none absolute -right-20 -top-20 h-72 w-72 rounded-full bg-mint-50/50 blur-3xl" aria-hidden="true"></div>

    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mb-10 sm:mb-12">
            <div class="max-w-2xl">
                <span class="eyebrow inline-flex items-center gap-2">
                    <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                    Insights &amp; Wawasan
                </span>

                <h2 id="artikel-heading"
                    class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-3xl sm:text-4xl">
                    Wawasan Terbaru untuk Pengembangan Karir
                </h2>

                <p class="mt-4 text-body text-slate-600 leading-relaxed">
                    Artikel mendalam, panduan praktis, dan referensi industri untuk mendukung langkah pembelajaran Anda.
                </p>
            </div>

            <div class="shrink-0">
                <x-button href="{{ route('articles.index') }}" variant="outline" size="md">
                    Lihat Semua Artikel →
                </x-button>
            </div>
        </div>

        <!-- Distinct Editorial Article Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse ($latestArticles as $article)
                @php
                    $articleImage = null;
                    if ($article->featured_image) {
                        $trimmed = ltrim($article->featured_image, '/');
                        if (file_exists(public_path($trimmed))) {
                            $articleImage = asset($trimmed);
                        } elseif (file_exists(public_path('storage/' . $trimmed))) {
                            $articleImage = asset('storage/' . $trimmed);
                        } else {
                            $articleImage = '/' . $trimmed;
                        }
                    }
                    $displayImage = $articleImage ?: '/images/INSIGHTS ARTIKEL.jpg';
                @endphp

                <article class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary/50">

                    <!-- Editorial 16:9 Thumbnail -->
                    <div class="relative aspect-[16/9] overflow-hidden bg-slate-100">
                        <img src="{{ $displayImage }}"
                             alt="Ilustrasi artikel: {{ $article->title }}"
                             width="600"
                             height="338"
                             loading="lazy"
                             decoding="async"
                             onerror="this.onerror=null;this.src='/images/INSIGHTS ARTIKEL.jpg';"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />

                        <div class="absolute top-3.5 left-3.5">
                            <span class="inline-flex items-center rounded-full bg-white/90 backdrop-blur-sm px-3 py-1 text-[11px] font-extrabold uppercase tracking-wider text-primary shadow-sm border border-border">
                                @if ($article->target_city_slug)
                                    {{ ucwords(str_replace('-', ' ', $article->target_city_slug)) }}
                                @else
                                    Houberg Insights
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Editorial Body -->
                    <div class="flex flex-1 flex-col p-6">

                        <h3 class="font-heading font-bold text-navy-900 text-lg sm:text-xl leading-snug line-clamp-2">
                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="transition-colors hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                                {{ $article->title }}
                            </a>
                        </h3>

                        <p class="mt-3 text-body-sm text-slate-600 line-clamp-3 leading-relaxed flex-1">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 130) }}
                        </p>

                        <!-- Editorial Meta Footer -->
                        <div class="mt-6 pt-4 border-t border-border flex items-center justify-between text-xs">
                            @if ($article->published_at)
                                <time datetime="{{ $article->published_at->toDateString() }}"
                                      class="font-medium text-slate-500">
                                    {{ $article->published_at->translatedFormat('d F Y') }}
                                </time>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif

                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors"
                               aria-label="Baca selengkapnya artikel {{ $article->title }}">
                                Baca Selengkapnya
                                <span class="ml-1" aria-hidden="true">&rarr;</span>
                            </a>
                        </div>

                    </div>

                </article>

            @empty

                <div class="rounded-2xl border border-border bg-white p-8 text-center sm:col-span-2 lg:col-span-3">
                    <p class="font-bold text-navy-900">
                        Belum ada artikel terpublikasi.
                    </p>
                    <p class="mt-2 text-sm text-slate-600">
                        Informasi dan panduan terbaru akan ditampilkan di bagian ini setelah tersedia.
                    </p>
                </div>

            @endforelse
        </div>

    </div>
</section>


{{-- =========================================================
     F. CTA BAND (FINAL CALL TO ACTION)
========================================================= --}}
<section id="cta"
         class="relative overflow-hidden cta-band section-py"
         aria-labelledby="cta-heading">

    <!-- Background image -->
    <img src="/images/FINAL CTA.jpg"
         alt="Houberg Academy"
         class="absolute inset-0 w-full h-full object-cover opacity-10" aria-hidden="true" />

    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="cta-content text-center max-w-3xl mx-auto relative z-10">

            <span class="eyebrow inline-flex items-center gap-2 mx-auto">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                MULAI DARI SINI
            </span>

            <h2 id="cta-heading"
                class="mt-4 font-heading font-extrabold tracking-tight text-white text-3xl sm:text-4xl lg:text-5xl">
                Siap menentukan langkah belajar berikutnya?
            </h2>

            <p class="mt-4 mx-auto max-w-xl text-body text-slate-300 leading-relaxed">
                Konsultasikan tujuan pengembangan karir Anda dengan tim Houberg Academy.
                Kami akan membantu menemukan program yang paling sesuai.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <x-wa-cta variant="wa" size="lg" label="Konsultasi via WhatsApp" class="w-full sm:w-auto justify-center font-bold" />
                <x-button href="#program" variant="white" size="lg" class="w-full sm:w-auto">
                    Jelajahi Program →
                </x-button>
            </div>
        </div>
    </div>
</section>
@endsection
