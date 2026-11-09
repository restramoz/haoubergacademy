@extends('layouts.app')

@section('title', $article->seo_title ?: $article->title)
@section('meta_description', $article->meta_description ?: ($article->excerpt ?: Str::limit(strip_tags($article->content), 155)))

@push('schema')
{{-- Article Structured Data --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Article",
  "headline": {{ json_encode($article->title) }},
  "mainEntityOfPage": {{ json_encode(rtrim(config('app.url'), '/') . request()->getPathInfo()) }},
  "description": {{ json_encode($article->meta_description ?: $article->excerpt) }},
  "datePublished": "{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  @if($article->featured_image)
  "image": ["{{ rtrim(config('app.url'), '/') . '/' . ltrim($article->featured_image, '/') }}"],
  @endif
  "author": {
    "@type": "Organization",
    "name": "Tim Houberg Academy"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name', 'Houberg Academy') }}",
    "url": "{{ rtrim(config('app.url'), '/') }}"
  }
}
</script>

@if(!empty($article->faqs) && is_array($article->faqs))
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($article->faqs as $i => $faq)
    {
      "@type": "Question",
      "name": {{ json_encode($faq['q'] ?? '') }},
      "acceptedAnswer": {
        "@type": "Answer",
        "text": {{ json_encode($faq['a'] ?? '') }}
      }
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endif
@endpush

@section('content')
{{-- Breadcrumbs --}}
<nav class="bg-sky-50 border-b border-border py-3 text-body-sm" aria-label="Breadcrumb">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <ol class="flex items-center flex-wrap gap-x-2 gap-y-1" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" itemprop="item">
                    <span itemprop="name">Beranda</span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <li aria-hidden="true" class="text-slate-400">/</li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ route('articles.index') }}" class="hover:text-primary transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" itemprop="item">
                    <span itemprop="name">Insights</span>
                </a>
                <meta itemprop="position" content="2">
            </li>
            <li aria-hidden="true" class="text-slate-400">/</li>
            <li class="font-heading font-semibold text-navy-900 truncate max-w-xs" aria-current="page">{{ $article->title }}</li>
        </ol>
    </div>
</nav>

{{-- Article Header & Body --}}
<article class="section-py bg-white">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <header class="space-y-5 mb-10">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-3 py-1 rounded-full text-xs font-heading font-bold bg-mint-50 text-primary border border-primary/20 uppercase tracking-wider">
                    Houberg Academy
                </span>
                @if($targetCity)
                    <a
                        href="{{ route('regional.city', $targetCity['slug']) }}"
                        class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-slate-600 hover:text-primary border border-border transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary"
                    >
                        Wilayah {{ $targetCity['name'] }}
                    </a>
                @endif
            </div>

            <h1 class="font-heading font-extrabold text-navy-900 text-3xl sm:text-4xl lg:text-5xl leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 text-body-sm text-slate-500 border-b border-border pb-5">
                <time datetime="{{ ($article->published_at ?? $article->created_at)->toDateString() }}">
                    Diterbitkan: <strong class="text-slate-600">{{ ($article->published_at ?? $article->created_at)->translatedFormat('d F Y') }}</strong>
                </time>
                <span aria-hidden="true">&bull;</span>
                <span>Oleh: <strong class="text-slate-600">Tim Houberg Academy</strong></span>
            </div>

            @if($article->excerpt)
                <p class="text-body text-slate-600 leading-relaxed bg-sky-50 p-5 rounded-xl border-l-4 border-primary">
                    {{ $article->excerpt }}
                </p>
            @endif
        </header>

        {{-- Featured Image --}}
        @if($article->featured_image)
            <div class="mb-10 rounded-[1.5rem] overflow-hidden border border-border shadow-card bg-sky-50">
                <img
                    src="/{{ ltrim($article->featured_image, '/') }}"
                    alt="{{ $article->title }}"
                    class="article-featured-image w-full"
                    loading="eager"
                >
            </div>
        @else
            <div class="mb-10 rounded-[1.5rem] overflow-hidden border border-border shadow-card bg-sky-50">
                <img
                    src="/images/INSIGHTS ARTIKEL.jpg"
                    alt="{{ $article->title }}"
                    class="article-featured-image w-full"
                    loading="eager"
                >
            </div>
        @endif

        <style>
            .article-content {
                width: 100%;
                max-width: 100%;
                min-width: 0;
                overflow-wrap: anywhere;
            }
            .article-content .article-table-scroll {
                display: block;
                width: 100%;
                max-width: 100%;
                min-width: 0;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 1rem 0;
            }
            .article-content .article-table-scroll table {
                width: max-content;
                min-width: 600px;
                max-width: none;
                border-collapse: collapse;
                table-layout: auto;
            }
            .article-content .article-table-scroll th,
            .article-content .article-table-scroll td {
                border: 1px solid #E5EAEE;
                padding: 8px 10px;
                text-align: left;
                vertical-align: top;
                white-space: normal;
                overflow-wrap: anywhere;
            }
            .article-content .article-table-scroll th {
                background: #F3F8FA;
                font-weight: 700;
                color: #0B1F33;
            }
        </style>

        {{-- Main Content --}}
        <div class="article-content max-w-none text-body leading-relaxed text-slate-600
                    prose-headings:font-heading prose-headings:font-bold prose-headings:text-navy-900
                    prose-h2:text-2xl prose-h2:mt-10 prose-h3:text-xl prose-h3:mt-8
                    prose-a:text-primary prose-a:no-underline hover:prose-a:underline hover:prose-a:text-primary-dark
                    prose-strong:text-navy-900
                    prose-blockquote:border-primary prose-blockquote:bg-sky-50 prose-blockquote:rounded-xl prose-blockquote:py-3 prose-blockquote:px-4 prose-blockquote:text-slate-600
                    prose-ul:space-y-2 prose-ol:space-y-2
                    prose-table:w-full prose-table:border-collapse prose-table:text-body-sm
                    prose-th:border prose-th:border-border prose-th:bg-sky-50 prose-th:px-4 prose-th:py-3 prose-th:text-left
                    prose-td:border prose-td:border-border prose-td:px-4 prose-td:py-3 prose-td:align-top">
            {!! $article->content !!}
        </div>

        <script>
            document.querySelectorAll('.article-content table').forEach(function (table) {
                if (table.parentElement.classList.contains('article-table-scroll')) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'article-table-scroll';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            });
        </script>

        {{-- FAQ Section --}}
        @if(!empty($article->faqs) && is_array($article->faqs))
            <div class="mt-14 pt-8 border-t border-border space-y-3">
                <h2 class="font-heading font-bold text-navy-900 text-2xl">
                    Pertanyaan Umum (FAQ)
                </h2>
                <div class="space-y-3" role="list">
                    @foreach($article->faqs as $i => $faq)
                        <details
                            class="group bg-white border border-border rounded-xl overflow-hidden shadow-sm"
                            @if($loop->first) open @endif
                        >
                            <summary class="flex items-center justify-between px-5 py-4 font-heading font-semibold text-slate-600 cursor-pointer select-none list-none hover:bg-sky-50 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary">
                                <span>{{ $faq['q'] ?? '' }}</span>
                                <svg class="w-5 h-5 text-primary shrink-0 ml-3 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </summary>
                            <div class="px-5 pb-5 pt-2 text-body text-slate-600 leading-relaxed">
                                {{ $faq['a'] ?? '' }}
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Consultation CTA --}}
        <div class="mt-14 p-6 sm:p-8 rounded-[1.5rem] bg-navy-900 text-white space-y-4 shadow-card border border-navy-800">
            <span class="inline-block px-3 py-1 rounded-full bg-navy-800 text-primary text-[10px] font-heading font-extrabold uppercase tracking-[0.16em] border border-primary/40">
                Houberg Academy
            </span>
            <h3 class="font-heading font-extrabold text-white text-2xl sm:text-3xl">
                Konsultasikan Kebutuhan Program Anda
            </h3>
            <p class="text-body text-slate-300 leading-relaxed max-w-2xl">
                Dapatkan informasi mengenai program pembelajaran dan saran yang sesuai melalui WhatsApp.
            </p>
            <div class="pt-2 flex flex-wrap gap-3">
                <x-wa-cta variant="wa" size="md" label="Konsultasi via WhatsApp" class="font-bold shadow-lg justify-center" />
                <x-button href="{{ route('articles.index') }}" variant="white" size="md">
                    ← Lihat Artikel Lainnya
                </x-button>
            </div>
        </div>

        {{-- Direct phone contacts --}}
        @if(! str_contains((string) $article->content, 'article-consultation-numbers') && ! str_contains((string) $article->content, 'wa.me/628118500177'))
            <x-contact-numbers />
        @endif
    </div>
</article>

{{-- Related Articles --}}
@if($relatedArticles->isNotEmpty())
<section class="section-py bg-sky-50 border-t border-border" aria-label="Artikel terkait">
    <div class="mx-auto max-w-[1200px] px-4 sm:px-6 lg:px-8">
        <h2 class="font-heading font-bold text-navy-900 text-2xl mb-8">
            Artikel Lainnya
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $rel)
                <article class="article-card group flex flex-col">
                    <div class="relative aspect-[16/9] overflow-hidden">
                        @if($rel->featured_image)
                            <img src="/{{ ltrim($rel->featured_image, '/') }}"
                                 alt="{{ $rel->title }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        @else
                            <img src="/images/INSIGHTS ARTIKEL.jpg"
                                 alt="{{ $rel->title }}"
                                 loading="lazy"
                                 decoding="async"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        @endif
                    </div>
                    <div class="card-content flex-1 flex flex-col">
                        <time class="text-body-sm text-slate-500 mb-2" datetime="{{ ($rel->published_at ?? $rel->created_at)->toDateString() }}">
                            {{ ($rel->published_at ?? $rel->created_at)->translatedFormat('d F Y') }}
                        </time>
                        <h3 class="font-heading font-bold text-navy-900 text-base leading-snug flex-1">
                            <a href="{{ route('articles.show', $rel->slug) }}"
                               class="transition-colors hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded">
                                {{ $rel->title }}
                            </a>
                        </h3>
                        @if($rel->excerpt)
                            <p class="mt-2 text-body-sm text-slate-600 line-clamp-3">{{ $rel->excerpt }}</p>
                        @endif
                        <a href="{{ route('articles.show', $rel->slug) }}"
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
@endsection