@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-4 md:py-8" x-data="{ 
    activeTab: 'semua',
    searchQuery: '',
    showDetail: null
}">

    {{-- ===== HERO SECTION ===== --}}
    <div class="relative rounded-[2rem] md:rounded-[3rem] overflow-hidden mb-10 md:mb-16 shadow-2xl min-h-[300px] md:min-h-[400px] flex items-center justify-center">
        <div class="absolute inset-0">
            <img src="{{ asset('images/bg.png') }}" alt="Rice Paddy" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-emerald-900/40 backdrop-blur-[2px]"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-emerald-900/20 to-emerald-900/60"></div>
        </div>
        <div class="relative z-10 px-6 py-12 md:py-32 text-center text-white">
            <div class="inline-flex items-center gap-2 bg-emerald-500/20 backdrop-blur-md border border-white/20 text-emerald-300 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <i class="bi bi-mortarboard"></i>
                <span>Pusat Edukasi Lengkap</span>
            </div>
            <h2 class="text-3xl md:text-7xl font-heading font-bold mb-4 md:mb-6 tracking-tight">
                Pusat Edukasi <span class="text-emerald-400 italic">S.E.E.D</span>
            </h2>
            <p class="text-lg md:text-2xl text-emerald-50/90 max-w-3xl mx-auto font-light leading-relaxed mb-8 md:mb-10">
                Sistem Edukasi &amp; Evaluasi Diagnostik: Memahami penyakit padi melalui kecerdasan buatan dengan kearifan lokal.
            </p>
            <div class="flex flex-wrap justify-center gap-4 mt-6">
                <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-5 py-2.5 rounded-full text-sm flex items-center gap-2 hover:bg-white/20 transition-all cursor-default">
                    <i class="bi bi-translate text-emerald-400"></i> Terminologi Jawa
                </span>
                <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-5 py-2.5 rounded-full text-sm flex items-center gap-2 hover:bg-white/20 transition-all cursor-default">
                    <i class="bi bi-leaf text-emerald-400"></i> Panduan Lengkap
                </span>
                <span class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-5 py-2.5 rounded-full text-sm flex items-center gap-2 hover:bg-white/20 transition-all cursor-default">
                    <i class="bi bi-flask text-emerald-400"></i> Solusi Terpadu
                </span>
            </div>
        </div>
    </div>

    {{-- ===== FEATURES GRID ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-20">
        <div class="bg-white/70 backdrop-blur-md p-8 rounded-3xl shadow-xl shadow-emerald-500/5 border border-white/50 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100/80 backdrop-blur-sm text-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="bi bi-cpu text-3xl font-bold"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-3">AI Vision</h3>
                <p class="text-gray-600 leading-relaxed">MobileNetV2 dilatih dengan ribuan gambar daun padi untuk identifikasi pola penyakit secara instan.</p>
                <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-600">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Akurasi 95%+</span>
                </div>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-md p-8 rounded-3xl shadow-xl shadow-blue-500/5 border border-white/50 hover:shadow-2xl hover:shadow-blue-500/10 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-500/10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 rounded-2xl bg-blue-100/80 backdrop-blur-sm text-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="bi bi-magic text-3xl font-bold"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-3">RAG &amp; Gemini Flash</h3>
                <p class="text-gray-600 leading-relaxed">Gabungkan ilmu agronomi modern dan kearifan lokal untuk saran yang cerdas dan relevan.</p>
                <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-blue-600">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Database Terintegrasi</span>
                </div>
            </div>
        </div>

        <div class="bg-white/70 backdrop-blur-md p-8 rounded-3xl shadow-xl shadow-purple-500/5 border border-white/50 hover:shadow-2xl hover:shadow-purple-500/10 transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 rounded-2xl bg-purple-100/80 backdrop-blur-sm text-purple-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="bi bi-people text-3xl font-bold"></i>
                </div>
                <h3 class="text-xl font-heading font-bold text-gray-900 mb-3">Komunitas Petani</h3>
                <p class="text-gray-600 leading-relaxed">Terhubung dengan sesama petani dan ahli agronomi untuk berbagi pengalaman dan solusi.</p>
                <div class="mt-6 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-purple-600">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Dukungan 24/7</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== HOW IT WORKS ===== --}}
    <div class="mb-12 md:mb-16 bg-white/50 backdrop-blur-xl rounded-[2rem] md:rounded-[3rem] p-8 md:p-12 border border-white/50 shadow-xl overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-heading font-bold mb-3 text-center text-gray-900">Bagaimana Cara Kerjanya?</h3>
            <p class="text-center text-gray-500 mb-12 max-w-xl mx-auto">Proses diagnosis tanaman padi Anda dalam 4 langkah mudah dan cepat</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 text-emerald-600 flex items-center justify-center mx-auto mb-6 text-3xl group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                        <i class="bi bi-camera"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">1. Ambil Foto</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Foto daun padi yang menunjukkan gejala penyakit dengan jelas</p>
                    <div class="hidden md:block absolute top-10 -right-4 text-emerald-500/30 text-3xl font-light">→</div>
                </div>
                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-blue-500/10 backdrop-blur-md border border-blue-500/20 text-blue-600 flex items-center justify-center mx-auto mb-6 text-3xl group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">2. Upload</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Upload gambar ke sistem S.E.E.D dengan sekali klik</p>
                    <div class="hidden md:block absolute top-10 -right-4 text-blue-500/30 text-3xl font-light">→</div>
                </div>
                <div class="relative text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-purple-500/10 backdrop-blur-md border border-purple-500/20 text-purple-600 flex items-center justify-center mx-auto mb-6 text-3xl group-hover:bg-purple-500 group-hover:text-white transition-all duration-300">
                        <i class="bi bi-microscope"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">3. Analisis AI</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">AI menganalisis pola dan identifikasi penyakit secara instan</p>
                    <div class="hidden md:block absolute top-10 -right-4 text-purple-500/30 text-3xl font-light">→</div>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 rounded-2xl bg-orange-500/10 backdrop-blur-md border border-orange-500/20 text-orange-600 flex items-center justify-center mx-auto mb-6 text-3xl group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3 text-gray-900">4. Hasil &amp; Solusi</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Dapatkan diagnosis lengkap dengan kearifan lokal</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== QUICK STATS BANNER ===== --}}
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-3xl p-8 mb-12 md:mb-16 text-white shadow-xl shadow-emerald-900/20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="text-4xl font-bold mb-1">10+</div>
                <div class="text-emerald-200 text-sm">Penyakit &amp; Hama</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1">92%</div>
                <div class="text-emerald-200 text-sm">Akurasi AI</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1">&lt; 5s</div>
                <div class="text-emerald-200 text-sm">Waktu Analisis</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-1 flex justify-center"><i class="bi bi-translate"></i></div>
                <div class="text-emerald-200 text-sm">Terminologi Lokal</div>
            </div>
        </div>
    </div>

    {{-- ===== ENCYCLOPEDIA SECTION ===== --}}
    <div class="mb-16">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-heading font-bold text-gray-900">Ensiklopedia Hama &amp; Penyakit Padi</h3>
                <p class="text-gray-600 mt-1">Dilengkapi dengan istilah lokal bahasa Jawa untuk memudahkan petani</p>
            </div>
            <div class="w-full md:w-auto">
                <div class="relative">
                    <input type="text" x-model="searchQuery" placeholder="Cari penyakit atau hama..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-full text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 w-full md:w-64">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap gap-2 mb-8 justify-center md:justify-start">
            <button @click="activeTab = 'semua'"
                :class="activeTab === 'semua' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-collection"></i> Semua
            </button>
            <button @click="activeTab = 'jamur'"
                :class="activeTab === 'jamur' ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-patch-minus"></i> Jamur
            </button>
            <button @click="activeTab = 'bakteri'"
                :class="activeTab === 'bakteri' ? 'bg-green-600 text-white shadow-lg shadow-green-600/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-bug"></i> Bakteri
            </button>
            <button @click="activeTab = 'virus'"
                :class="activeTab === 'virus' ? 'bg-red-500 text-white shadow-lg shadow-red-500/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-capsule"></i> Virus
            </button>
            <button @click="activeTab = 'hama'"
                :class="activeTab === 'hama' ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-insect"></i> Hama
            </button>
            <button @click="activeTab = 'nematoda'"
                :class="activeTab === 'nematoda' ? 'bg-pink-500 text-white shadow-lg shadow-pink-500/20' : 'bg-white/70 backdrop-blur-md text-gray-700 border border-white/50'"
                class="px-5 py-2.5 rounded-full text-sm font-bold transition-all flex items-center gap-2">
                <i class="bi bi-infinity"></i> Nematoda
            </button>
        </div>

        {{-- Encyclopedia Cards --}}
        <div class="space-y-6">

            {{-- ==================== JAMUR ==================== --}}
            <template x-if="activeTab === 'semua' || activeTab === 'jamur'">
                <div class="grid grid-cols-1 gap-6">

                    {{-- Blast --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-amber-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'blast blas piras gulu padi patah'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-100/80 backdrop-blur-sm text-amber-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-patch-minus text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Blast (Blas)</h4>
                                                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-medium">Pyricularia oryzae</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Blas</strong>, kadang disebut "<strong>Gulu Padi Patah</strong>"</p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Disebabkan oleh jamur <em>Magnaporthe oryzae</em>. Gejala berupa bercak berbentuk belah ketupat pada daun dengan pusat berwarna abu-abu dan tepi coklat kemerahan.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-amber-50/80 backdrop-blur-sm rounded-2xl p-4 border border-amber-100/50">
                                            <span class="text-amber-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Bercak belah ketupat, pusat abu-abu, tepi coklat kemerahan. Leher malai busuk (gulu padi patah)</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Fungisida sistemik, tanam varietas tahan, hindari pemupukan N berlebihan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Brown Spot --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-amber-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'brown spot bercak coklat bintik coklat nang godhong'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-100/80 backdrop-blur-sm text-amber-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-wind text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Brown Spot (Bercak Coklat)</h4>
                                                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-medium">Cochliobolus miyabeanus</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Bercak coklat</strong>, <strong>Bintik coklat nang godhong</strong></p>
                                        </div>
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟡 Moderate</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Bercak coklat bulat atau oval pada daun dan gabah. Umumnya muncul pada tanah yang kekurangan unsur hara, terutama silikon dan kalium.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-amber-50/80 backdrop-blur-sm rounded-2xl p-4 border border-amber-100/50">
                                            <span class="text-amber-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Bintik coklat bundar kecil pada daun, berkembang menjadi bercak oval dengan halo kuning</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Pemupukan berimbang (terutama Si &amp; K), fungisida mancozeb, pengelolaan air baik</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Downy Mildew --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-amber-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'downy mildew embun bulu jamur alus'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-100/80 backdrop-blur-sm text-amber-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-cloud-haze2 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Downy Mildew (Embun Bulu)</h4>
                                                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-medium">Sclerophthora macrospora</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Embun bulu</strong>, <strong>Embun jamur</strong>, <strong>Jamur alus</strong></p>
                                        </div>
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟡 Moderate</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Muncul lapisan putih keabuan seperti tepung/bulu halus pada permukaan daun. Tumbuh subur pada kondisi lembab dengan sirkulasi udara buruk.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-amber-50/80 backdrop-blur-sm rounded-2xl p-4 border border-amber-100/50">
                                            <span class="text-amber-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Lapisan putih seperti tepung/bulu halus pada permukaan atas dan bawah daun</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Fungisida kontak (mancozeb), perbaiki drainase, jarak tanam tidak terlalu rapat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sheath Blight --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-amber-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'sheath blight hawar pelepah hawarselubung'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-100/80 backdrop-blur-sm text-amber-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-layers text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Sheath Blight (Hawar Pelepah)</h4>
                                                <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full font-medium">Rhizoctonia solani</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Hawarselubung</strong>, <strong>Penyakit selubung godhong</strong></p>
                                        </div>
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟠 Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Menyerang pelepah daun dekat permukaan air, membentuk bercak oval berwarna abu-abu kehijauan dengan tepi coklat.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-amber-50/80 backdrop-blur-sm rounded-2xl p-4 border border-amber-100/50">
                                            <span class="text-amber-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Bercak oval pada pelepah dekat air, berwarna abu-abu kehijauan dengan tepi coklat</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Fungisida validamycin, kurangi pupuk N, tanam varietas tahan, drainase baik</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            {{-- ==================== BAKTERI ==================== --}}
            <template x-if="activeTab === 'semua' || activeTab === 'bakteri'">
                <div class="grid grid-cols-1 gap-6">

                    {{-- Bacterial Leaf Blight --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-green-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'bacterial leaf blight kresek kresekgodhong'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-green-100/80 backdrop-blur-sm text-green-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-bug text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Bacterial Leaf Blight (Kresek)</h4>
                                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium">Xanthomonas oryzae</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Kresek</strong></p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Daun menguning dari tepi, terdapat lesi bergelombang berwarna putih kekuningan. Disebut "kresek" karena daun terdengar seperti kresek saat dipegang.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-green-50/80 backdrop-blur-sm rounded-2xl p-4 border border-green-100/50">
                                            <span class="text-green-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Menguning dari tepi daun, lesi bergelombang putih kekuningan, daun seperti terbakar</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Bakterisida tembaga, varietas tahan, drainase baik, hindari genangan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bacterial Leaf Streak --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-green-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'bacterial leaf streak godhong garis kresek garis'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-green-100/80 backdrop-blur-sm text-green-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-distribute-vertical text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Bacterial Leaf Streak</h4>
                                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium">Xanthomonas oryzicola</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Godhong garis bakteri</strong>, <strong>Kresek garis</strong></p>
                                        </div>
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟠 Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Bercak berupa garis-garis transparan memanjang di antara tulang daun, berubah menjadi coklat kekuningan.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-green-50/80 backdrop-blur-sm rounded-2xl p-4 border border-green-100/50">
                                            <span class="text-green-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Garis-garis transparan memanjang antar tulang daun, berubah coklat kekuningan</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Benih sehat bersertifikat, bakterisida tembaga, sanitasi lahan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bacterial Panicle Blight --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-green-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-green-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'bacterial panicle blight hawar malai malai bosok'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-green-100/80 backdrop-blur-sm text-green-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-flower3 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Hawar Malai</h4>
                                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-medium">Burkholderia glumae</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Hawar malai</strong>, <strong>Malai bosok</strong></p>
                                        </div>
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟠 Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Menyerang malai padi saat fase pembungaan, menyebabkan gabah hampa atau berubah warna menjadi coklat kehitaman.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-green-50/80 backdrop-blur-sm rounded-2xl p-4 border border-green-100/50">
                                            <span class="text-green-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Malai busuk berwarna coklat kehitaman, banyak gabah hampa</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Waktu tanam tepat, bakterisida, gunakan benih sehat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            {{-- ==================== VIRUS ==================== --}}
            <template x-if="activeTab === 'semua' || activeTab === 'virus'">
                <div class="grid grid-cols-1 gap-6">

                    {{-- Tungro --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-red-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'tungro'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-red-100/80 backdrop-blur-sm text-red-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-capsule text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Tungro</h4>
                                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-medium">RTBV + RTSV</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Tungro</strong></p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Tanaman menjadi kerdil dan daun berubah warna menjadi kuning-oranye kemerahan. Disebarkan oleh wereng hijau.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-red-50/80 backdrop-blur-sm rounded-2xl p-4 border border-red-100/50">
                                            <span class="text-red-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Tanaman kerdil, daun kuning-oranye, jumlah anakan berkurang drastis</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Insektisida untuk wereng, tanam serempak, varietas tahan wereng</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Rice Grassy Stunt --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-red-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'grassy stunt padi kerdil rumput'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-red-100/80 backdrop-blur-sm text-red-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-tree text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Padi Kerdil Rumput</h4>
                                                <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-medium">RGSV</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Padi kerdil rumput</strong>, <strong>Padi cebol</strong></p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Tanaman menjadi sangat kerdil dengan daun pendek, sempit, dan berwarna hijau pucat kekuningan. Ditularkan oleh wereng coklat.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-red-50/80 backdrop-blur-sm rounded-2xl p-4 border border-red-100/50">
                                            <span class="text-red-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Tanaman kerdil parah, daun pendek sempit, anakan berlebihan</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Kendalikan wereng coklat, tanam varietas tahan, eradikasi tanaman sakit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            {{-- ==================== HAMA ==================== --}}
            <template x-if="activeTab === 'semua' || activeTab === 'hama'">
                <div class="grid grid-cols-1 gap-6">

                    {{-- Penggerek Batang --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-purple-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'penggerek batang sundep beluk ulat penggerek'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-100/80 backdrop-blur-sm text-purple-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-insect text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Penggerek Batang Padi</h4>
                                                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-medium">Scirpophaga spp.</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Sundep</strong> (vegetatif), <strong>Beluk</strong> (generatif)</p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Larva menggerek batang padi, menyebabkan sundep (pucuk mati) atau beluk (malai putih hampa).</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-purple-50/80 backdrop-blur-sm rounded-2xl p-4 border border-purple-100/50">
                                            <span class="text-purple-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Sundep: pucuk mati mudah dicabut. Beluk: malai putih hampa.</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Insektisida sistemik, musuh alami (Trichogramma), tanam serempak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hispa --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-purple-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'hispa kumbang hispa'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-100/80 backdrop-blur-sm text-purple-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-shield-slash text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Hispa (Kumbang Hispa)</h4>
                                                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-medium">Dicladispa armigera</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Kumbang hispa</strong>, <strong>Hispa</strong></p>
                                        </div>
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟡 Moderate</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Kumbang kecil berwarna hitam kebiruan dengan duri-duri di tubuhnya. Larva membuat koridor di dalam daun.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-purple-50/80 backdrop-blur-sm rounded-2xl p-4 border border-purple-100/50">
                                            <span class="text-purple-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Garis putih memanjang di daun, bercak putih akibat gigitan dewasa</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Insektisida kontak (sipermetrin), genangi sawah, musuh alami</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Wereng Coklat --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-purple-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'wereng coklat nilaparvata'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-100/80 backdrop-blur-sm text-purple-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-bug-fill text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Wereng Coklat</h4>
                                                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-medium">Nilaparvata lugens</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Wereng coklat</strong>, <strong>Wereng</strong></p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Menghisap cairan batang padi, menyebabkan tanaman menjadi kuning, kering, dan mati (hopperburn).</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-purple-50/80 backdrop-blur-sm rounded-2xl p-4 border border-purple-100/50">
                                            <span class="text-purple-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Tanaman mengering melingkar (hopperburn), serangga di pangkal batang</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Insektisida (BPMC, fipronil), tanam varietas tahan, hindari insektisida spektrum luas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Wereng Hijau --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-purple-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'wereng hijau nephotettix'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-100/80 backdrop-blur-sm text-purple-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-bug-fill text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Wereng Hijau</h4>
                                                <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-medium">Nephotettix virescens</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Wereng ijo</strong>, <strong>Wereng daun</strong></p>
                                        </div>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🔴 Sangat Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Menghisap cairan daun padi dan merupakan vektor utama virus Tungro.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-purple-50/80 backdrop-blur-sm rounded-2xl p-4 border border-purple-100/50">
                                            <span class="text-purple-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Bercak putih kecil pada daun, tanaman kerdil, vektor virus Tungro</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Insektisida saat populasi tinggi, tanam serempak, varietas tahan wereng</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            {{-- ==================== NEMATODA ==================== --}}
            <template x-if="activeTab === 'semua' || activeTab === 'nematoda'">
                <div class="grid grid-cols-1 gap-6">

                    {{-- Nematoda Puru Akar --}}
                    <div class="bg-white/60 backdrop-blur-md rounded-[2rem] border border-white/50 shadow-xl shadow-pink-500/5 overflow-hidden group/card hover:shadow-2xl hover:shadow-pink-500/10 transition-all duration-500"
                        x-show="!searchQuery || 'nematoda puru akar nematoda akar'.includes(searchQuery.toLowerCase())">
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-pink-100/80 backdrop-blur-sm text-pink-600 flex items-center justify-center flex-shrink-0 group-hover/card:scale-110 transition-transform">
                                    <i class="bi bi-infinity text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-xl font-semibold text-gray-900">Nematoda Puru Akar</h4>
                                                <span class="bg-pink-100 text-pink-700 text-xs px-2 py-1 rounded-full font-medium">Meloidogyne graminicola</span>
                                            </div>
                                            <p class="text-sm text-gray-500 italic mt-1">Bahasa Jawa: <strong>Puru oyot</strong>, <strong>Nematoda akar</strong></p>
                                        </div>
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap w-fit">🟠 Merusak</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">Nematoda mikroskopis yang menyerang akar padi, menyebabkan pembengkakan (puru) pada akar.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div class="bg-pink-50/80 backdrop-blur-sm rounded-2xl p-4 border border-pink-100/50">
                                            <span class="text-pink-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-search"></i> Gejala Khas</span>
                                            <p class="text-gray-700 leading-relaxed">Pembengkakan pada akar (puru), tanaman kerdil, daun menguning</p>
                                        </div>
                                        <div class="bg-emerald-50/80 backdrop-blur-sm rounded-2xl p-4 border border-emerald-100/50">
                                            <span class="text-emerald-700 font-bold flex items-center gap-2 mb-2"><i class="bi bi-capsule"></i> Solusi</span>
                                            <p class="text-gray-700 leading-relaxed">Nematisida, rotasi tanaman, penggenangan lahan, bahan organik</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            {{-- No Result Message --}}
            <div x-show="searchQuery && document.querySelectorAll('.space-y-6 > [x-show]').length === 0"
                class="text-center py-12 bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 shadow-sm">
                <div class="text-5xl mb-4 text-gray-300"><i class="bi bi-search"></i></div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Tidak ditemukan</h4>
                <p class="text-gray-600">Coba kata kunci lain seperti "kresek", "blas", "sundep", atau "wereng"</p>
            </div>

        </div>
    </div>

    {{-- ===== PHT SECTION ===== --}}
    <div class="bg-white/40 backdrop-blur-md rounded-[2rem] md:rounded-[3rem] p-6 md:p-12 mb-16 border border-white/50 shadow-xl">
        <h3 class="text-2xl font-heading font-bold text-gray-900 mb-3 text-center">
            <i class="bi bi-recycle text-emerald-600"></i> Pengendalian Hama Terpadu (PHT)
        </h3>
        <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">Pendekatan ramah lingkungan yang mengutamakan keseimbangan ekosistem dalam mengelola hama dan penyakit</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/50 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-tree text-2xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-3">Kultur Teknis</h4>
                <ul class="text-xs text-gray-600 text-left space-y-2">
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-emerald-500"></i> Tanam serempak</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-emerald-500"></i> Rotasi tanaman</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-emerald-500"></i> Jarak tanam ideal</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-emerald-500"></i> Sanitasi lahan</li>
                </ul>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/50 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-capsule text-2xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-3">Varietas Tahan</h4>
                <ul class="text-xs text-gray-600 text-left space-y-2">
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-blue-500"></i> Inpari 32 (Kresek)</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-blue-500"></i> Inpari 33 (Wereng)</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-blue-500"></i> Ciherang (Blast)</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-blue-500"></i> Situ Bagendit</li>
                </ul>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/50 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-bug text-2xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-3">Hayati</h4>
                <ul class="text-xs text-gray-600 text-left space-y-2">
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-amber-500"></i> Musuh alami</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-amber-500"></i> Agensia hayati</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-amber-500"></i> Parasitoid</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-amber-500"></i> Jamur antagonis</li>
                </ul>
            </div>
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/50 shadow-sm hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-exclamation-triangle text-2xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-3">Kimiawi</h4>
                <ul class="text-xs text-gray-600 text-left space-y-2">
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-red-500"></i> Pilihan terakhir</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-red-500"></i> Sesuai dosis</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-red-500"></i> Rotasi bahan aktif</li>
                    <li class="flex items-center gap-1.5"><i class="bi bi-check2-circle text-red-500"></i> Masa tunggu</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ===== LIFECYCLE TABLE ===== --}}
    <div class="mb-16">
        <h3 class="text-2xl font-heading font-bold text-gray-900 mb-8 text-center">
            <i class="bi bi-calendar-event text-emerald-600"></i> Fase Rentan Tanaman Padi
        </h3>
        <div class="bg-white/60 backdrop-blur-md rounded-3xl border border-white/50 overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-emerald-50/80">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold text-emerald-900 uppercase tracking-wider text-xs">Fase Pertumbuhan</th>
                            <th class="px-6 py-4 text-left font-bold text-emerald-900 uppercase tracking-wider text-xs">Penyakit/Hama Rentan</th>
                            <th class="px-6 py-4 text-left font-bold text-emerald-900 uppercase tracking-wider text-xs">Tindakan Pencegahan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-100/50">
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Persemaian (0–21 HSS)</td>
                            <td class="px-6 py-4 text-gray-600">Blast daun, Penggerek batang (sundep), Wereng hijau</td>
                            <td class="px-6 py-4 text-gray-500 italic">Benih sehat, seed treatment, pengawasan ketat</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Vegetatif Awal (21–35 HST)</td>
                            <td class="px-6 py-4 text-gray-600">Kresek, Blast, Tungro, Wereng coklat</td>
                            <td class="px-6 py-4 text-gray-500 italic">Drainase baik, pupuk berimbang, monitoring</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Vegetatif Akhir (35–55 HST)</td>
                            <td class="px-6 py-4 text-gray-600">Hawar pelepah, Bercak coklat, Penggerek batang</td>
                            <td class="px-6 py-4 text-gray-500 italic">Kurangi kelembaban, sanitasi, hayati</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Generatif (55–85 HST)</td>
                            <td class="px-6 py-4 text-gray-600">Blast leher, Hawar malai, Penggerek (beluk)</td>
                            <td class="px-6 py-4 text-gray-500 italic">Fungisida protektif, pantau ketat</td>
                        </tr>
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">Pemasakan (85 HST – Panen)</td>
                            <td class="px-6 py-4 text-gray-600">Hawar malai bakteri, Bercak gabah, Nematoda</td>
                            <td class="px-6 py-4 text-gray-500 italic">Keringkan sawah, panen tepat waktu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== FAQ SECTION ===== --}}
    <div class="mb-16">
        <h3 class="text-2xl font-heading font-bold text-gray-900 mb-8 text-center">
            <i class="bi bi-question-circle text-emerald-600"></i> Pertanyaan Umum Petani
        </h3>
        <div class="space-y-3">
            <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 overflow-hidden shadow-sm hover:shadow-md transition-all" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-white/40 transition-colors">
                    <span class="font-bold text-gray-900">Apa perbedaan Kresek dan Blas?</span>
                    <i :class="open ? 'bi bi-chevron-up text-emerald-600' : 'bi bi-chevron-down text-gray-400'" class="transition-transform duration-300 flex-shrink-0 ml-4"></i>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5 text-gray-600 border-t border-emerald-50/50 pt-4">
                    <p class="leading-relaxed"><strong>Kresek</strong> (Bacterial Leaf Blight) disebabkan bakteri, ditandai daun menguning dari tepi. <strong>Blas</strong> (Blast) disebabkan jamur, ditandai bercak belah ketupat. Kresek diatasi dengan bakterisida tembaga, Blas dengan fungisida.</p>
                </div>
            </div>
            <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 overflow-hidden shadow-sm hover:shadow-md transition-all" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-white/40 transition-colors">
                    <span class="font-bold text-gray-900">Apa itu Sundep dan Beluk?</span>
                    <i :class="open ? 'bi bi-chevron-up text-emerald-600' : 'bi bi-chevron-down text-gray-400'" class="transition-transform duration-300 flex-shrink-0 ml-4"></i>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5 text-gray-600 border-t border-emerald-50/50 pt-4">
                    <p class="leading-relaxed"><strong>Sundep</strong> adalah gejala pucuk mati pada fase vegetatif, sedangkan <strong>Beluk</strong> adalah malai putih hampa pada fase generatif. Keduanya disebabkan oleh hama yang sama, yaitu ulat penggerek batang (<em>Scirpophaga</em> spp.).</p>
                </div>
            </div>
            <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 overflow-hidden shadow-sm hover:shadow-md transition-all" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-white/40 transition-colors">
                    <span class="font-bold text-gray-900">Bagaimana membedakan wereng coklat dan wereng hijau?</span>
                    <i :class="open ? 'bi bi-chevron-up text-emerald-600' : 'bi bi-chevron-down text-gray-400'" class="transition-transform duration-300 flex-shrink-0 ml-4"></i>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5 text-gray-600 border-t border-emerald-50/50 pt-4">
                    <p class="leading-relaxed"><strong>Wereng coklat</strong> menghisap batang dan menyebabkan <em>hopperburn</em> (tanaman mengering). <strong>Wereng hijau</strong> menghisap daun dan merupakan vektor utama <strong>virus Tungro</strong>. Keduanya memerlukan pengendalian insektisida yang tepat.</p>
                </div>
            </div>
            <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 overflow-hidden shadow-sm hover:shadow-md transition-all" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-white/40 transition-colors">
                    <span class="font-bold text-gray-900">Kapan waktu terbaik menggunakan pestisida?</span>
                    <i :class="open ? 'bi bi-chevron-up text-emerald-600' : 'bi bi-chevron-down text-gray-400'" class="transition-transform duration-300 flex-shrink-0 ml-4"></i>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5 text-gray-600 border-t border-emerald-50/50 pt-4">
                    <p class="leading-relaxed">Hanya saat populasi hama mencapai ambang ekonomi. Aplikasikan pada pagi (sebelum jam 9) atau sore hari. Gunakan prinsip 6T: Tepat sasaran, jenis, dosis, waktu, cara, dan sasaran.</p>
                </div>
            </div>
            <div class="bg-white/60 backdrop-blur-md rounded-2xl border border-white/50 overflow-hidden shadow-sm hover:shadow-md transition-all" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-white/40 transition-colors">
                    <span class="font-bold text-gray-900">Varietas padi apa yang tahan penyakit?</span>
                    <i :class="open ? 'bi bi-chevron-up text-emerald-600' : 'bi bi-chevron-down text-gray-400'" class="transition-transform duration-300 flex-shrink-0 ml-4"></i>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-5 text-gray-600 border-t border-emerald-50/50 pt-4">
                    <p class="leading-relaxed">Varietas tahan: <strong>Inpari 32</strong> (Kresek), <strong>Inpari 33</strong> (Wereng), <strong>Ciherang</strong> (Blast), <strong>Situ Bagendit</strong> (Tungro). Selalu gunakan benih bersertifikat untuk hasil optimal.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== WARNING SIGNS ===== --}}
    <div class="bg-white/40 backdrop-blur-md rounded-[2rem] md:rounded-[3rem] p-6 md:p-12 border border-red-100/80 shadow-xl mb-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-red-500/5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="flex items-start gap-6 relative z-10">
            <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center flex-shrink-0">
                <i class="bi bi-exclamation-octagon-fill text-3xl text-red-500"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-heading font-bold text-gray-900 mb-6">Tanda Bahaya yang Harus Diwaspadai</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-red-50 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse flex-shrink-0"></span>
                            <h4 class="font-bold text-red-900">Populasi Wereng Tinggi</h4>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">Jika terdapat &gt;20 ekor wereng per rumpun, segera lakukan pengendalian untuk mencegah puso.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-red-50 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse flex-shrink-0"></span>
                            <h4 class="font-bold text-red-900">Bercak Daun Meluas</h4>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">Jika bercak kresek atau blas menyebar ke &gt;25% area daun, lakukan aplikasi pestisida segera.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-red-50 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse flex-shrink-0"></span>
                            <h4 class="font-bold text-red-900">Banyak Sundep/Beluk</h4>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">Jika &gt;10% tanaman menunjukkan gejala sundep, segera aplikasikan insektisida sistemik.</p>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-5 border border-red-50 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse flex-shrink-0"></span>
                            <h4 class="font-bold text-red-900">Tanaman Kerdil Berkelompok</h4>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">Waspadai Tungro atau Grassy Stunt. Cabut dan musnahkan tanaman sakit agar tidak menular.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CTA SECTION ===== --}}
    <div class="text-center bg-white/70 backdrop-blur-xl rounded-[2rem] md:rounded-[3rem] p-8 md:p-12 border border-white shadow-2xl relative overflow-hidden group">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 -z-10"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-200/20 rounded-full blur-3xl group-hover:bg-emerald-300/30 transition-colors duration-700"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-teal-200/20 rounded-full blur-3xl group-hover:bg-teal-300/30 transition-colors duration-700"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-heading font-bold mb-4 text-gray-900">Siap Mendiagnosa Tanaman Padi Anda?</h3>
            <p class="text-gray-600 mb-8 max-w-xl mx-auto">Upload foto tanaman padi Anda sekarang dan dapatkan diagnosis instan dengan rekomendasi dalam bahasa lokal.</p>
            <div class="flex flex-col items-center gap-6">
                <a href="/"
                    class="inline-flex items-center gap-3 bg-emerald-600 text-white px-8 md:px-10 py-4 md:py-5 rounded-full font-bold shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all transform hover:scale-105 active:scale-95 text-sm md:text-base">
                    Mulai Diagnosa Gratis <i class="bi bi-arrow-right text-xl"></i>
                </a>
                <div class="flex flex-wrap justify-center gap-4 text-sm font-medium text-emerald-700">
                    <span class="flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-full"><i class="bi bi-lightning-fill"></i> Cepat</span>
                    <span class="flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-full"><i class="bi bi-bullseye"></i> Akurat</span>
                    <span class="flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-full"><i class="bi bi-translate"></i> Istilah Lokal</span>
                    <span class="flex items-center gap-1.5 bg-emerald-50 px-3 py-1.5 rounded-full"><i class="bi bi-gift-fill"></i> Gratis</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection