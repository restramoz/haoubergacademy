<footer class="footer relative" role="contentinfo">
    <!-- Background image -->
    <img src="/images/FOOTER.jpg"
         alt="Houberg Academy"
         class="absolute inset-0 w-full h-full object-cover opacity-5" aria-hidden="true" />

    <div class="mx-auto grid max-w-[1200px] gap-10 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8 relative z-10">
        <!-- Column 1: Logo + Description -->
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary" aria-label="{{ config('app.name', 'Houberg Academy') }} beranda">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-navy-900 text-lg font-extrabold text-white" aria-hidden="true">H</span>
                <span class="leading-tight">
                    <span class="block text-lg font-extrabold tracking-tight text-white">{{ config('app.name', 'Houberg Academy') }}</span>
                    <span class="block text-[11px] font-medium text-primary">Learning & Development</span>
                </span>
            </a>
            <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">Platform Learning & Development untuk pengembangan kompetensi profesional di berbagai bidang.</p>
        </div>

        <!-- Column 2: Menu Links -->
        <nav aria-label="Navigasi kaki halaman">
            <h2 class="text-xs font-bold uppercase tracking-[0.16em] text-primary">Jelajahi</h2>
            <ul class="mt-4 space-y-3 text-sm text-slate-400" role="list">
                <li><a class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" href="{{ route('home') }}#program">Program Pembelajaran</a></li>
                <li><a class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" href="{{ route('home') }}#katalog">Katalog Program</a></li>
                <li><a class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" href="{{ route('home') }}#tentang">Tentang Houberg Academy</a></li>
                <li><a class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" href="{{ route('regional.province', 'aceh') }}">Direktori Wilayah</a></li>
                <li><a class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" href="{{ route('articles.index') }}">Insights & Artikel</a></li>
            </ul>
        </nav>

        <!-- Column 3: Newsletter -->
        <div>
            <h2 class="text-xs font-bold uppercase tracking-[0.16em] text-primary">Tetap Terhubung</h2>
            <p class="mt-2 text-sm text-slate-400">Dapatkan update terbaru program, artikel, dan wawasan pengembangan karir langsung ke email Anda.</p>
            <form class="mt-4 flex flex-col gap-2" action="#" method="POST" aria-label="Berlangganan newsletter">
                <input type="email" name="email" placeholder="Masukkan email Anda" class="input text-sm" required aria-label="Email untuk berlangganan" />
                <x-button type="submit" variant="filled" size="sm" class="w-full justify-center">Berlangganan</x-button>
            </form>
        </div>
    </div>

    <!-- Legal Bar -->
    <div class="border-t border-neutral-800">
        <div class="mx-auto flex max-w-[1200px] flex-col gap-3 px-4 py-5 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Houberg Academy') }}. Semua hak dilindungi.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" aria-label="Kebijakan Privasi">Kebijakan Privasi</a>
                <span class="text-slate-700" aria-hidden="true">|</span>
                <a href="#" class="hover:text-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded" aria-label="Syarat & Ketentuan">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>