@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg px-4 py-5 sm:p-6 max-w-4xl mx-auto">
    <div class="mb-5 border-b border-gray-200 pb-4 flex items-center justify-between">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Edit Data Kearifan Lokal
        </h3>
        <a href="{{ route('admin.kearifan-lokal.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    <form action="{{ route('admin.kearifan-lokal.update', $kearifanLokal->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nama_penyakit" class="block text-sm font-medium text-gray-700">Nama Penyakit (Opsional)</label>
            <div class="mt-1">
                <input type="text" name="nama_penyakit" id="nama_penyakit" value="{{ old('nama_penyakit', $kearifanLokal->nama_penyakit) }}" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
            </div>
        </div>

        <div>
            <label for="penanganan_kearifan_lokal" class="block text-sm font-medium text-gray-700">Penanganan RAG (Kearifan Lokal) *</label>
            <div class="mt-1">
                <textarea id="penanganan_kearifan_lokal" name="penanganan_kearifan_lokal" rows="4" required class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border border-gray-300 rounded-md py-2 px-3">{{ old('penanganan_kearifan_lokal', $kearifanLokal->penanganan_kearifan_lokal) }}</textarea>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-md border border-gray-200 space-y-4">
            <h4 class="text-md font-medium text-gray-900 mb-2">Informasi Obat</h4>
            
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat *</label>
                    <div class="mt-1">
                        <input type="text" name="nama_obat" id="nama_obat" value="{{ old('nama_obat', $kearifanLokal->nama_obat) }}" required class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="deskripsi_obat" class="block text-sm font-medium text-gray-700">Deskripsi Obat *</label>
                    <div class="mt-1">
                        <textarea id="deskripsi_obat" name="deskripsi_obat" rows="3" required class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border border-gray-300 rounded-md py-2 px-3">{{ old('deskripsi_obat', $kearifanLokal->deskripsi_obat) }}</textarea>
                    </div>
                </div>

                <div class="sm:col-span-1">
                    <label for="gambar_obat" class="block text-sm font-medium text-gray-700">Upload Gambar Obat Baru (Opsional)</label>
                    <div class="mt-1">
                        <input type="file" name="gambar_obat" id="gambar_obat" accept="image/*" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border bg-white">
                    </div>
                    @if($kearifanLokal->gambar_obat)
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                            <img src="{{ asset($kearifanLokal->gambar_obat) }}" alt="Gambar saat ini" class="h-20 w-auto rounded border">
                        </div>
                    @endif
                </div>

                <div class="sm:col-span-1">
                    <label for="link_pembelian" class="block text-sm font-medium text-gray-700">Link Pembelian (Opsional)</label>
                    <div class="mt-1">
                        <input type="url" name="link_pembelian" id="link_pembelian" value="{{ old('link_pembelian', $kearifanLokal->link_pembelian) }}" placeholder="https://tokopedia.com/..." class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <a href="{{ route('admin.kearifan-lokal.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Batal
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    Perbarui Data
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
