<header class="fixed top-0 left-0 w-full z-50 backdrop-blur-xl bg-white/70 border-b border-white/30 shadow-sm transition-all duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer group" onclick="window.location.href='/'">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="bi bi-leaf text-lg"></i>
                </div>
                <h1 class="font-bold text-2xl tracking-tight text-gray-900 group-hover:text-emerald-600 transition-colors">
                    S.E.E.D
                    <span class="text-emerald-600 text-sm font-semibold align-top ml-1">AI</span>
                </h1>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="relative text-gray-600 hover:text-emerald-600 font-medium transition">
                    Beranda
                    <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-emerald-500 transition-all group-hover:w-full"></span>
                </a>

                <a href="{{ route('edukasi') }}" class="relative text-gray-600 hover:text-emerald-600 font-medium transition">
                    Edukasi
                </a>
            </nav>
            
            <!-- CTA -->
            <div class="hidden md:block">
                <a href="/" class="relative inline-flex items-center gap-2 px-5 py-2 rounded-full font-medium text-white bg-gradient-to-r from-emerald-500 to-emerald-600 shadow-lg hover:shadow-emerald-200 transition-all duration-300 hover:scale-105">
                    <i class="bi bi-activity"></i>
                    Mulai Diagnosa
                </a>
            </div>
            
            <!-- Mobile Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-emerald-600 transition">
                    <i class="bi bi-list text-3xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden z-40"></div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-5 space-y-5">

            <!-- Close -->
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-lg">Menu</h2>
                <button id="close-menu" class="text-gray-600 hover:text-red-500">
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>

            <!-- Links -->
            <a href="/" class="flex items-center gap-3 text-gray-700 hover:text-emerald-600 font-medium">
                <i class="bi bi-house"></i> Beranda
            </a>

            <a href="{{ route('edukasi') }}" class="flex items-center gap-3 text-gray-700 hover:text-emerald-600 font-medium">
                <i class="bi bi-book"></i> Edukasi
            </a>

            <!-- CTA -->
            <a href="/" class="block text-center bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-5 py-3 rounded-xl font-medium shadow-lg">
                Mulai Diagnosa
            </a>
        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('close-menu');

    function openMenu() {
        menu.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
    }

    function closeMenu() {
        menu.classList.add('translate-x-full');
        overlay.classList.add('hidden');
    }

    btn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
</script>