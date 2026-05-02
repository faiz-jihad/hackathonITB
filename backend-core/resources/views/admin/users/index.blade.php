@extends('admin.layout')

@section('page-title', 'Manajemen Admin')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h3 class="text-2xl font-heading font-bold text-gray-900">Manajemen Admin</h3>
        <p class="text-sm text-gray-500 mt-1">Kelola akun yang memiliki akses ke dasbor administrasi.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:-translate-y-0.5 transition-all duration-300">
        <i class="bi bi-person-plus"></i>
        Tambah Admin
    </a>
</div>

<!-- Table Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-slate-50/80 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Tgl Dibuat</th>
                    <th class="px-6 py-4 text-right text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($users as $user)
                <tr class="hover:bg-emerald-50/30 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                    {{ $user->name }}
                                    @if(auth()->id() === $user->id)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">Anda</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500 flex items-center gap-1.5">
                            <i class="bi bi-envelope text-gray-400"></i>
                            {{ $user->email }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            @if(auth()->id() !== $user->id)
                            <button type="button" onclick="confirmDelete({{ $user->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                                <i class="bi bi-trash3"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="access_code_delete" id="access_code_delete_{{ $user->id }}">
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        let code = prompt("Masukkan Kode Akses Khusus untuk menghapus Admin ini:");
        if (code != null && code != "") {
            document.getElementById('access_code_delete_' + userId).value = code;
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>
@endsection
