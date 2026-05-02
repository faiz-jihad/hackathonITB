<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Seed AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-gray-800 antialiased min-h-screen">

    <!-- Sidebar + Main wrapper -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col w-64 bg-slate-900 text-white fixed inset-y-0 left-0 z-30">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
                <img src="/images/logo.png" alt="Logo" class="h-8 w-auto brightness-0 invert">
                <span class="font-heading font-bold text-lg tracking-tight">Seed <span class="text-emerald-400">Admin</span></span>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
                <p class="px-3 text-[10px] uppercase tracking-widest text-slate-500 font-semibold mb-3">Menu Utama</p>
                
                <a href="{{ route('admin.kearifan-lokal.index') }}" 
                   class="{{ request()->routeIs('admin.kearifan-lokal.*') ? 'bg-emerald-500/20 text-emerald-400 border-l-2 border-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/5' }} flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200">
                    <i class="bi bi-journal-richtext text-lg"></i>
                    Kearifan Lokal
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="{{ request()->routeIs('admin.users.*') ? 'bg-emerald-500/20 text-emerald-400 border-l-2 border-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/5' }} flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200">
                    <i class="bi bi-people text-lg"></i>
                    Manajemen Admin
                </a>

                <div class="pt-4">
                    <p class="px-3 text-[10px] uppercase tracking-widest text-slate-500 font-semibold mb-3">Lainnya</p>
                    <a href="/" target="_blank" class="text-slate-400 hover:text-white hover:bg-white/5 flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200">
                        <i class="bi bi-box-arrow-up-right text-lg"></i>
                        Lihat Website
                    </a>
                </div>
            </nav>

            <!-- User -->
            @auth
            <div class="px-4 py-4 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-sm shadow">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[11px] text-slate-500">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" title="Logout" class="p-1.5 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-colors">
                            <i class="bi bi-box-arrow-right text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Bar (Mobile + Breadcrumb) -->
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-xl border-b border-gray-200/50 h-16 flex items-center px-6 gap-4">
                <!-- Mobile menu button -->
                <button id="mobile-sidebar-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="bi bi-list text-xl"></i>
                </button>

                <div class="flex-1">
                    <h2 class="text-lg font-heading font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                </div>

                @auth
                <div class="flex items-center gap-3">
                    <span class="hidden sm:inline text-sm text-gray-500">Halo, <strong class="text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</strong></span>
                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-xs">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
                @endauth
            </header>

            <!-- Page Content -->
            <main class="p-6 lg:p-8">
                <!-- Flash Message: Success -->
                @if (session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 text-sm rounded-2xl bg-emerald-50 border border-emerald-200 shadow-sm animate-slide-down">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-check-lg text-emerald-600"></i>
                    </div>
                    <p class="text-emerald-800"><span class="font-semibold">Berhasil!</span> {{ session('success') }}</p>
                </div>
                @endif

                <!-- Flash Message: Error -->
                @if ($errors->any())
                <div class="mb-6 flex items-start gap-3 p-4 text-sm rounded-2xl bg-red-50 border border-red-200 shadow-sm animate-slide-down">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="bi bi-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-red-800 mb-1">Mohon periksa kembali:</p>
                        <ul class="list-disc list-inside text-red-700 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-20 hidden lg:hidden"></div>

    <!-- Mobile Sidebar (Clone) -->
    <aside id="mobile-sidebar" class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white z-30 transform -translate-x-full transition-transform duration-300 lg:hidden">
        <div class="flex items-center justify-between px-6 h-16 border-b border-white/10">
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Logo" class="h-8 w-auto brightness-0 invert">
                <span class="font-heading font-bold text-lg">Seed <span class="text-emerald-400">Admin</span></span>
            </div>
            <button id="close-sidebar-btn" class="p-1 text-slate-400 hover:text-white">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <nav class="px-3 py-6 space-y-1">
            <a href="{{ route('admin.kearifan-lokal.index') }}" class="{{ request()->routeIs('admin.kearifan-lokal.*') ? 'bg-emerald-500/20 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/5' }} flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium">
                <i class="bi bi-journal-richtext text-lg"></i> Kearifan Lokal
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-emerald-500/20 text-emerald-400' : 'text-slate-400 hover:text-white hover:bg-white/5' }} flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium">
                <i class="bi bi-people text-lg"></i> Manajemen Admin
            </a>
            <a href="/" target="_blank" class="text-slate-400 hover:text-white hover:bg-white/5 flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium">
                <i class="bi bi-box-arrow-up-right text-lg"></i> Lihat Website
            </a>
        </nav>
    </aside>

    <script>
        const mobileBtn = document.getElementById('mobile-sidebar-btn');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeBtn = document.getElementById('close-sidebar-btn');

        function openSidebar() {
            mobileSidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
        function closeSidebar() {
            mobileSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }

        if (mobileBtn) mobileBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
    </script>

    <style>
        @keyframes slide-down { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-slide-down { animation: slide-down 0.3s ease-out; }
    </style>
</body>
</html>