@extends('admin.layout')

@section('page-title', 'Kearifan Lokal')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h3 class="text-2xl font-heading font-bold text-gray-900">Data Kearifan Lokal</h3>
        <p class="text-sm text-gray-500 mt-1">Kelola data penanganan penyakit berbasis kearifan lokal dan obat-obatan.</p>
    </div>
    <a href="{{ route('admin.kearifan-lokal.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:-translate-y-0.5 transition-all duration-300">
        <i class="bi bi-plus-lg"></i>
        Tambah Data
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-slate-50/80 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Penyakit</th>
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Obat / Gambar</th>
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Penanganan RAG</th>
                    <th class="px-6 py-4 text-right text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($data as $item)
                <tr class="hover:bg-emerald-50/30 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-gray-400 font-mono">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-amber-50 border border-amber-100 text-amber-800 text-sm font-medium">
                            <i class="bi bi-bug text-amber-500"></i>
                            {{ $item->nama_penyakit ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($item->gambar_obat)
                            <img class="h-10 w-10 rounded-xl object-cover border border-gray-100 shadow-sm" src="{{ asset($item->gambar_obat) }}" alt="">
                            @else
                            <div class="h-10 w-10 rounded-xl bg-gray-100 flex items-center justify-center">
                                <i class="bi bi-image text-gray-400"></i>
                            </div>
                            @endif
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $item->nama_obat }}</p>
                                @if($item->link_pembelian)
                                <a href="{{ $item->link_pembelian }}" target="_blank" class="text-xs text-blue-500 hover:text-blue-700 flex items-center gap-1">
                                    <i class="bi bi-cart3"></i> Beli
                                </a>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-600 line-clamp-2 max-w-xs" title="{{ $item->penanganan_kearifan_lokal }}">
                            {{ Str::limit($item->penanganan_kearifan_lokal, 60) }}
                        </p>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.kearifan-lokal.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.kearifan-lokal.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                <i class="bi bi-journal-x text-2xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada data kearifan lokal.</p>
                            <a href="{{ route('admin.kearifan-lokal.create') }}" class="mt-3 text-sm text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1">
                                <i class="bi bi-plus-circle"></i> Tambah data pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
