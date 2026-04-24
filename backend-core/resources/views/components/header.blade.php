<header class="fixed top-0 left-0 w-full z-50 glass border-b border-gray-200 shadow-sm transition-all duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer" onclick="window.location.href='/'">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-md">
                    <i class="ph ph-plant text-xl"></i>
                </div>
                <h1 class="font-heading font-bold text-2xl tracking-tight text-gray-900">
                    S.E.E.D
                    <span class="text-emerald-600 text-sm font-semibold tracking-normal align-top">AI</span>
                </h1>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-600 hover:text-emerald-600 font-medium flex items-center gap-1 transition-colors">
                    <i class="ph ph-house"></i> Beranda
                </a>
                <a href="#" class="text-gray-600 hover:text-emerald-600 font-medium flex items-center gap-1 transition-colors">
                    <i class="ph ph-book-open-text"></i> Edukasi
                </a>
            </nav>
            
            <!-- CTA Button -->
            <div class="hidden md:block">
                <a href="/" class="bg-gray-900 hover:bg-emerald-600 text-white px-5 py-2 rounded-full font-medium transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Mulai Diagnosa
                </a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 hover:text-emerald-600 focus:outline-none">
                    <i class="ph ph-list text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>
