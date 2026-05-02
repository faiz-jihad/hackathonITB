<header 
    x-data="{ mobileMenuOpen: false }" 
    class="fixed top-0 left-0 w-full z-50 backdrop-blur-xl bg-white/80 border-b border-gray-100 shadow-sm transition-all duration-300"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-18 py-3">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="/images/logo.png" alt="MangsaPadi Logo" class="h-9 w-auto group-hover:scale-110 transition-transform duration-300">
                
                <div class="flex flex-col">
                    <span class="font-heading font-black text-xl leading-none tracking-tight text-gray-900">
                        <span class="text-emerald-600"></span>
                    </span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] leading-none mt-1"> </span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-10">
                @foreach([
                    ['name' => 'Beranda', 'route' => 'home', 'icon' => 'house'],
                    ['name' => 'Edukasi', 'route' => 'edukasi', 'icon' => 'book'],
                    ['name' => 'Komunitas', 'route' => 'komunitas.index', 'icon' => 'people']
                ] as $item)
                <a href="{{ route($item['route']) }}" 
                   class="group relative text-sm font-semibold {{ Route::is($item['route']) ? 'text-emerald-600' : 'text-gray-500 hover:text-emerald-600' }} transition-colors duration-300">
                    <span class="flex items-center gap-2">
                        <i class="bi bi-{{ $item['icon'] }} {{ Route::is($item['route']) ? 'text-emerald-500' : 'text-gray-400 group-hover:text-emerald-500' }} transition-colors"></i>
                        {{ $item['name'] }}
                    </span>
                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-emerald-500 transform {{ Route::is($item['route']) ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-full"></span>
                </a>
                @endforeach
            </nav>
            
            <!-- CTA -->
            <div class="hidden md:flex items-center gap-4">
                <a href="/" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-bold text-sm text-white bg-gradient-to-r from-emerald-600 to-teal-600 shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/60 transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                    <i class="bi bi-plus-circle"></i>
                    Diagnosa Baru
                </a>
            </div>
            
            <!-- Mobile Toggle Button -->
            <div class="md:hidden flex items-center">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="relative p-2 text-gray-600 hover:text-emerald-600 transition-colors focus:outline-none"
                >
                    <div class="w-6 h-6 flex flex-col justify-center items-center gap-1.5">
                        <span class="block w-6 h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
                        <span class="block w-6 h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                        <span class="block w-6 h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Side Drawer) -->
    <template x-teleport="body">
        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[60] md:hidden"
        >
            <!-- Overlay -->
            <div @click="mobileMenuOpen = false" class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"></div>

            <!-- Drawer -->
            <div 
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="absolute top-0 right-0 h-full w-4/5 max-w-sm bg-white shadow-2xl flex flex-col"
            >
                <!-- Drawer Header -->
                <div class="p-6 flex items-center justify-between border-b border-gray-50">
                    <div class="flex items-center gap-2">
                        <img src="/images/logo.png" alt="Logo" class="h-8 w-auto">
                        <span class="font-heading font-black text-lg"></span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>

                <!-- Drawer Links -->
                <div class="flex-1 overflow-y-auto p-6 space-y-2">
                    @foreach([
                        ['name' => 'Beranda', 'route' => 'home', 'icon' => 'house'],
                        ['name' => 'Edukasi', 'route' => 'edukasi', 'icon' => 'book'],
                        ['name' => 'Komunitas', 'route' => 'komunitas.index', 'icon' => 'people']
                    ] as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-4 p-4 rounded-2xl transition-all duration-300 {{ Route::is($item['route']) ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ Route::is($item['route']) ? 'bg-white shadow-sm' : 'bg-gray-100' }}">
                            <i class="bi bi-{{ $item['icon'] }} text-lg"></i>
                        </div>
                        <span class="font-bold">{{ $item['name'] }}</span>
                        @if(Route::is($item['route']))
                        <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                        @endif
                    </a>
                    @endforeach
                </div>

                <!-- Drawer Footer (CTA) -->
                <div class="p-6 border-t border-gray-50 space-y-4">
                    <a href="/" class="flex items-center justify-center gap-3 w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-2xl font-bold shadow-lg shadow-emerald-200">
                        <i class="bi bi-plus-circle"></i>
                        Mulai Diagnosa
                    </a>
                    <p class="text-center text-[10px] text-gray-400 uppercase tracking-widest font-semibold">
                        Seed Agricultural AI v1.0
                    </p>
                </div>
            </div>
        </div>
    </template>
</header>