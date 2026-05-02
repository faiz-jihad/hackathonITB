@extends('admin.layout')

@section('content')
<div class="bg-white shadow rounded-lg px-4 py-5 sm:p-6 max-w-2xl mx-auto">
    <div class="mb-5 border-b border-gray-200 pb-4 flex items-center justify-between">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Edit Data Admin
        </h3>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="mt-1">
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
            <div class="mt-1">
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-md">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Ubah Kata Sandi (Kosongkan jika tidak ingin diubah)</h4>
            <div class="space-y-4">
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-500">Kata Sandi Baru</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-gray-500">Konfirmasi Kata Sandi Baru</label>
                    <div class="mt-1">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md py-2 px-3 border">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-red-50 p-4 rounded-md border border-red-200 mt-6">
            <h4 class="text-sm font-bold text-red-800 mb-2">Otorisasi Keamanan</h4>
            <div>
                <label for="access_code" class="block text-sm font-medium text-red-700">Kode Akses Khusus *</label>
                <div class="mt-1">
                    <input type="password" name="access_code" id="access_code" required class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-red-300 rounded-md py-2 px-3 border" placeholder="Masukkan kode rahasia...">
                </div>
                <p class="mt-1 text-xs text-red-600">Dibutuhkan untuk memvalidasi perubahan pada data admin.</p>
            </div>
        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <a href="{{ route('admin.users.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
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
