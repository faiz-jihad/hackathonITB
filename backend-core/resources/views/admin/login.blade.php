<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Seed AI</title>
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
<body class="min-h-screen font-sans antialiased relative overflow-hidden">

    <!-- Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900"></div>
    <div class="fixed inset-0">
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-emerald-500/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Grid Pattern Overlay -->
    <div class="fixed inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;40&quot; height=&quot;40&quot; viewBox=&quot;0 0 40 40&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M0 0h1v40H0V0zm39 0h1v40h-1V0z&quot;/%3E%3Cpath d=&quot;M0 0h40v1H0V0zm0 39h40v1H0v-1z&quot;/%3E%3C/g%3E%3C/svg%3E');"></div>

    <!-- Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">

            <!-- Logo + Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center mb-6">
                    <img src="/images/logo.png" alt="Seed AI Logo" class="h-14 w-auto brightness-0 invert drop-shadow-lg">
                </div>
                <h1 class="text-3xl font-heading font-bold text-white mb-2">Selamat Datang</h1>
                <p class="text-slate-400 text-sm">Masuk ke panel administrasi Seed AI</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/[0.07] backdrop-blur-2xl rounded-3xl border border-white/10 shadow-2xl p-8 sm:p-10">

                <!-- Alert Error -->
                @if ($errors->any())
                <div class="mb-6 flex items-center gap-3 bg-red-500/10 border border-red-500/20 text-red-300 p-4 rounded-2xl text-sm">
                    <i class="bi bi-exclamation-circle text-lg flex-shrink-0"></i>
                    <p>{{ $errors->first() }}</p>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Input Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2" for="email">
                            <i class="bi bi-envelope mr-1"></i> Alamat Email
                        </label>
                        <input class="w-full px-4 py-3.5 rounded-xl bg-white/[0.06] border border-white/10 text-white placeholder-slate-500 focus:bg-white/[0.1] focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all duration-200 outline-none" 
                               id="email" 
                               type="email" 
                               name="email" 
                               placeholder="admin@seed-ai.com"
                               value="{{ old('email') }}"
                               required 
                               autofocus>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2" for="password">
                            <i class="bi bi-lock mr-1"></i> Kata Sandi
                        </label>
                        <div class="relative">
                            <input class="w-full px-4 py-3.5 rounded-xl bg-white/[0.06] border border-white/10 text-white placeholder-slate-500 focus:bg-white/[0.1] focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all duration-200 outline-none pr-12" 
                                   id="password" 
                                   type="password" 
                                   name="password" 
                                   placeholder="••••••••"
                                   required>
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-white transition-colors">
                                <i id="eye-icon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-white/20 bg-white/10 text-emerald-500 focus:ring-emerald-500/50 cursor-pointer">
                            <span class="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button class="w-full relative bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-emerald-500 group" 
                            type="submit">
                        <span class="flex items-center justify-center gap-2">
                            <i class="bi bi-shield-lock"></i>
                            Masuk ke Dashboard
                            <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center text-xs text-slate-600 mt-8">
                &copy; {{ date('Y') }} Seed AI. Sistem Diagnosa Penyakit Padi Cerdas.
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>