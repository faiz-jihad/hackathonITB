@extends('layouts.app')

@section('content')
<style>
    @media print {
        /* Reset and Base Styles */
        @page { margin: 2cm; size: A4; }
        body { background: white !important; color: black !important; font-family: 'Inter', sans-serif !important; }
        .no-print, nav, footer, a[href="/"], button, .ph-plus-circle, .ph-printer { display: none !important; }
        
        /* Layout Adjustments */
        .max-w-6xl { max-width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .grid { display: block !important; }
        .lg\:col-span-4, .lg\:col-span-8 { width: 100% !important; margin-bottom: 2rem !important; }
        
        /* Card Styles */
        .bg-white, .bg-emerald-600, .bg-gray-50, .bg-blue-50, .bg-amber-50 { 
            background-color: white !important; 
            border: 1px solid #eee !important; 
            box-shadow: none !important; 
            color: black !important;
            border-radius: 1rem !important;
        }
        
        .text-white { color: black !important; }
        .text-emerald-100, .text-emerald-200, .text-blue-900, .text-amber-900 { color: #374151 !important; }
        
        /* Image Optimization */
        img { max-height: 300px !important; object-fit: contain !important; border-radius: 0.5rem !important; }
        
        /* Header & Brand for Print */
        .print-header { display: flex !important; align-items: center; justify-content: space-between; border-bottom: 2px solid #10b981; padding-bottom: 1rem; margin-bottom: 2rem; }
        .print-logo { height: 40px; }
        .print-title { font-size: 24px; font-weight: 800; color: #065f46; }
        
        /* Metadata */
        .print-meta { display: flex !important; gap: 2rem; font-size: 10px; color: #6b7280; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 0.1em; }
        
        /* Progress Bar for Print */
        .bg-gray-100 { background-color: #f3f4f6 !important; border: 1px solid #e5e7eb !important; }
        .bg-gradient-to-r { background: #10b981 !important; }
        
        /* Recommendation Sections */
        .prose { font-size: 12px !important; line-height: 1.6 !important; }
        h2, h3 { color: #065f46 !important; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; margin-top: 1.5rem !important; }
        
        /* Hide Tokopedia Catalog in Print if needed or make it simple */
        .grid-cols-1.sm\:grid-cols-2 { display: grid !important; grid-template-columns: 1fr 1fr !important; gap: 1rem !important; }
        
        /* Footer Signature */
        .print-footer { display: block !important; margin-top: 4rem; border-top: 1px solid #eee; pt-4; text-align: center; font-size: 10px; color: #9ca3af; }
    }
    
    /* Screen-only Styles */
    .print-header, .print-meta, .print-footer { display: none; }
</style>

<!-- Print-Only Header -->
<div class="print-header">
    <div class="flex items-center gap-3">
        <img src="/images/logo.png" alt="Logo" class="print-logo">
        <span class="print-title">S.E.E.D REPORT</span>
    </div>
    <div class="text-right">
        <p class="text-xs font-bold text-gray-500">Agricultural AI Diagnostic</p>
        <p class="text-[10px] text-gray-400 uppercase tracking-widest">v1.0 Production</p>
    </div>
</div>

<div class="print-meta">
    <div><strong>ID LAPORAN:</strong> #SP-{{ $diagnosa->id }}-{{ date('Ymd') }}</div>
    <div><strong>TANGGAL ANALISIS:</strong> {{ $diagnosa->created_at->format('d F Y H:i') }}</div>
    <div><strong>LOKASI:</strong> {{ $diagnosa->location_name ?? 'Koordinat Tersimpan' }}</div>
</div>

<div class="max-w-6xl mx-auto px-4 pb-12">
    <!-- Header Page -->
    <div class="flex items-center gap-3 mb-6 md:mb-10 no-print">
        <a href="/" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all active:scale-90">
            <i class="bi bi-arrow-left text-xl"></i>
        </a>
        <h2 class="text-2xl md:text-3xl font-heading font-black text-gray-900 tracking-tight">Hasil Analisis S.E.E.D</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-10">
        
        <!-- Left Column: Image & Confidence -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Image Card -->
            <div class="bg-white p-3 md:p-4 rounded-[2.5rem] shadow-xl border border-white overflow-hidden relative group">
                <div class="absolute top-6 right-6 bg-white/90 backdrop-blur px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1.5 z-10 border border-white/50 no-print">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-black text-gray-700 uppercase tracking-tighter">Analisis AI</span>
                </div>
                <img src="{{ asset('storage/' . $diagnosa->image_path) }}" alt="Daun Padi" class="w-full h-72 sm:h-80 md:h-64 object-cover rounded-[2rem] group-hover:scale-105 transition-transform duration-700">
            </div>

            <!-- Confidence Metric -->
            <div class="bg-white/70 backdrop-blur-md p-6 md:p-8 rounded-[2.5rem] shadow-xl border border-white">
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Computer Vision Confidence</h3>
                
                <div class="flex items-end justify-between mb-4">
                    <span class="text-5xl font-heading font-black text-gray-900 leading-none">
                        {{ number_format($diagnosa->accuracy, 1) }}<span class="text-2xl text-emerald-500 ml-0.5">%</span>
                    </span>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <i class="bi bi-bullseye text-2xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mb-6 font-medium leading-relaxed">Tingkat keyakinan model dalam mengidentifikasi pola penyakit pada sampel ini.</p>
                
                <!-- Progress bar -->
                <div class="w-full bg-gray-100/50 rounded-full h-3 mb-2 overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-full rounded-full transition-all duration-1000" style="width: {{ $diagnosa->accuracy }}%"></div>
                </div>
            </div>
        </div>

        <!-- Right Column: Results & Recommendation -->
        <div class="lg:col-span-8 space-y-6 md:space-y-8">
            
            <!-- Disease Identification Card -->
            <div class="bg-gradient-to-br from-emerald-600 to-emerald-900 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl relative overflow-hidden">
                <!-- Decorative elements -->
                <i class="bi bi-cpu text-9xl absolute -bottom-8 -right-8 text-white opacity-10 no-print"></i>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-xs font-bold mb-6 border border-white/10 uppercase tracking-widest no-print">
                        <i class="bi bi-check-circle-fill"></i> Identifikasi Akurat
                    </div>
                    <h3 class="text-sm font-bold text-emerald-200/80 mb-2 uppercase tracking-widest">Penyakit Terdeteksi:</h3>
                    <h2 class="text-3xl md:text-5xl font-heading font-black mb-6 leading-tight tracking-tight">{{ $diagnosa->disease_name }}</h2>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10 text-xs font-bold no-print">
                        <i class="bi bi-geo-alt-fill text-emerald-300"></i> {{ $diagnosa->location_name ?? 'Lokasi Terdeteksi' }}
                    </div>
                </div>
            </div>

            <!-- Weather Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @if(isset($weatherData))
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-3xl shadow-sm border border-white flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center">
                        <i class="bi bi-thermometer-half text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-gray-400 tracking-tighter">Suhu</p>
                        <p class="font-bold text-gray-900 text-sm">{{ $weatherData['temp'] }}</p>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-3xl shadow-sm border border-white flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <i class="bi bi-droplet text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-gray-400 tracking-tighter">Lembap</p>
                        <p class="font-bold text-gray-900 text-sm">{{ $weatherData['humidity'] }}</p>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1 bg-white/80 backdrop-blur-sm p-4 rounded-3xl shadow-sm border border-white flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <i class="bi bi-cloud-sun text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-black text-gray-400 tracking-tighter">Kondisi</p>
                        <p class="font-bold text-gray-900 text-sm">{{ $weatherData['condition'] }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Structured AI Recommendations -->
            <div class="space-y-6 md:space-y-10">
                <!-- Analisis Section -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-white overflow-hidden">
                    <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-heading font-black text-gray-900 flex items-center gap-3 uppercase tracking-tighter">
                            <i class="bi bi-search text-emerald-600"></i> Analisis Agronomi
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="prose prose-emerald max-w-none prose-p:leading-relaxed prose-p:text-gray-600 prose-p:text-sm md:prose-p:text-base">
                            {!! \Illuminate\Support\Str::markdown(is_array($diagnosa->recommendation) ? ($diagnosa->recommendation['Analisis'] ?? 'Data analisis tidak tersedia.') : $diagnosa->recommendation) !!}
                        </div>
                    </div>
                </div>

                @if(is_array($diagnosa->recommendation))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <!-- Langkah Preventif -->
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-white overflow-hidden flex flex-col">
                        <div class="bg-blue-50/50 px-8 py-5 border-b border-blue-100/50">
                            <h3 class="font-heading font-black text-blue-900 flex items-center gap-3 uppercase tracking-tighter text-sm md:text-base">
                                <i class="bi bi-shield-check"></i> Preventif
                            </h3>
                        </div>
                        <div class="p-8 flex-grow">
                            <div class="prose prose-blue max-w-none prose-sm prose-li:marker:text-blue-500 prose-li:text-gray-600">
                                {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['Langkah Preventif'] ?? 'N/A') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Rekomendasi Obat -->
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-white overflow-hidden flex flex-col">
                        <div class="bg-emerald-50/50 px-8 py-5 border-b border-emerald-100/50">
                            <h3 class="font-heading font-black text-emerald-900 flex items-center gap-3 uppercase tracking-tighter text-sm md:text-base">
                                <i class="bi bi-capsule"></i> Solusi Obat
                            </h3>
                        </div>
                        <div class="p-8 flex-grow">
                            <div class="prose prose-emerald max-w-none prose-sm prose-li:marker:text-emerald-500 prose-li:text-gray-600">
                                {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['Rekomendasi Obat'] ?? 'N/A') !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Katalog Produk (Tokopedia) -->
                @if(!empty($diagnosa->recommendation['Produk']))
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-white overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="font-heading font-black text-gray-900 flex items-center gap-3 uppercase tracking-tighter text-lg">
                                <i class="bi bi-cart3 text-emerald-600"></i> Katalog Produk
                            </h3>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Tersedia di Tokopedia</p>
                        </div>
                        <a href="https://www.tokopedia.com/search?q={{ urlencode($diagnosa->disease_name . ' padi') }}" target="_blank" class="text-emerald-600 font-bold text-xs hover:underline flex items-center gap-1 no-print">
                            Lihat Semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <div class="p-4 md:p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ min(count($diagnosa->recommendation['Produk']), 4) }} gap-4 md:gap-6">
                            @foreach($diagnosa->recommendation['Produk'] as $produk)
                            <div class="group block bg-white rounded-3xl border border-gray-100 hover:border-emerald-200 hover:shadow-xl transition-all duration-500 overflow-hidden">
                                <!-- Product Header -->
                                <div class="bg-gradient-to-br from-emerald-500 to-teal-700 p-5 relative">
                                    <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-md px-2 py-0.5 rounded-lg border border-white/20 no-print">
                                        <span class="text-[8px] font-black text-white uppercase tracking-widest">Store</span>
                                    </div>
                                    <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center mb-4">
                                        <i class="bi bi-box-seam text-white"></i>
                                    </div>
                                    <h4 class="font-bold text-white text-sm leading-tight line-clamp-2 h-10">{{ $produk['nama'] }}</h4>
                                </div>
                                <!-- Product Body -->
                                <div class="p-5 space-y-4">
                                    <div class="flex items-center gap-2 text-[10px] text-gray-500 font-bold uppercase tracking-tighter">
                                        <i class="bi bi-flask text-emerald-500"></i>
                                        <span class="truncate">{{ $produk['bahan_aktif'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-base font-black text-emerald-700">{{ $produk['harga'] }}</span>
                                        <a href="https://www.tokopedia.com/search?q={{ urlencode($produk['keyword'] ?? $produk['nama']) }}" target="_blank" class="no-print w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                                            <i class="bi bi-arrow-up-right text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-[11px] text-gray-400 mt-8 text-center bg-gray-50 py-3 rounded-2xl border border-dashed border-gray-200">
                            <i class="bi bi-info-circle mr-1"></i> Harga estimasi pasar. Pastikan cek deskripsi produk sebelum membeli.
                        </p>
                    </div>
                </div>
                @endif

                <!-- DIY Racikan Hemat -->
                @if(!empty($diagnosa->recommendation['DIY']))
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-white overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-8 py-6 border-b border-amber-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-amber-500 shadow-sm">
                                <i class="bi bi-flower1 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-heading font-black text-amber-900 uppercase tracking-tighter text-lg">Racikan Hemat</h3>
                                <p class="text-[10px] text-amber-600 font-bold uppercase tracking-widest">Obat Alami DIY & Kearifan Lokal</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="prose prose-amber max-w-none prose-sm md:prose-base prose-strong:text-amber-800 prose-li:marker:text-amber-500 prose-p:text-gray-700 leading-relaxed">
                            {!! \Illuminate\Support\Str::markdown($diagnosa->recommendation['DIY']) !!}
                        </div>
                    </div>
                </div>
                @endif

                @endif
            </div>
            
            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 no-print">
                <a href="/" class="flex-1 bg-white border-2 border-emerald-600 text-emerald-600 font-black py-4 rounded-2xl hover:bg-emerald-50 transition-all text-center flex items-center justify-center gap-3 shadow-lg shadow-emerald-100 active:scale-95">
                    <i class="bi bi-plus-circle text-xl"></i> Pindai Lagi
                </a>
                <button onclick="window.print()" class="flex-1 bg-gray-900 text-white font-black py-4 rounded-2xl hover:bg-gray-800 transition-all flex items-center justify-center gap-3 shadow-lg shadow-gray-200 active:scale-95">
                    <i class="bi bi-printer text-xl"></i> Cetak Hasil
                </button>
            </div>

        </div>
    </div>

    <!-- Print Footer -->
    <div class="print-footer">
        <p>Laporan ini dihasilkan secara otomatis oleh sistem AI MangsaPadi S.E.E.D.</p>
        <p>&copy; 2026 MangsaPadi - Hackathon Ketahanan Pangan Indonesia</p>
    </div>
</div>
@endsection
