@extends('layouts.app')

@section('title', 'Insights & Artikel - Houberg Academy')

@section('meta_description', 'Artikel, panduan, dan wawasan terbaru seputar pengembangan kompetensi profesional, Learning & Development, dan program pembelajaran di Houberg Academy.')

@section('canonical_url', $canonicalUrl)

@section('content')
<!-- Page Header -->
<section class="section-py-sm bg-sky-50">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <div class="section-header text-center max-w-3xl mx-auto">
            <span class="eyebrow inline-flex items-center gap-2">
                <span class="h-1.5 w-6 rounded-full bg-primary"></span>
                Insights
            </span>
            <h1 class="mt-3 font-heading font-extrabold tracking-tight text-navy-900 text-3xl sm:text-4xl lg:text-5xl">
                Wawasan &amp; Artikel Terbaru
            </h1>
            <p class="mt-4 text-body text-slate-600 leading-relaxed">
                Artikel, panduan, dan referensi seputar pengembangan kompetensi profesional,
                Learning & Development, dan program pembelajaran di Houberg Academy.
            </p>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="section-py bg-white">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">

        @if($articles->isEmpty())
            <div class="rounded-[1.5rem] border-2 border-dashed border-border bg-white p-12 text-center">
                <p class="font-heading font-bold text-navy-900 text-xl">Belum ada artikel yang diterbitkan.</p>
                <p class="mt-2 text-body text-slate-600">Artikel dan panduan terbaru akan segera hadir.</p>
            </div>
        @else
            @php $first = $articles->first(); $rest = $articles->skip(1); @endphp

            <!-- Featured Article -->
            <article class="article-card group grid lg:grid-cols-12 gap-0 mb-12 overflow-hidden">
                @if($first->featured_image)
                    <div class="lg:col-span-5 relative aspect-[4/3] overflow-hidden">
                        <img src="/{{ ltrim($first->featured_image, '/') }}"
                             alt="{{ $first->title }}"
                             loading="eager"
                             fetchpriority="high"
                             decoding="async"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                @else
                    <div class="lg:col-span-5 relative aspect-[4/3] overflow-hidden">
                        <img src="/images/INSIGHTS ARTIKEL.jpg"
                             alt="{{ $first->title }}"
                             loading="eager"
                             fetchpriority="high"
                             decoding="async"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                @endif
                <div class="lg:col-span-7 p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="self-start rounded-full bg-mint-50 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-primary">
                            Houberg Academy
                        </span>
                        <time datetime="{{ ($first->published_at ?? $first->created_at)->toDateString() }}"
                              class="text-body-sm text-slate-500">
                            {{ ($first->published_at ?? $first->created_at)->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <h2 class="font-heading font-bold text-navy-900 text-2xl sm:text-3xl lg:text-4xl leading-snug">
                        <a href="{{ route('articles.show', $first->slug) }}"
                           class="transition-colors hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                            {{ $first->title }}
                        </a>
                    </h2>
                    @if($first->excerpt)
                        <p class="mt-4 text-body text-slate-600 leading-relaxed">{{ $first->excerpt }}</p>
                    @endif
                    <a href="{{ route('articles.show', $first->slug) }}"
                       class="mt-6 inline-flex items-center text-body font-bold text-primary hover:text-primary-dark">
                        Baca selengkapnya
                        <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Other Articles Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($rest as $article)
                    <article class="article-card group flex flex-col">
                        <div class="relative aspect-[16/9] overflow-hidden">
                            @if($article->featured_image)
                                <img src="/{{ ltrim($article->featured_image, '/') }}"
                                     alt="{{ $article->title }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            @else
                                <img src="/images/INSIGHTS ARTIKEL.jpg"
                                     alt="{{ $article->title }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                            @endif
                        </div>
                        <div class="card-content flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-2">
                                <time datetime="{{ ($article->published_at ?? $article->created_at)->toDateString() }}"
                                      class="text-body-sm text-slate-500">
                                    {{ ($article->published_at ?? $article->created_at)->translatedFormat('d F Y') }}
                                </time>
                            </div>
                            <h3 class="font-heading font-bold text-navy-900 text-lg leading-snug flex-1">
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
        @endif

        @if(method_exists($articles, 'hasPages') && $articles->hasPages())
            <div class="mt-12">{{ $articles->links() }}</div>
        @endif
    </div>
</section>
@endsection