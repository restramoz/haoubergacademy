@extends('layouts.app')

@section('title', 'Program di Provinsi ' . $province['name'] . ' - Houberg Academy')
@section('meta_description', 'Informasi katalog program pembelajaran dengan konteks Provinsi ' . $province['name'] . '. Telusuri 120+ program di 6 kategori. Konsultasi gratis via WhatsApp.')
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

<!-- Breadcrumb -->
<div class="bg-sky-50 border-b border-border">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-3">
        <x-breadcrumb :items="[
            ['label' => 'Wilayah', 'url' => route('home') . '#wilayah'],
            ['label' => $province['name'], 'url' => null],
        ]" />
    </div>
</div>

<!-- Hero -->
<section class="relative overflow-hidden section-py" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);">
    <div class="absolute inset-0 opacity-10" aria-hidden="true">
        <div class="absolute -top-24 right-0 h-72 w-72 rounded-full bg-primary/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-primary/10 blur-3xl"></div>
        <!-- Background image -->
        <img src="/images/WILAYAH INDONESIA.jpg"
             alt="Peta wilayah Indonesia"
             class="absolute inset-0 w-full h-full object-cover opacity-5" />
    </div>

    <div class="relative mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="grid lg:grid-cols-12 gap-10 items-end">

            <div class="lg:col-span-8">
                <span class="eyebrow inline-flex items-center gap-2">
                    <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                    Wilayah
                </span>
                <h1 class="mt-4 font-heading font-extrabold tracking-tight text-white text-4xl sm:text-5xl lg:text-6xl leading-tight">
                    Program di <span class="text-primary">Provinsi {{ $province['name'] }}</span>
                </h1>
                <p class="mt-5 text-body text-slate-300 leading-relaxed max-w-2xl">
                    Halaman ini menyediakan informasi katalog program dengan konteks regional.
                    Nama wilayah ini tidak menyatakan adanya kantor atau penyelenggaraan setempat.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <x-wa-cta variant="wa" size="lg" :message="$waMessage" label="Konsultasi Provinsi {{ $province['name'] }}" class="min-h-[48px] px-7 rounded-xl font-bold shadow-lg justify-center" />
                    <x-button href="#program" variant="white" size="lg" class="min-h-[48px] px-7 rounded-xl">
                        Lihat Program →
                    </x-button>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white/5 border border-white/10 rounded-[1.5rem] p-6 backdrop-blur">
                    <dl class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-body-sm text-slate-400">Pulau</dt>
                            <dd class="mt-1 font-heading font-bold text-white">{{ $province['island'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-body-sm text-slate-400">Kab/Kota</dt>
                            <dd class="mt-1 font-heading font-bold text-white">{{ $province['total_cities'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-body-sm text-slate-400">Program</dt>
                            <dd class="mt-1 font-heading font-bold text-white">{{ count($programs) }}</dd>
                        </div>
                        <div>
                            <dt class="text-body-sm text-slate-400">Lingkup</dt>
                            <dd class="mt-1 font-heading font-bold text-primary">Houberg Academy</dd>
                        </div>
                    </dl>
                </div>
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
                <strong class="text-amber-900">Catatan penting:</strong> halaman ini adalah portal informasi dan konsultasi program. Detail pelatihan, jadwal, dan persyaratan administrasi dapat ditanyakan melalui WhatsApp.
            </p>
        </div>
    </div>
</section>

<!-- Service Catalog -->
@include('components.service-catalog', ['catalogContext' => 'regional', 'catalogGeographicSlug' => $province['slug']])

<!-- Proses & Syarat Umum -->
<section class="section-py bg-sky-50">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Proses & Syarat
            </span>
            <h2 class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Proses &amp; Syarat Umum
            </h2>
            <p class="mt-4 text-body text-slate-600 leading-relaxed max-w-3xl">
                Untuk mengetahui proses, persyaratan, materi, dan informasi program secara lengkap, silakan lihat halaman program terkait atau hubungi Houberg Academy melalui kanal resmi.
            </p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 max-w-4xl">
                <div class="rounded-xl border border-border bg-white p-5">
                    <h3 class="font-heading font-bold text-navy-900 mb-2">Rincian program</h3>
                    <p class="text-body-sm text-slate-600 leading-relaxed">Rincian proses, persyaratan, dan materi setiap program dapat dilihat pada halaman program terkait.</p>
                </div>
                <div class="rounded-xl border border-border bg-white p-5">
                    <h3 class="font-heading font-bold text-navy-900 mb-2">Konsultasi</h3>
                    <p class="text-body-sm text-slate-600 leading-relaxed">Untuk rincian lebih lanjut, hubungi Houberg Academy melalui kanal resmi. Tautan WhatsApp tersedia pada halaman ini dan di halaman program.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pertanyaan Umum -->
<section class="section-py bg-white">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Tanya Jawab
            </span>
            <h2 class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Pertanyaan Umum
            </h2>
        </div>
        <div class="mt-8 space-y-3 max-w-4xl">
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Bagaimana cara mendapatkan informasi program di Provinsi {{ $province['name'] }}?</span>
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
            <details class="group bg-white border border-border rounded-xl p-5 open:border-primary shadow-sm">
                <summary class="flex items-center justify-between font-bold text-navy-900 cursor-pointer list-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                    <span>Apakah halaman regional menyatakan kantor setempat?</span>
                    <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <p class="mt-4 pt-4 border-t border-border text-body text-slate-600 leading-relaxed">Tidak. Halaman regional adalah konteks informasi, bukan penunjukan kantor setempat.</p>
            </details>
        </div>
    </div>
</section>

<!-- Related Cities -->
<section class="section-py bg-white">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header max-w-3xl mb-8">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Wilayah Terkait
            </span>
            <h2 class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-2xl sm:text-3xl">
                Kota &amp; Kabupaten di Provinsi {{ $province['name'] }}
            </h2>
        </div>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach(($province['cities'] ?? []) as $cityItem)
                <a href="{{ route('regional.city', $cityItem['slug']) }}" class="rounded-xl border border-border bg-white px-4 py-3 text-body font-semibold text-slate-700 hover:border-primary hover:text-primary transition">
                    {{ $cityItem['name'] }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="section-py" style="background: linear-gradient(180deg, #0E1B2C 0%, #0B1F33 100%);">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading font-extrabold tracking-tight text-white text-3xl sm:text-4xl">
            Butuh rincian program di {{ $province['name'] }}?
        </h2>
        <p class="mt-4 text-body text-slate-300 leading-relaxed">Sampaikan kebutuhan Anda melalui WhatsApp. Tim Houberg Academy akan membantu memilih program yang sesuai.</p>
        <div class="mt-8 flex justify-center">
            <x-wa-cta variant="wa" size="lg" :message="$waMessage" label="Konsultasi via WhatsApp" class="min-h-[52px] px-8 rounded-xl font-black shadow-lg justify-center" />
        </div>
    </div>
</section>
@endsection