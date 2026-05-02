@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50/30 to-teal-50/30" x-data="modernDiagnosa()">
    <!-- Floating Particles Background -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/3 right-1/4 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-teal-400/10 rounded-full blur-3xl animate-float-slow"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-8 md:py-12 relative z-10">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <!-- Status Pill -->
            <div class="inline-flex items-center gap-2 md:gap-3 px-4 md:px-5 py-2 md:py-2.5 rounded-full bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-sm mb-6 md:mb-8 hover:shadow-md transition-all duration-300 group cursor-default">
                <span class="relative flex h-2.5 w-2.5 md:h-3 md:w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 md:h-3 md:w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs md:text-sm font-medium text-gray-700">AI Engine Active</span>
                <span class="hidden sm:inline text-xs text-gray-400 border-l border-gray-300 pl-3 ml-1">MobileNetV2 + Gemini Flash</span>
                <i class="bi bi-chevron-right text-gray-400 text-xs group-hover:translate-x-1 transition-transform"></i>
            </div>

            <h1 class="text-4xl md:text-7xl font-heading font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">
                Diagnosa <span class="relative">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 via-teal-500 to-blue-600">
                        Penyakit Padi
                    </span>
                    <svg class="absolute -bottom-1 md:-bottom-2 left-0 w-full" viewBox="0 0 200 8" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 4 Q 50 0, 100 4 T 200 4" stroke="#10B981" stroke-width="2" fill="none" class="opacity-50"/>
                    </svg>
                </span> <br class="hidden md:block"/>
                <span class="text-2xl md:text-5xl">dengan AI Canggih</span>
            </h1>
            
            <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-8 px-4 md:px-0">
                Upload foto daun padi Anda dan dapatkan diagnosis instan dengan rekomendasi pengobatan berbasis 
                <span class="font-semibold text-gray-800">kecerdasan buatan</span> dan 
                <span class="font-semibold text-gray-800">kearifan lokal</span>.
            </p>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 max-w-3xl mx-auto px-2 md:px-0">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-3 md:p-4 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-xl md:text-3xl font-bold text-emerald-600">92<span class="text-base md:text-lg">%</span></div>
                    <div class="text-[10px] md:text-xs text-gray-500 mt-1 uppercase tracking-wider">Akurasi AI</div>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-3 md:p-4 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-xl md:text-3xl font-bold text-emerald-600">&lt;5<span class="text-base md:text-lg">s</span></div>
                    <div class="text-[10px] md:text-xs text-gray-500 mt-1 uppercase tracking-wider">Analisis Cepat</div>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-3 md:p-4 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-xl md:text-3xl font-bold text-emerald-600">10<span class="text-base md:text-lg">+</span></div>
                    <div class="text-[10px] md:text-xs text-gray-500 mt-1 uppercase tracking-wider">Jenis Hama</div>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-3 md:p-4 border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="text-xl md:text-3xl font-bold text-emerald-600"><i class="bi bi-translate"></i></div>
                    <div class="text-[10px] md:text-xs text-gray-500 mt-1 uppercase tracking-wider">Bahasa Lokal</div>
                </div>
            </div>
        </div>

        <!-- Error Alert -->
        @if(session('error'))
            <div class="mb-8 animate-slide-down" x-data="{ show: true }" x-show="show">
                <div class="bg-red-50/90 backdrop-blur-sm border border-red-200 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                            <i class="bi bi-exclamation-triangle text-2xl text-red-500"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-red-800 text-lg">Gagal Menganalisis</h3>
                            <p class="text-red-600 mt-1">{{ session('error') }}</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full flex items-center gap-1"><i class="bi bi-file-earmark-image"></i> Gunakan gambar JPG/PNG</span>
                                <span class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full flex items-center gap-1"><i class="bi bi-aspect-ratio"></i> Maks. 5MB</span>
                                <span class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full flex items-center gap-1"><i class="bi bi-search"></i> Pastikan fokus pada daun</span>
                            </div>
                        </div>
                        <button @click="show = false" class="text-red-400 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-100">
                            <i class="bi bi-x-lg text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Upload Card - Glassmorphism -->
        <div class="relative group/card">
            <!-- Glow Effect -->
            <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 via-teal-500 to-blue-500 rounded-[2rem] md:rounded-[2.5rem] opacity-0 group-hover/card:opacity-20 blur-xl transition-all duration-500"></div>
            
            <div class="relative bg-white/80 backdrop-blur-xl rounded-[2rem] md:rounded-[2.5rem] shadow-2xl border border-white/50 overflow-hidden">
                <!-- Card Header -->
                <div class="relative overflow-hidden bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 px-8 py-5">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <i class="bi bi-cpu text-xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">Upload Gambar untuk Diagnosis</h3>
                            <p class="text-emerald-100 text-sm">AI akan menganalisis dalam hitungan detik</p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-10">
                    <form action="/predict" method="POST" enctype="multipart/form-data" class="space-y-6" id="predict-form" onsubmit="handleFormSubmit(event)">
                        @csrf
                        
                        <input type="hidden" name="latitude" id="lat-input">
                        <input type="hidden" name="longitude" id="lng-input">
                        <input type="hidden" name="location_name" id="location-name-input">
                        <input type="hidden" name="weather_info" id="weather-info-input">

                        <!-- Info Bar -->
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- Location -->
                            <div id="location-badge" class="hidden flex-1 items-center gap-3 px-5 py-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 animate-fade-in group/loc">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <i class="bi bi-geo-alt-fill text-blue-600 text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs text-blue-400 font-semibold uppercase tracking-wider flex items-center gap-2">
                                        Lokasi Terdeteksi
                                        <button type="button" @click="getLocation()" class="hover:text-blue-600 transition-colors">
                                            <i class="bi bi-arrow-clockwise animate-spin-hover"></i>
                                        </button>
                                    </p>
                                    <p id="location-text" class="text-sm font-semibold text-blue-800 truncate">Mendeteksi...</p>
                                </div>
                                <span class="relative flex h-2.5 w-2.5 flex-shrink-0">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
                                </span>
                            </div>

                            <!-- Dynamic Weather (fetched via JS after geolocation) -->
                            <div id="weather-badge" class="hidden flex-1 items-center gap-3 px-5 py-4 rounded-2xl bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 animate-fade-in">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                    <i id="weather-icon" class="bi bi-cloud-sun text-emerald-600 text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p id="weather-label" class="text-[10px] text-emerald-500 font-semibold uppercase tracking-wider">Cuaca Lokasi Anda</p>
                                    <p id="weather-detail" class="text-sm font-bold text-emerald-800 truncate">Memuat cuaca...</p>
                                </div>
                            </div>

                            <!-- Tips (shown when weather not loaded yet) -->
                            <div id="tips-badge" class="flex-1 flex items-center gap-3 px-5 py-4 rounded-2xl bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                                    <i class="bi bi-lightbulb text-amber-600 text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-amber-400 font-semibold uppercase tracking-wider">Tips Foto</p>
                                    <p class="text-sm font-semibold text-amber-800">Pencahayaan cukup & fokus jelas</p>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Zone -->
                        <div class="relative" x-data="{ isDragging: false }">
                            <input 
                                type="file" 
                                name="image" 
                                id="image-upload" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" 
                                required 
                                accept="image/png, image/jpeg, image/jpg"
                                onchange="previewImage(this)"
                            >
                            
                            <div id="drop-zone"
                                class="relative rounded-3xl p-8 md:p-12 text-center transition-all duration-300 cursor-pointer overflow-hidden"
                                :class="isDragging ? 'bg-emerald-50 border-emerald-400 scale-[1.02]' : 'bg-gray-50/50 border-gray-200 hover:bg-gray-50 hover:border-emerald-300'"
                                :style="'border: 3px dashed ' + (isDragging ? '#34d399' : '#e5e7eb')"
                                @dragover.prevent="isDragging = true"
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="isDragging = false; handleDrop($event)"
                            >
                                <!-- Animated Background Pattern -->
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-teal-50/50"></div>
                                    <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                                                <circle cx="2" cy="2" r="1" fill="#10B981" fill-opacity="0.1"/>
                                            </pattern>
                                        </defs>
                                        <rect width="100%" height="100%" fill="url(#grid)"/>
                                    </svg>
                                </div>

                                <!-- Upload Prompt -->
                                <div id="upload-prompt" class="relative z-10">
                                    <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-white shadow-lg flex items-center justify-center group-hover:scale-110 group-hover:shadow-xl transition-all duration-300">
                                        <div class="relative">
                                            <i class="bi bi-cloud-arrow-up text-4xl text-emerald-500"></i>
                                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-white animate-pulse"></div>
                                        </div>
                                    </div>
                                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2">Upload Foto Daun Padi</h3>
                                    <p class="text-gray-500 mb-4 text-sm md:text-base">Seret & lepas atau <span class="text-emerald-600 font-semibold underline">klik untuk mencari</span></p>
                                    <div class="flex justify-center gap-6">
                                        <span class="inline-flex items-center gap-2 text-xs text-gray-400 bg-white/70 px-3 py-1.5 rounded-full shadow-sm">
                                            <i class="bi bi-file-image"></i> JPG, PNG
                                        </span>
                                        <span class="inline-flex items-center gap-2 text-xs text-gray-400 bg-white/70 px-3 py-1.5 rounded-full shadow-sm">
                                            <i class="bi bi-hdd-stack"></i> Maks 5MB
                                        </span>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div id="image-preview-container" class="hidden relative z-10">
                                    <div class="relative inline-block group/img">
                                        <img id="image-preview" src="" alt="Preview" class="max-h-64 rounded-2xl shadow-2xl border-4 border-white object-contain">
                                        <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity"></div>
                                        <button type="button" onclick="resetImage()" 
                                            class="absolute -top-3 -right-3 w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-lg hover:bg-red-600 hover:scale-110 transition-all duration-200 opacity-0 group-hover/img:opacity-100">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4">
                                        <p id="file-name" class="text-sm font-semibold text-gray-700"></p>
                                        <p id="file-size" class="text-xs text-gray-400 mt-1"></p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-3 bg-white/70 px-4 py-1.5 rounded-full inline-block shadow-sm">
                                        <i class="bi bi-mouse"></i> Klik area untuk ganti gambar
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn"
                            class="relative w-full group/btn overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 text-white font-bold py-5 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                            <span class="relative flex items-center justify-center gap-3 text-base md:text-lg">
                                <i class="bi bi-cpu text-lg md:text-xl group-hover/btn:animate-pulse"></i>
                                Mulai Diagnosa
                                <i class="bi bi-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                            </span>
                        </button>

                        <!-- Loading State -->
                        <div id="loading-state" class="hidden animate-fade-in">
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-8 border border-emerald-100 shadow-inner">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="relative">
                                        <div class="w-16 h-16 rounded-2xl bg-white shadow-lg flex items-center justify-center">
                                            <div class="animate-spin rounded-full h-8 w-8 border-3 border-emerald-200 border-t-emerald-600"></div>
                                        </div>
                                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center animate-pulse">
                                            <i class="bi bi-cpu text-white text-xs"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="font-bold text-emerald-800 text-lg">AI Sedang Menganalisis</h3>
                                        <p class="text-emerald-600 text-sm mt-1">Memproses gambar & mencari pola penyakit...</p>
                                    </div>
                                    <div class="w-full max-w-xs bg-emerald-200 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-600 h-full rounded-full animate-loading-bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-6 md:px-8 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-6 text-xs text-gray-500">
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-shield-lock text-emerald-500"></i> Privasi Terjamin
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="bi bi-lightning-charge text-emerald-500"></i> Proses Cepat
                        </span>
                    </div>
                    <span class="text-xs text-gray-400 flex items-center gap-1">
                        <i class="bi bi-info-circle"></i> Hasil sebagai referensi
                    </span>
                </div>
            </div>
        </div>

        <!-- Steps -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-2xl opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
                <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-7 border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-500 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg shadow-emerald-500/20">
                        1
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Ambil Foto Daun</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Foto bagian daun yang menunjukkan gejala penyakit dengan pencahayaan yang cukup</p>
                </div>
            </div>
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-cyan-400 rounded-2xl opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
                <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-7 border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-teal-500 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg shadow-teal-500/20">
                        2
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Analisis AI</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">AI menganalisis pola visual dan mengidentifikasi jenis penyakit dalam hitungan detik</p>
                </div>
            </div>
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-2xl opacity-0 group-hover:opacity-20 blur transition-all duration-300"></div>
                <div class="relative bg-white/80 backdrop-blur-sm rounded-2xl p-7 border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 text-white flex items-center justify-center text-xl font-bold mb-4 shadow-lg shadow-blue-500/20">
                        3
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Solusi & Rekomendasi</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Dapatkan diagnosis lengkap dengan panduan pengobatan dalam bahasa lokal</p>
                </div>
            </div>
        </div>

        <!-- Detectable Diseases Section -->
        <div class="mt-24">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-heading font-black text-gray-900 mb-4 tracking-tight">Apa Saja yang Bisa Dideteksi?</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">AI kami dilatih untuk mengenali berbagai kategori gangguan tanaman padi, mulai dari infeksi mikrob hingga serangan serangga.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Penyakit Card -->
                <div class="bg-white/70 backdrop-blur-sm rounded-[2rem] p-8 border border-white shadow-xl">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-3xl">
                            <i class="ph ph-plant text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Kategori Penyakit</h3>
                            <p class="text-xs text-emerald-600 font-bold uppercase tracking-widest mt-1">Bakteri, Jamur, & Virus</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'Bacterial Leaf Blight', 'local' => 'Kresek'],
                            ['name' => 'Bacterial Leaf Streak', 'local' => 'Godhong garis / Kresek garis'],
                            ['name' => 'Bacterial Panicle Blight', 'local' => 'Hawar malai / Malai bosok'],
                            ['name' => 'Blast', 'local' => 'Blas / Gulu padi patah'],
                            ['name' => 'Brown Spot', 'local' => 'Bercak coklat / Bintik godhong'],
                            ['name' => 'Downy Mildew', 'local' => 'Embun bulu / Jamur alus'],
                            ['name' => 'Tungro', 'local' => 'Tungro']
                        ] as $disease)
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-2xl bg-gray-50/50 border border-transparent hover:border-emerald-200 hover:bg-emerald-50 transition-all duration-300 gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-400 group-hover:scale-150 transition-transform"></div>
                                <span class="text-sm font-bold text-gray-700">{{ $disease['name'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter whitespace-nowrap">Nama Lokal:</span>
                                <span class="text-[11px] sm:text-xs bg-white px-3 py-1 rounded-full text-emerald-700 font-bold border border-emerald-100 shadow-sm flex-1 sm:flex-none text-center">
                                    {{ $disease['local'] }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hama Card -->
                <div class="bg-white/70 backdrop-blur-sm rounded-[2rem] p-6 md:p-8 border border-white shadow-xl">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center text-3xl">
                            <i class="ph ph-bug text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Kategori Hama</h3>
                            <p class="text-xs text-amber-600 font-bold uppercase tracking-widest mt-1">Serangga & Arthropoda</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach([
                            ['name' => 'Dead Heart', 'local' => 'Sundep / Beluk'],
                            ['name' => 'Hispa', 'local' => 'Kumbang Hispa'],
                            ['name' => 'Healthy Leaf', 'local' => 'Daun Sehat']
                        ] as $pest)
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-2xl bg-gray-50/50 border border-transparent hover:border-amber-200 hover:bg-amber-50 transition-all duration-300 gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-amber-400 group-hover:scale-150 transition-transform"></div>
                                <span class="text-sm font-bold text-gray-700">{{ $pest['name'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter whitespace-nowrap">Nama Lokal:</span>
                                <span class="text-[11px] sm:text-xs bg-white px-3 py-1 rounded-full text-amber-700 font-bold border border-amber-100 shadow-sm flex-1 sm:flex-none text-center">
                                    {{ $pest['local'] }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Empty space to align with the left card if needed -->
                        <div class="p-6 md:p-8 border-2 border-dashed border-gray-100 rounded-2xl flex flex-col items-center justify-center text-center">
                            <i class="bi bi-plus-circle text-gray-300 text-2xl mb-2"></i>
                            <p class="text-[10px] md:text-xs text-gray-400 font-medium italic">Kategori lainnya sedang <br>dalam proses training AI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Section -->
        <div class="mt-12 text-center">
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-white/60 backdrop-blur-sm px-4 md:px-5 py-2 md:py-3 rounded-full shadow-sm border border-gray-100 flex items-center gap-2 hover:shadow-md transition-all">
                    <i class="bi bi-patch-check text-emerald-500"></i>
                    <span class="text-xs md:text-sm text-gray-700 font-medium">AI Terverifikasi</span>
                </div>
                <div class="bg-white/60 backdrop-blur-sm px-4 md:px-5 py-2 md:py-3 rounded-full shadow-sm border border-gray-100 flex items-center gap-2 hover:shadow-md transition-all">
                    <i class="bi bi-globe2 text-emerald-500"></i>
                    <span class="text-xs md:text-sm text-gray-700 font-medium">Lokal & Akurat</span>
                </div>
                <div class="bg-white/60 backdrop-blur-sm px-4 md:px-5 py-2 md:py-3 rounded-full shadow-sm border border-gray-100 flex items-center gap-2 hover:shadow-md transition-all">
                    <i class="bi bi-graph-up-arrow text-emerald-500"></i>
                    <span class="text-xs md:text-sm text-gray-700 font-medium">Update Berkala</span>
                </div>
                <div class="bg-white/60 backdrop-blur-sm px-4 md:px-5 py-2 md:py-3 rounded-full shadow-sm border border-gray-100 flex items-center gap-2 hover:shadow-md transition-all">
                    <i class="bi bi-headset text-emerald-500"></i>
                    <span class="text-xs md:text-sm text-gray-700 font-medium">Dukungan 24/7</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function modernDiagnosa() {
        return {
            init() {
                this.getLocation();
            },
            getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            document.getElementById('lat-input').value = lat;
                            document.getElementById('lng-input').value = lng;
                            
                            const badge = document.getElementById('location-badge');
                            badge.classList.remove('hidden');
                            badge.classList.add('flex');
                            
                            // === 1. Reverse Geocoding (Nama Lokasi) ===
                             fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=14&accept-language=id`, {
                                headers: {
                                    'User-Agent': 'SEED-Rice-Diagnosis-App/1.0'
                                }
                            })
                                .then(res => res.json())
                                .then(data => {
                                    const addr = data.address;
                                    const village = addr.village || addr.suburb || addr.hamlet || '';
                                    const district = addr.district || addr.municipality || addr.city_district || '';
                                    const location = village ? `${village}, ${district}` : `${district}`;
                                    document.getElementById('location-text').textContent = location || 'Indonesia';
                                    document.getElementById('location-name-input').value = location || 'Indonesia';
                                })
                                .catch(() => {
                                    document.getElementById('location-text').textContent = `${lat.toFixed(4)}, ${lng.toFixed(4)}`;
                                    document.getElementById('location-name-input').value = `${lat},${lng}`;
                                });

                            // === 2. Fetch Cuaca Real-Time dari Open-Meteo (Gratis, tanpa API Key) ===
                            fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lng}&current=temperature_2m,relative_humidity_2m,weather_code&timezone=auto`)
                                .then(res => res.json())
                                .then(weatherData => {
                                    const current = weatherData.current;
                                    const temp = current.temperature_2m;
                                    const humidity = current.relative_humidity_2m;
                                    const weatherCode = current.weather_code;

                                    // Map WMO Weather Code ke deskripsi Bahasa Indonesia
                                    const weatherDesc = {
                                        0: 'Cerah', 1: 'Cerah Berawan', 2: 'Berawan Sebagian', 3: 'Berawan',
                                        45: 'Kabut', 48: 'Kabut Beku',
                                        51: 'Gerimis Ringan', 53: 'Gerimis', 55: 'Gerimis Lebat',
                                        61: 'Hujan Ringan', 63: 'Hujan Sedang', 65: 'Hujan Lebat',
                                        71: 'Salju Ringan', 73: 'Salju', 75: 'Salju Lebat',
                                        80: 'Hujan Lokal', 81: 'Hujan Sedang', 82: 'Hujan Sangat Lebat',
                                        95: 'Hujan Petir', 96: 'Hujan Petir + Es', 99: 'Hujan Petir Hebat'
                                    };

                                    // Map WMO code ke ikon Bootstrap
                                    const weatherIcons = {
                                        0: 'bi-sun', 1: 'bi-cloud-sun', 2: 'bi-cloud-sun', 3: 'bi-clouds',
                                        45: 'bi-cloud-fog', 48: 'bi-cloud-fog2',
                                        51: 'bi-cloud-drizzle', 53: 'bi-cloud-drizzle', 55: 'bi-cloud-drizzle',
                                        61: 'bi-cloud-rain', 63: 'bi-cloud-rain-heavy', 65: 'bi-cloud-rain-heavy',
                                        80: 'bi-cloud-rain', 81: 'bi-cloud-rain-heavy', 82: 'bi-cloud-rain-heavy',
                                        95: 'bi-cloud-lightning-rain', 96: 'bi-cloud-lightning-rain', 99: 'bi-cloud-lightning-rain'
                                    };

                                    const desc = weatherDesc[weatherCode] || 'Tidak Diketahui';
                                    const icon = weatherIcons[weatherCode] || 'bi-cloud-sun';

                                    // Update Weather Badge UI
                                    const weatherBadge = document.getElementById('weather-badge');
                                    document.getElementById('weather-icon').className = `bi ${icon} text-emerald-600 text-lg`;
                                    document.getElementById('weather-label').textContent = `Cuaca Saat Ini · ${desc}`;
                                    document.getElementById('weather-detail').textContent = `${temp}°C · Kelembaban ${humidity}%`;
                                    
                                    // Show weather, hide tips
                                    weatherBadge.classList.remove('hidden');
                                    weatherBadge.classList.add('flex');
                                    const tipsBadge = document.getElementById('tips-badge');
                                    if (tipsBadge) tipsBadge.classList.add('hidden');

                                    // Inject weather string ke hidden form input agar dikirim ke AI
                                    const weatherString = `Suhu: ${temp}°C, Kelambapan: ${humidity}%, Kondisi: ${desc}`;
                                    document.getElementById('weather-info-input').value = weatherString;
                                })
                                .catch(err => {
                                    console.warn('Gagal memuat cuaca:', err);
                                    // Cuaca gagal tidak fatal, Tips Badge tetap tampil
                                });
                        },
                        (error) => {
                            let msg = 'Indonesia (Default)';
                            switch(error.code) {
                                case error.PERMISSION_DENIED:
                                    msg = 'Izin lokasi ditolak';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    msg = 'Lokasi tidak tersedia';
                                    break;
                                case error.TIMEOUT:
                                    msg = 'Waktu deteksi habis';
                                    break;
                            }
                            document.getElementById('location-text').textContent = msg;
                            document.getElementById('location-name-input').value = 'Indonesia';
                            document.getElementById('location-badge').classList.remove('hidden');
                            document.getElementById('location-badge').classList.add('flex');
                            
                            if (window.location.protocol !== 'https:' && window.location.hostname !== 'localhost') {
                                console.warn('Geolocation requires HTTPS for non-localhost origins.');
                            }
                        },
                        { enableHighAccuracy: true, timeout: 10000, maximumAge: 300000 }
                    );
                } else {
                    document.getElementById('location-text').textContent = 'Browser tidak mendukung GPS';
                    document.getElementById('location-badge').classList.remove('hidden');
                    document.getElementById('location-badge').classList.add('flex');
                }
            },
            handleDrop(e) {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    document.getElementById('image-upload').files = files;
                    previewImage(document.getElementById('image-upload'));
                }
            }
        }
    }

     function handleFormSubmit(e) {
        const submitBtn = document.getElementById('submit-btn');
        const loadingState = document.getElementById('loading-state');
        const uploadZone = document.getElementById('drop-zone');
        
        // Show Global Loader (if defined in layouts/app.blade.php)
        if (typeof showLoading === 'function') {
            showLoading();
        }

        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        
        // Hide upload zone and show local loading state
        uploadZone.classList.add('opacity-20', 'pointer-events-none');
        loadingState.classList.remove('hidden');
        loadingState.classList.add('flex');
        
        // Scroll smoothly to the loading state
        setTimeout(() => {
            loadingState.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 100);
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            if (input.files[0].size > 5 * 1024 * 1024) {
                alert('⚠️ Ukuran file terlalu besar. Maksimal 5MB.');
                input.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('upload-prompt').classList.add('hidden');
                const previewContainer = document.getElementById('image-preview-container');
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex', 'flex-col', 'items-center');
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('file-name').textContent = '📄 ' + input.files[0].name;
                
                const size = input.files[0].size;
                const sizeStr = size < 1048576 ? (size / 1024).toFixed(1) + ' KB' : (size / 1048576).toFixed(1) + ' MB';
                document.getElementById('file-size').textContent = '📦 ' + sizeStr;
                
                // Update tips
                const tipsBadge = document.getElementById('tips-badge');
                tipsBadge.innerHTML = `
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <i class="bi bi-check-circle text-emerald-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-emerald-400 font-semibold uppercase tracking-wider">Gambar Siap</p>
                        <p class="text-sm font-semibold text-emerald-800">Klik "Mulai Diagnosa"</p>
                    </div>
                `;
                tipsBadge.classList.remove('from-amber-50', 'to-yellow-50', 'border-amber-100');
                tipsBadge.classList.add('from-emerald-50', 'to-teal-50', 'border-emerald-100');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetImage() {
        document.getElementById('upload-prompt').classList.remove('hidden');
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex', 'flex-col', 'items-center');
        document.getElementById('image-preview').src = '';
        document.getElementById('file-name').textContent = '';
        document.getElementById('file-size').textContent = '';
        document.getElementById('image-upload').value = '';
        
        const tipsBadge = document.getElementById('tips-badge');
        tipsBadge.innerHTML = `
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                <i class="bi bi-lightbulb text-amber-600 text-lg"></i>
            </div>
            <div>
                <p class="text-xs text-amber-400 font-semibold uppercase tracking-wider">Tips Foto</p>
                <p class="text-sm font-semibold text-amber-800">Pencahayaan cukup & fokus jelas</p>
            </div>
        `;
        tipsBadge.classList.remove('from-emerald-50', 'to-teal-50', 'border-emerald-100');
        tipsBadge.classList.add('from-amber-50', 'to-yellow-50', 'border-amber-100');
    }
</script>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(-3deg); }
    }
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    @keyframes slide-down {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes loading-bar {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delayed { animation: float-delayed 8s ease-in-out infinite 1s; }
    .animate-float-slow { animation: float-slow 10s ease-in-out infinite 2s; }
    .animate-slide-down { animation: slide-down 0.4s ease-out; }
    .animate-fade-in { animation: fade-in 0.5s ease-out; }
    .animate-loading-bar { animation: loading-bar 2s ease-in-out infinite; }
    .animate-spin-hover:hover { 
        animation: spin 1s linear infinite; 
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection