@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold mb-6">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            S.E.E.D AI Engine Online
        </div>
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 mb-4 tracking-tight">
            Deteksi Penyakit Padi <br />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-blue-600">Lebih Cepat & Akurat</span>
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Unggah foto daun padi Anda. S.E.E.D (Sistem Edukasi & Evaluasi Diagnostik) akan mengidentifikasi penyakit dan memberikan rekomendasi berbasis agronomi modern serta kearifan lokal.
        </p>
    </div>
    
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-8 animate-fade-in flex items-start gap-3">
            <i class="ph ph-warning-circle text-2xl"></i>
            <div>
                <p class="font-bold">Gagal Menganalisis</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Upload Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
        <div class="p-8 md:p-12">
            <form action="/predict" method="POST" enctype="multipart/form-data" onsubmit="showLoading()" class="space-y-6">
                @csrf
                
                <!-- Drag & Drop Area -->
                <div class="relative group">
                    <input type="file" name="image" id="image-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this)">
                    
                    <div id="drop-zone" class="border-3 border-dashed border-gray-300 rounded-2xl p-12 text-center bg-gray-50 group-hover:bg-emerald-50 group-hover:border-emerald-400 transition-colors duration-300">
                        <div id="upload-prompt">
                            <div class="w-20 h-20 mx-auto bg-white rounded-full shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="ph ph-upload-simple text-3xl text-emerald-500"></i>
                            </div>
                            <h3 class="text-xl font-heading font-semibold text-gray-800 mb-2">Unggah Foto Daun Padi</h3>
                            <p class="text-gray-500 mb-4">Seret dan lepas file di sini, atau klik untuk mencari</p>
                            <p class="text-xs text-gray-400">Format didukung: JPG, PNG, JPEG (Maks. 5MB)</p>
                        </div>
                        
                        <!-- Image Preview -->
                        <div id="image-preview-container" class="hidden flex-col items-center">
                            <img id="image-preview" src="" alt="Preview" class="max-h-48 rounded-lg shadow-md mb-4 object-contain">
                            <p id="file-name" class="text-sm font-medium text-emerald-600"></p>
                            <p class="text-xs text-gray-500 mt-1">Klik untuk mengganti gambar</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold py-4 rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 text-lg">
                    <i class="ph ph-scan text-xl"></i> Mulai Diagnosa
                </button>
            </form>
        </div>
    </div>
    
    <!-- Trust Badges -->
    <div class="mt-12 flex justify-center gap-8 text-gray-400 grayscale opacity-70">
        <div class="flex items-center gap-2"><i class="ph ph-shield-check text-2xl"></i> <span class="font-medium text-sm">Privasi Aman</span></div>
        <div class="flex items-center gap-2"><i class="ph ph-lightning text-2xl"></i> <span class="font-medium text-sm">Respons Cepat</span></div>
        <div class="flex items-center gap-2"><i class="ph ph-plant text-2xl"></i> <span class="font-medium text-sm">10 Jenis Penyakit</span></div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('upload-prompt').classList.add('hidden');
                document.getElementById('image-preview-container').classList.remove('hidden');
                document.getElementById('image-preview-container').classList.add('flex');
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('file-name').textContent = input.files[0].name;
                document.getElementById('drop-zone').classList.add('border-emerald-500', 'bg-emerald-50');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
