@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Page -->
    <div class="flex items-center gap-3 mb-8">
        <a href="/" class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 transition-colors">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h2 class="text-3xl font-heading font-bold text-gray-900">Hasil Analisis S.E.E.D</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Image & Confidence -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Image Card -->
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative group">
                <div class="absolute top-6 right-6 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow-sm flex items-center gap-1 z-10">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-gray-700">Tersimpan</span>
                </div>
                <img src="{{ asset('storage/' . $diagnosa->image_path) }}" alt="Daun Padi" class="w-full h-64 object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Confidence Metric -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Metrik Computer Vision</h3>
                
                <div class="flex items-end justify-between mb-2">
                    <span class="text-4xl font-heading font-bold text-gray-900">{{ number_format($diagnosa->accuracy, 1) }}<span class="text-2xl text-gray-400">%</span></span>
                    <i class="bi bi-bullseye text-3xl text-emerald-500 mb-1"></i>
                </div>
                <p class="text-sm text-gray-600 mb-4">Tingkat Keyakinan Prediksi AI</p>
                
                <!-- Progress bar -->
                <div class="w-full bg-gray-100 rounded-full h-2.5 mb-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-2.5 rounded-full transition-all duration-1000" style="width: {{ $diagnosa->accuracy }}%"></div>
                </div>
            </div>
        </div>

        <!-- Right Column: Results & Recommendation -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Disease Identification Card -->
            <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-8 text-white shadow-lg relative overflow-hidden">
                <!-- Decorative elements -->
                <i class="bi bi-cpu text-9xl absolute -bottom-4 -right-4 text-white opacity-10"></i>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-sm font-medium mb-4">
                        <i class="bi bi-check-circle"></i> Identifikasi Selesai
                    </div>
                    <h3 class="text-sm font-medium text-emerald-100 mb-1">Penyakit Terdeteksi:</h3>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold mb-2">{{ $diagnosa->disease_name }}</h2>
                    <div class="inline-flex items-center gap-2 px-3 py-2 rounded-2xl bg-blue-500/20 backdrop-blur-md border border-white/10 text-xs font-medium mt-4">
                        <i class="bi bi-geo-alt"></i> {{ $diagnosa->location_name ?? 'Lokasi Terdeteksi' }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if(isset($weatherData))
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                        <i class="bi bi-thermometer-half text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400">Suhu Udara</p>
                        <p class="font-bold text-gray-900">{{ $weatherData['temp'] }}</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <i class="bi bi-droplet text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400">Kelembapan</p>
                        <p class="font-bold text-gray-900">{{ $weatherData['humidity'] }}</p>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <i class="bi bi-cloud-sun text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400">Kondisi Lokal</p>
                        <p class="font-bold text-gray-900">{{ $weatherData['condition'] }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Structured AI Recommendations -->
            <div class="space-y-6">
                <!-- Analisis Section -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-heading font-bold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-search text-emerald-600"></i> Analisis Pakar Agronomi
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="prose prose-emerald max-w-none prose-p:leading-relaxed prose-p:text-gray-700">
                            {!! \Illuminate\Support\Str::markdown(is_array($diagnosa->recommendation) ? ($diagnosa->recommendation['Analisis'] ?? 'Data analisis tidak tersedia.') : $diagnosa->recommendation) !!}
                        </div>
                    </div>
                </div>

                @if(is_array($diagnosa->recommendation))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Langkah Preventif -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-blue-50 px-8 py-4 border-b border-blue-100">
                            <h3 class="font-heading font-bold text-blue-900 flex items-center gap-2">
                                <i class="bi bi-shield-check"></i> Langkah Preventif
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="prose prose-blue max-w-none prose-sm prose-li:marker:text-blue-500">
                                {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['Langkah Preventif'] ?? 'N/A') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Rekomendasi Obat -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-emerald-50 px-8 py-4 border-b border-emerald-100">
                            <h3 class="font-heading font-bold text-emerald-900 flex items-center gap-2">
                                <i class="bi bi-capsule"></i> Rekomendasi Obat/Teknis
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="prose prose-emerald max-w-none prose-sm prose-li:marker:text-emerald-500">
                                {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['Rekomendasi Obat'] ?? 'N/A') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Katalog Produk (Tokopedia) -->
                @if(!empty($diagnosa->recommendation['Produk']))
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-4 border-b border-emerald-100 flex items-center justify-between">
                        <h3 class="font-heading font-bold text-gray-900 flex items-center gap-2">
                            <i class="bi bi-cart3 text-green-600"></i> Katalog Produk — Beli Online
                        </h3>
                        <span class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold">via Tokopedia</span>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ min(count($diagnosa->recommendation['Produk']), 4) }} gap-4">
                            @foreach($diagnosa->recommendation['Produk'] as $produk)
                            <a href="https://www.tokopedia.com/search?q={{ urlencode($produk['keyword'] ?? $produk['nama']) }}" 
                               target="_blank" rel="noopener"
                               class="group block bg-white rounded-2xl border border-gray-200 hover:border-emerald-300 hover:shadow-lg transition-all duration-300 overflow-hidden">
                                <!-- Product Header -->
                                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 p-4 relative">
                                    <div class="absolute top-2 right-2 bg-white/20 backdrop-blur-sm px-2 py-0.5 rounded-full">
                                        <span class="text-[9px] font-bold text-white uppercase tracking-wide">Beli</span>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center mb-2">
                                        <i class="bi bi-box-seam text-xl text-white"></i>
                                    </div>
                                    <h4 class="font-bold text-white text-sm leading-tight">{{ $produk['nama'] }}</h4>
                                </div>
                                <!-- Product Body -->
                                <div class="p-4 space-y-2">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <i class="bi bi-flask text-emerald-500"></i>
                                        <span>{{ $produk['bahan_aktif'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-emerald-700">{{ $produk['harga'] }}</span>
                                    </div>
                                    <div class="pt-2 border-t border-gray-100 flex items-center justify-between">
                                        <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                            <svg viewBox="0 0 24 24" class="w-3 h-3" fill="#42B549"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                                            Tokopedia
                                        </span>
                                        <i class="bi bi-arrow-up-right text-emerald-500 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform text-xs"></i>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <p class="text-[11px] text-gray-400 mt-4 text-center">
                            <i class="bi bi-info-circle"></i> Harga bersifat estimasi. Klik produk untuk melihat harga terbaru di Tokopedia.
                        </p>
                    </div>
                </div>
                @endif

                <!-- DIY Racikan Hemat -->
                @if(!empty($diagnosa->recommendation['DIY']))
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-4 border-b border-amber-100">
                        <h3 class="font-heading font-bold text-amber-900 flex items-center gap-2">
                            <i class="bi bi-flower1 text-amber-500"></i> Racikan Hemat — Obat Alami DIY
                        </h3>
                        <p class="text-xs text-amber-600 mt-1">Hemat pengeluaran dengan bahan-bahan yang tersedia di sekitar Anda</p>
                    </div>
                    <div class="p-8">
                        <div class="prose prose-amber max-w-none prose-sm prose-strong:text-amber-800 prose-li:marker:text-amber-500">
                            {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['DIY']) !!}
                        </div>
                    </div>
                </div>
                @endif

                @endif
            </div>
            
            <!-- Actions -->
            <div class="flex gap-4">
                <a href="/" class="flex-1 bg-white border-2 border-emerald-600 text-emerald-600 font-semibold py-3 rounded-xl hover:bg-emerald-50 transition-colors text-center flex items-center justify-center gap-2">
                    <i class="bi bi-plus-circle text-xl"></i> Pindai Lagi
                </a>
                <button onclick="window.print()" class="flex-1 bg-gray-900 text-white font-semibold py-3 rounded-xl hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <i class="bi bi-printer text-xl"></i> Cetak Hasil
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
