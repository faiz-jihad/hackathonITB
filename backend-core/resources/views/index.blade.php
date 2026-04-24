<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>SEED (Smart Eco-Expert Detector) — Deteksi AI untuk Ketahanan Pangan</title>
    <meta name="description"
        content="SEED — Solusi deteksi cerdas penyakit padi menggunakan Artificial Intelligence. Dikembangkan oleh Tim PECINTASAWIT untuk ketahanan iklim dan kearifan lokal.">
    <meta name="keywords"
        content="deteksi penyakit padi, AI pertanian, ketahanan pangan, climate resilience, smart farming, hackathon">
    <meta name="author" content="Tim PECINTASAWIT">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="SEED — Smart Eco-Expert Detector">
    <meta property="og:description" content="Deteksi cerdas penyakit padi dengan AI untuk ketahanan iklim dan pangan.">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌾</text></svg>">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* ========== BASE STYLES ========== */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ========== BACKGROUND PATTERN ========== */
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2316a34a' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* ========== ANIMATIONS ========== */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        /* ========== SMOOTH SCROLL ========== */
        html {
            scroll-behavior: smooth;
        }

        /* ========== SELECTION ========== */
        ::selection {
            background-color: #bbf7d0;
            color: #166534;
        }

        /* ========== FOCUS STYLES ========== */
        a:focus-visible,
        button:focus-visible {
            outline: 2px solid #16a34a;
            outline-offset: 2px;
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-white text-gray-800 antialiased">

    <!-- ==================== NAVIGATION BAR ==================== -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-lg border-b border-gray-100 transition-all duration-300"
        role="navigation" aria-label="Navigasi Utama">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <a href="#" class="flex-shrink-0 flex items-center gap-3 group" aria-label="SEED Home">
                    <div
                        class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center group-hover:bg-green-700 transition-colors">
                        <i class="bi bi-flower1 text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-gray-900">SEED</span>
                        <span class="hidden sm:block text-xs text-gray-500 font-medium leading-tight">Smart Eco-Expert
                            Detector</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="#tentang"
                        class="px-4 py-2 text-gray-600 hover:text-green-700 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Tentang
                    </a>
                    <a href="#fitur"
                        class="px-4 py-2 text-gray-600 hover:text-green-700 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Fitur
                    </a>
                    <a href="#penyakit"
                        class="px-4 py-2 text-gray-600 hover:text-green-700 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Penyakit
                    </a>
                    <a href="#tim"
                        class="px-4 py-2 text-gray-600 hover:text-green-700 font-medium transition-colors rounded-lg hover:bg-green-50">
                        Tim
                    </a>
                </div>

                <!-- CTA Button -->
                <div class="flex items-center gap-4">
                    <a href="/diagnosa"
                        class="hidden sm:inline-flex items-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-green-200 hover:bg-green-700 hover:shadow-xl transition-all duration-300">
                        <i class="bi bi-camera-fill"></i>
                        <span>Coba Deteksi</span>
                    </a>
                    <!-- Mobile CTA -->
                    <a href="/diagnosa"
                        class="sm:hidden bg-green-600 text-white p-2.5 rounded-xl shadow-md hover:bg-green-700 transition-colors"
                        aria-label="Coba Deteksi">
                        <i class="bi bi-camera-fill text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO SECTION ==================== -->
    <section class="relative pt-32 pb-20 lg:pt-44 lg:pb-32 overflow-hidden bg-pattern" aria-labelledby="hero-heading">

        <!-- Background Blobs -->
        <div class="absolute top-1/4 -left-20 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"
            aria-hidden="true"></div>
        <div class="absolute top-1/3 -right-20 w-72 h-72 bg-emerald-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"
            aria-hidden="true"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10 -translate-x-1/2"
            aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto animate-fade-in-up">

                <!-- Status Badge -->
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-semibold mb-8 border border-green-200">
                    <i class="bi bi-patch-check-fill text-green-500"></i>
                    <span>Climate Resilience & Local Wisdom Hackathon 2026</span>
                </div>

                <!-- Main Heading -->
                <h1 id="hero-heading"
                    class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                    Deteksi Penyakit Padi<br class="hidden sm:block">
                    dengan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-500">Kecerdasan
                        Buatan</span>
                </h1>

                <!-- Description -->
                <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                    SEED memberdayakan petani lokal mendeteksi
                    <strong class="text-gray-800">10 jenis penyakit padi</strong>
                    secara instan hanya melalui foto. Teknologi AI mutakhir,
                    antarmuka yang ramah untuk semua.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/diagnosa"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 text-lg font-bold rounded-xl text-white bg-green-600 hover:bg-green-700 shadow-xl shadow-green-200 transition-all duration-300 transform hover:-translate-y-0.5">
                        <i class="bi bi-camera-fill"></i>
                        <span>Mulai Analisis Daun</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#tentang"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 text-lg font-bold rounded-xl text-gray-700 bg-white border-2 border-gray-200 hover:border-green-500 hover:text-green-600 transition-all duration-300">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Pelajari Selengkapnya</span>
                    </a>
                </div>

                <!-- Stats Mini -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-16 max-w-2xl mx-auto">
                    <div class="text-center p-4">
                        <div class="text-3xl font-extrabold text-green-600">93%</div>
                        <p class="text-sm text-gray-500 font-medium">Akurasi Model</p>
                    </div>
                    <div class="text-center p-4 border-l border-r border-gray-200">
                        <div class="text-3xl font-extrabold text-green-600">&lt; 2s</div>
                        <p class="text-sm text-gray-500 font-medium">Waktu Analisis</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl font-extrabold text-green-600">10</div>
                        <p class="text-sm text-gray-500 font-medium">Kelas Penyakit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== ABOUT SECTION ==================== -->
    <section id="tentang" class="py-24 bg-white" aria-labelledby="about-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <!-- Left Column: Text -->
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-sm font-semibold mb-6 border border-amber-200">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>Masalah Utama</span>
                    </div>

                    <h2 id="about-heading" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        Perubahan Iklim Mengancam Ketahanan Pangan
                    </h2>

                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Kemarau berkepanjangan dan curah hujan ekstrem telah merusak
                        pola tanam tradisional petani Indonesia. Akibatnya, ledakan
                        penyakit seperti <strong class="text-gray-800">Blast</strong>
                        dan <strong class="text-gray-800">Hawar Daun Bakteri</strong>
                        semakin sulit diprediksi.
                    </p>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Keterbatasan akses terhadap penyuluh pertanian (PPL) membuat
                        petani sering terlambat mengidentifikasi penyakit. SEED hadir
                        sebagai solusi berbasis AI yang memberdayakan petani dengan
                        deteksi instan langsung dari sawah.
                    </p>

                    <!-- Feature List -->
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-0.5">
                                <i class="bi bi-check-lg text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <span class="text-gray-800 font-semibold">Adaptif terhadap Perubahan Iklim</span>
                                <p class="text-gray-500 text-sm">Model dilatih dengan data dari berbagai kondisi cuaca
                                    ekstrem.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-0.5">
                                <i class="bi bi-check-lg text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <span class="text-gray-800 font-semibold">Mendukung Kearifan Lokal</span>
                                <p class="text-gray-500 text-sm">Antarmuka berbahasa Indonesia dengan istilah lokal
                                    yang dikenal petani.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mt-0.5">
                                <i class="bi bi-check-lg text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <span class="text-gray-800 font-semibold">Gratis dan Mudah Diakses</span>
                                <p class="text-gray-500 text-sm">Cukup dengan smartphone dan koneksi internet minimal.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Right Column: Image with Stats -->
                <div class="relative">
                    <!-- Main Image -->
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('backend-core/public/images/bg.png') }}"
                            alt="Petani Indonesia sedang bekerja di sawah padi" class="object-cover w-full h-full"
                            loading="lazy">
                    </div>

                    <!-- Floating Card 1: Speed -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-xl shadow-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <i class="bi bi-lightning-charge-fill text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Kecepatan Diagnosa</p>
                                <p class="text-xl font-extrabold text-gray-900">&lt; 2 <span
                                        class="text-sm font-medium text-gray-500">Detik</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Card 2: Accuracy -->
                    <div class="absolute -top-6 -right-6 bg-white p-5 rounded-xl shadow-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <i class="bi bi-graph-up-arrow text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Akurasi AI</p>
                                <p class="text-xl font-extrabold text-gray-900">93.15<span
                                        class="text-sm font-medium text-gray-500">%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FEATURES SECTION ==================== -->
    <section id="fitur" class="py-24 bg-gray-50" aria-labelledby="features-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 text-green-700 text-sm font-semibold mb-6 border border-green-200">
                    <i class="bi bi-stars"></i>
                    <span>Teknologi Unggulan</span>
                </div>
                <h2 id="features-heading" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Teknologi Canggih,<br>Antarmuka Membumi
                </h2>
                <p class="text-lg text-gray-600">
                    Arsitektur modern yang memadukan Machine Learning dengan desain
                    responsif untuk pengalaman pengguna terbaik.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Feature 1: AI Engine -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi bi-cpu-fill text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">AI Engine</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Dibangun dengan <strong>MobileNetV2</strong>, arsitektur CNN efisien
                        yang di-<em>fine-tune</em> khusus untuk mendeteksi 10 kelas penyakit
                        padi dengan akurasi tinggi.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-green-600 font-medium">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Akurasi 93.15%</span>
                    </div>
                </div>

                <!-- Feature 2: Architecture (Elevated) -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-lg border border-green-100 hover:shadow-2xl transition-all duration-300 transform md:-translate-y-4 ring-1 ring-green-200">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold">
                        <i class="bi bi-star-fill"></i> UNGGULAN
                    </div>
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi bi-diagram-3-fill text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Microservices</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Pemisahan layanan <strong>Web (Laravel)</strong> dan
                        <strong>AI Inference (FastAPI)</strong> memastikan performa
                        optimal dan skalabilitas tinggi.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-green-600 font-medium">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Response &lt; 200ms</span>
                    </div>
                </div>

                <!-- Feature 3: Local Wisdom UI -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi bi-people-fill text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Local Wisdom UI</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Antarmuka dengan <strong>tombol besar</strong>, bahasa Indonesia,
                        dan panduan visual yang ramah untuk petani segala usia.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-green-600 font-medium">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Mobile-Friendly</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== DISEASES SECTION ==================== -->
    <section id="penyakit" class="py-24 bg-white" aria-labelledby="diseases-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-red-700 text-sm font-semibold mb-6 border border-red-200">
                    <i class="bi bi-shield-exclamation"></i>
                    <span>10 Kelas Penyakit</span>
                </div>
                <h2 id="diseases-heading" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Penyakit yang Dapat Dideteksi
                </h2>
                <p class="text-lg text-gray-600">
                    AI kami dilatih untuk mengenali berbagai penyakit padi yang umum
                    menyerang di Indonesia.
                </p>
            </div>

            <!-- Diseases Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">

                <!-- Disease Card Template -->
                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Bacterial Leaf Blight</h4>
                    <p class="text-xs text-gray-500">Hawar Daun Bakteri / Kresek</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Bacterial Leaf Streak</h4>
                    <p class="text-xs text-gray-500">Bercak Daun Bakteri</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Bacterial Panicle Blight</h4>
                    <p class="text-xs text-gray-500">Hawar Malai Bakteri</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Blast</h4>
                    <p class="text-xs text-gray-500">Penyakit Blas</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Brown Spot</h4>
                    <p class="text-xs text-gray-500">Bercak Cokelat</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-orange-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                            <i class="bi bi-bug text-orange-500"></i>
                        </div>
                        <span class="text-xs font-bold text-orange-500">Hama</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Dead Heart</h4>
                    <p class="text-xs text-gray-500">Penggerek Batang / Beluk</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Penyakit</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Downy Mildew</h4>
                    <p class="text-xs text-gray-500">Bulu Embun</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-orange-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-100 transition-colors">
                            <i class="bi bi-bug text-orange-500"></i>
                        </div>
                        <span class="text-xs font-bold text-orange-500">Hama</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Hispa</h4>
                    <p class="text-xs text-gray-500">Hama Kumbang Hispa</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-red-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                            <i class="bi bi-bug-fill text-red-500"></i>
                        </div>
                        <span class="text-xs font-bold text-red-500">Virus</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Tungro</h4>
                    <p class="text-xs text-gray-500">Penyakit Tungro</p>
                </div>

                <div
                    class="group bg-white p-5 rounded-xl border border-gray-200 hover:border-green-300 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors">
                            <i class="bi bi-check-circle-fill text-green-500"></i>
                        </div>
                        <span class="text-xs font-bold text-green-500">Sehat</span>
                    </div>
                    <h4 class="font-bold text-gray-900 text-sm mb-1">Normal</h4>
                    <p class="text-xs text-gray-500">Padi Sehat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== TEAM SECTION ==================== -->
    <section id="tim" class="py-24 bg-gray-50" aria-labelledby="team-heading">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <!-- Section Header -->
            <div class="max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-semibold mb-6 border border-blue-200">
                    <i class="bi bi-people-fill"></i>
                    <span>Tim PECINTASAWIT</span>
                </div>
                <h2 id="team-heading" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Tim di Balik SEED
                </h2>
                <p class="text-lg text-gray-600">
                    Kolaborasi lintas disiplin ilmu untuk menghadirkan solusi
                    agrikultur cerdas bagi petani Indonesia.
                </p>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">

                <!-- Member 1: Tino Nurcahya -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="relative w-28 h-28 mx-auto mb-6">
                        <div
                            class="w-full h-full bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                            <i class="bi bi-person-fill text-white text-4xl"></i>
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                            <i class="bi bi-code-slash text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Tino Nurcahya</h3>
                    <p class="text-green-600 font-semibold mb-1">Frontend Engineer</p>
                    <p class="text-xs text-gray-400 mb-4">UI/UX & Blade Integration</p>
                    <p class="text-sm text-gray-500">
                        Merancang antarmuka yang intuitif dengan standar
                        <em>Local Wisdom</em>, memastikan aplikasi responsif
                        di semua perangkat.
                    </p>
                </div>

                <!-- Member 2: TIO Ramadhan -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-md border border-green-100 hover:shadow-xl transition-all duration-300 ring-1 ring-green-200 relative">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold">
                        <i class="bi bi-star-fill"></i> KETUA TIM
                    </div>
                    <div class="relative w-28 h-28 mx-auto mb-6 mt-2">
                        <div
                            class="w-full h-full bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                            <i class="bi bi-person-fill text-white text-4xl"></i>
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                            <i class="bi bi-server text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">TIO Ramadhan</h3>
                    <p class="text-green-600 font-semibold mb-1">Backend Engineer</p>
                    <p class="text-xs text-gray-400 mb-4">Laravel Core & API Gateway</p>
                    <p class="text-sm text-gray-500">
                        Membangun arsitektur <em>Microservices</em> yang tangguh,
                        API Gateway, dan memastikan sistem berjalan
                        dengan skalabilitas tinggi.
                    </p>
                </div>

                <!-- Member 3: Faiz Jihad Al Baihaqi -->
                <div
                    class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="relative w-28 h-28 mx-auto mb-6">
                        <div
                            class="w-full h-full bg-gradient-to-br from-purple-500 to-violet-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                            <i class="bi bi-person-fill text-white text-4xl"></i>
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center border-4 border-white">
                            <i class="bi bi-cpu-fill text-white text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Faiz Jihad Al Baihaqi</h3>
                    <p class="text-green-600 font-semibold mb-1">AI Engineer</p>
                    <p class="text-xs text-gray-400 mb-4">Data Preprocessing & Model Training</p>
                    <p class="text-sm text-gray-500">
                        Mengelola dataset, melakukan <em>Fine-Tuning</em>
                        MobileNetV2, dan mengembangkan Inference Engine
                        berbasis FastAPI.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA SECTION ==================== -->
    <section class="relative bg-gradient-to-br from-green-600 to-emerald-700 py-20 overflow-hidden"
        aria-labelledby="cta-heading">

        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" aria-hidden="true">
            <div class="absolute top-0 left-0 w-full h-full bg-pattern"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 text-white text-sm font-semibold mb-8 backdrop-blur-sm border border-white/30">
                <i class="bi bi-rocket-takeoff-fill"></i>
                <span>Siap Mencoba?</span>
            </div>

            <h2 id="cta-heading" class="text-3xl lg:text-4xl font-extrabold text-white mb-6">
                Deteksi Penyakit Padi Anda Sekarang
            </h2>

            <p class="text-green-50 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                Unggah foto daun atau malai padi dan dapatkan hasil analisis
                AI dalam hitungan detik. Gratis, cepat, dan akurat.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/diagnosa"
                    class="inline-flex items-center justify-center gap-3 px-10 py-5 text-lg font-bold rounded-xl text-green-700 bg-white hover:bg-gray-50 shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="bi bi-camera-fill text-2xl"></i>
                    <span>Mulai Analisis Daun</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <p class="text-green-200 text-sm mt-6">
                <i class="bi bi-shield-check"></i>
                Tidak memerlukan pendaftaran • Gratis digunakan
            </p>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-gray-900 text-gray-400 py-16" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Footer Top -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">

                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center">
                            <i class="bi bi-flower1 text-white text-xl"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-xl text-white">SEED</span>
                            <p class="text-xs text-gray-500">Smart Eco-Expert Detector</p>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Solusi deteksi cerdas penyakit padi berbasis AI
                        untuk mendukung ketahanan pangan Indonesia.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="#tentang" class="text-sm hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="#fitur" class="text-sm hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#penyakit" class="text-sm hover:text-white transition-colors">Penyakit</a></li>
                        <li><a href="#tim" class="text-sm hover:text-white transition-colors">Tim</a></li>
                    </ul>
                </div>

                <!-- Tech Stack -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Teknologi</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-xs font-medium">
                            <i class="bi bi-laravel"></i> Laravel
                        </span>
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-xs font-medium">
                            <i class="bi bi-speedometer2"></i> FastAPI
                        </span>
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-xs font-medium">
                            <i class="bi bi-cpu"></i> TensorFlow
                        </span>
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-xs font-medium">
                            <i class="bi bi-cpu-fill"></i> PyTorchMobileNetV2
                        </span>
                        <span class="px-3 py-1 bg-gray-800 rounded-full text-xs font-medium">
                            <i class="bi bi-palette"></i> Tailwind CSS
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-sm mb-2">
                    Dibangun dengan <i class="bi bi-heart-fill text-red-500"></i> oleh
                    <strong class="text-white">Tim PECINTASAWIT</strong>
                </p>
                <p class="text-xs">
                    &copy; 2026 SEED. Hak Cipta Dilindungi.
                    Proyek ini didedikasikan untuk Hackathon Climate Resilience & Local Wisdom.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
