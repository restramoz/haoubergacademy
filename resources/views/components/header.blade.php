<header class="navbar" role="banner">
    <div class="mx-auto flex h-16 max-w-[1200px] items-center justify-between px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2" aria-label="{{ config('app.name', 'Houberg Academy') }} beranda">
            <!-- Logo mark: Navy box with white H -->
            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-navy-900 text-lg font-extrabold text-white" aria-hidden="true">H</span>
            <span class="leading-tight">
                <span class="block text-lg font-extrabold tracking-tight text-navy-900">{{ config('app.name', 'Houberg Academy') }}</span>
                <span class="block text-[11px] font-medium text-primary">Learning & Development</span>
            </span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden items-center gap-1 lg:flex" aria-label="Navigasi utama">
            <!-- Program Dropdown -->
            <div class="relative" id="program-dropdown">
                <button type="button" class="flex items-center gap-1.5 text-sm font-semibold text-slate-600 hover:text-navy-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg px-3 py-2" aria-expanded="false" aria-haspopup="true" aria-controls="program-menu" id="program-trigger">
                    Program
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="program-menu" class="hidden absolute left-0 top-full mt-2 min-w-[280px] max-h-80 overflow-y-auto rounded-xl border border-border bg-white shadow-card p-2" role="menu" aria-orientation="vertical">
                    <a href="{{ route('home') }}#program" class="block px-3 py-2 rounded-lg text-sm font-bold text-primary hover:bg-mint-50 focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Lihat Semua 21 Kategori</a>
                    <div class="my-1 border-t border-border"></div>
                    <a href="{{ route('home') }}#teknologi-informasi-digital" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Teknologi Informasi & Digital</a>
                    <a href="{{ route('home') }}#bisnis-manajemen-administrasi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Bisnis, Manajemen & Administrasi</a>
                    <a href="{{ route('home') }}#keselamatan-kerja-k3" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Keselamatan Kerja (K3)</a>
                    <a href="{{ route('home') }}#konstruksi-bangunan" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Konstruksi & Bangunan</a>
                    <a href="{{ route('home') }}#manufaktur-fabrikasi-metalurgi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Manufaktur, Fabrikasi & Metalurgi</a>
                    <a href="{{ route('home') }}#alat-berat-crane-rigging" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Alat Berat, Crane & Rigging</a>
                    <a href="{{ route('home') }}#listrik-elektronika-instrumentasi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Listrik, Elektronika & Instrumentasi</a>
                    <a href="{{ route('home') }}#pertanian-perkebunan-kehutanan" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Pertanian, Perkebunan & Kehutanan</a>
                    <a href="{{ route('home') }}#keuangan-perbankan-asuransi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Keuangan, Perbankan & Asuransi</a>
                    <a href="{{ route('home') }}#desain-kreatif-komunikasi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Desain, Kreatif & Komunikasi</a>
                    <a href="{{ route('home') }}#lingkungan-limbah-pengolahan-air" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Lingkungan, Limbah & Air</a>
                    <a href="{{ route('home') }}#energi-kimia-proses" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Energi, Kimia & Proses</a>
                    <a href="{{ route('home') }}#pertambangan-migas-geologi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Pertambangan, Migas & Geologi</a>
                    <a href="{{ route('home') }}#transportasi-logistik-pengemudi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Transportasi & Logistik</a>
                    <a href="{{ route('home') }}#peternakan-perikanan-kelautan" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Peternakan & Perikanan</a>
                    <a href="{{ route('home') }}#keamanan-pengamanan-tanggap-darurat" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Keamanan & Tanggap Darurat</a>
                    <a href="{{ route('home') }}#pariwisata-perhotelan-kuliner" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Pariwisata & Perhotelan</a>
                    <a href="{{ route('home') }}#kecantikan-spa-kebugaran" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Kecantikan & Kebugaran</a>
                    <a href="{{ route('home') }}#pendidikan-pelatihan-sertifikasi" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Pendidikan & Pelatihan</a>
                    <a href="{{ route('home') }}#layanan-sosial-umum" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Layanan Sosial & Umum</a>
                    <a href="{{ route('home') }}#teknis-profesi-lainnya" class="block px-3 py-1.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Teknis & Profesi Lainnya</a>
                </div>
            </div>

            <a href="{{ route('home') }}#tentang" class="text-sm font-semibold text-slate-600 hover:text-navy-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg px-3 py-2">Tentang</a>
            <a href="{{ route('regional.province', 'aceh') }}" class="text-sm font-semibold text-slate-600 hover:text-navy-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg px-3 py-2">Wilayah</a>
            <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-slate-600 hover:text-navy-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg px-3 py-2">Artikel</a>

            <!-- Search icon + Konsultasi button -->
            <div class="flex items-center gap-3 ml-2">
                <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:text-navy-900 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary" aria-label="Cari">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                </button>
                <x-wa-cta variant="primary" size="sm" label="Konsultasi" class="bg-primary font-bold text-white hover:bg-primary-dark min-w-[120px]" />
            </div>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button id="mobile-nav-toggle" type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-border text-slate-600 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:hidden" aria-expanded="false" aria-controls="mobile-nav-drawer" aria-label="Buka menu navigasi">
            <svg id="icon-menu-open" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg id="icon-menu-close" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
        </button>
    </div>

    <!-- Mobile Navigation Drawer -->
    <nav id="mobile-nav-drawer" class="hidden border-t border-border bg-white px-4 py-4 lg:hidden" aria-label="Navigasi utama seluler">
        <div class="mx-auto flex max-w-[1200px] flex-col gap-1">
            <!-- Program dropdown in mobile -->
            <div class="relative" id="mobile-program-dropdown">
                <button type="button" class="w-full flex items-center justify-between px-3 py-3 font-semibold text-slate-800 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary rounded-lg" aria-expanded="false" aria-haspopup="true" aria-controls="mobile-program-menu">
                    Program
                    <svg class="w-5 h-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="mobile-program-menu" class="hidden absolute left-0 right-0 top-full mt-1 rounded-xl border border-border bg-white shadow-card p-2 max-h-72 overflow-y-auto z-50" role="menu" aria-orientation="vertical">
                    <a href="{{ route('home') }}#program" class="block px-3 py-2 rounded-lg text-sm font-bold text-primary hover:bg-mint-50 focus-visible:outline-none focus-visible:bg-mint-50" role="menuitem">Lihat Semua 21 Kategori</a>
                    <div class="my-1 border-t border-border"></div>
                    <a href="{{ route('home') }}#teknologi-informasi-digital" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Teknologi Informasi & Digital</a>
                    <a href="{{ route('home') }}#bisnis-manajemen-administrasi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Bisnis, Manajemen & Administrasi</a>
                    <a href="{{ route('home') }}#keselamatan-kerja-k3" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Keselamatan Kerja (K3)</a>
                    <a href="{{ route('home') }}#konstruksi-bangunan" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Konstruksi & Bangunan</a>
                    <a href="{{ route('home') }}#manufaktur-fabrikasi-metalurgi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Manufaktur, Fabrikasi & Metalurgi</a>
                    <a href="{{ route('home') }}#alat-berat-crane-rigging" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Alat Berat, Crane & Rigging</a>
                    <a href="{{ route('home') }}#listrik-elektronika-instrumentasi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Listrik, Elektronika & Instrumentasi</a>
                    <a href="{{ route('home') }}#pertanian-perkebunan-kehutanan" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Pertanian, Perkebunan & Kehutanan</a>
                    <a href="{{ route('home') }}#keuangan-perbankan-asuransi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Keuangan, Perbankan & Asuransi</a>
                    <a href="{{ route('home') }}#desain-kreatif-komunikasi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Desain, Kreatif & Komunikasi</a>
                    <a href="{{ route('home') }}#lingkungan-limbah-pengolahan-air" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Lingkungan, Limbah & Air</a>
                    <a href="{{ route('home') }}#energi-kimia-proses" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Energi, Kimia & Proses</a>
                    <a href="{{ route('home') }}#pertambangan-migas-geologi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Pertambangan, Migas & Geologi</a>
                    <a href="{{ route('home') }}#transportasi-logistik-pengemudi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Transportasi & Logistik</a>
                    <a href="{{ route('home') }}#peternakan-perikanan-kelautan" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Peternakan & Perikanan</a>
                    <a href="{{ route('home') }}#keamanan-pengamanan-tanggap-darurat" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Keamanan & Tanggap Darurat</a>
                    <a href="{{ route('home') }}#pariwisata-perhotelan-kuliner" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Pariwisata & Perhotelan</a>
                    <a href="{{ route('home') }}#kecantikan-spa-kebugaran" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Kecantikan & Kebugaran</a>
                    <a href="{{ route('home') }}#pendidikan-pelatihan-sertifikasi" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Pendidikan & Pelatihan</a>
                    <a href="{{ route('home') }}#layanan-sosial-umum" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Layanan Sosial & Umum</a>
                    <a href="{{ route('home') }}#teknis-profesi-lainnya" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-mint-50 hover:text-primary" role="menuitem">Teknis & Profesi Lainnya</a>
                </div>
            </div>

            <a href="{{ route('home') }}#tentang" class="mobile-nav-link rounded-lg px-3 py-3 font-semibold text-slate-800 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">Tentang</a>
            <a href="{{ route('regional.province', 'aceh') }}" class="mobile-nav-link rounded-lg px-3 py-3 font-semibold text-slate-800 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">Wilayah</a>
            <a href="{{ route('articles.index') }}" class="mobile-nav-link rounded-lg px-3 py-3 font-semibold text-slate-800 hover:bg-sky-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary">Artikel</a>
            <div class="pt-2"><x-wa-cta variant="primary" size="md" label="Konsultasi" class="w-full justify-center bg-primary font-bold text-white hover:bg-primary-dark" /></div>
        </div>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mobile nav toggle
    const button = document.getElementById('mobile-nav-toggle');
    const drawer = document.getElementById('mobile-nav-drawer');
    if (button && drawer) {
        button.addEventListener('click', function () {
            const open = button.getAttribute('aria-expanded') !== 'true';
            button.setAttribute('aria-expanded', String(open));
            drawer.classList.toggle('hidden', !open);
            document.getElementById('icon-menu-open').classList.toggle('hidden', open);
            document.getElementById('icon-menu-close').classList.toggle('hidden', !open);
            button.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
        });

        drawer.querySelectorAll('.mobile-nav-link').forEach(link => link.addEventListener('click', () => {
            drawer.classList.add('hidden');
            button.setAttribute('aria-expanded', 'false');
            document.getElementById('icon-menu-open').classList.remove('hidden');
            document.getElementById('icon-menu-close').classList.add('hidden');
        }));
    }

    // Desktop Program Dropdown
    const programTrigger = document.getElementById('program-trigger');
    const programMenu = document.getElementById('program-menu');
    if (programTrigger && programMenu) {
        programTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!expanded));
            programMenu.classList.toggle('hidden', expanded);
        });

        document.addEventListener('click', function(e) {
            if (!programTrigger.contains(e.target) && !programMenu.contains(e.target)) {
                programTrigger.setAttribute('aria-expanded', 'false');
                programMenu.classList.add('hidden');
            }
        });

        programMenu.querySelectorAll('[role="menuitem"]').forEach(item => {
            item.addEventListener('click', () => {
                programTrigger.setAttribute('aria-expanded', 'false');
                programMenu.classList.add('hidden');
            });
        });
    }

    // Mobile Program Dropdown
    const mobileProgramTrigger = document.getElementById('mobile-program-dropdown')?.querySelector('button');
    const mobileProgramMenu = document.getElementById('mobile-program-menu');
    if (mobileProgramTrigger && mobileProgramMenu) {
        mobileProgramTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!expanded));
            mobileProgramMenu.classList.toggle('hidden', expanded);
        });

        document.addEventListener('click', function(e) {
            if (!mobileProgramTrigger.contains(e.target) && !mobileProgramMenu.contains(e.target)) {
                mobileProgramTrigger.setAttribute('aria-expanded', 'false');
                mobileProgramMenu.classList.add('hidden');
            }
        });

        mobileProgramMenu.querySelectorAll('[role="menuitem"]').forEach(item => {
            item.addEventListener('click', () => {
                mobileProgramTrigger.setAttribute('aria-expanded', 'false');
                mobileProgramMenu.classList.add('hidden');
            });
        });
    }
});
</script>