@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto min-h-screen">
    <!-- Header -->
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-heading font-extrabold text-gray-900 mb-3">Komunitas <span class="text-emerald-600">S.E.E.D</span></h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Dapatkan berita agribisnis terkini dan diskusikan pengalaman bertani Anda bersama komunitas.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Berita Pertanian -->
        <div class="lg:col-span-7 space-y-6">
            <div class="flex items-center gap-2 mb-4">
                <i class="bi bi-newspaper text-2xl text-emerald-600"></i>
                <h2 class="text-2xl font-bold text-gray-800">Berita Agribisnis Terkini</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @forelse($newsList as $news)
                <a href="{{ $news['link'] }}" target="_blank" rel="noopener noreferrer" class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex flex-col h-full">
                    <div class="h-48 bg-gray-200 overflow-hidden relative">
                        @if($news['image'])
                            <img src="{{ $news['image'] }}" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-200">
                                <i class="bi bi-image text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-gray-700 shadow-sm">
                            <i class="bi bi-clock"></i> {{ $news['pubDate'] }}
                        </div>
                    </div>
                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 leading-snug mb-2 group-hover:text-emerald-600 transition-colors line-clamp-3">{{ $news['title'] }}</h3>
                            <p class="text-xs text-gray-500 line-clamp-3 mb-4">{{ $news['description'] }}</p>
                        </div>
                        <span class="text-emerald-600 text-xs font-semibold uppercase tracking-wider flex items-center gap-1 mt-auto">
                            Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </a>
                @empty
                <div class="col-span-full bg-gray-50 rounded-2xl p-8 text-center border border-gray-100">
                    <i class="bi bi-wifi-off text-4xl text-gray-400 mb-3 block"></i>
                    <p class="text-gray-500">Gagal memuat berita saat ini. Silakan coba lagi nanti.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Forum Diskusi -->
        <div class="lg:col-span-5 h-[800px] flex flex-col">
            <div class="flex items-center gap-2 mb-4">
                <i class="bi bi-chat-dots text-2xl text-blue-600"></i>
                <h2 class="text-2xl font-bold text-gray-800">Obrolan Petani</h2>
            </div>
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 flex-grow flex flex-col overflow-hidden relative">
                
                <!-- Chat Messages Area -->
                <div class="flex-grow p-6 overflow-y-auto bg-gray-50 space-y-4" id="chatContainer">
                    @forelse($messages as $msg)
                    <div class="bg-white p-4 rounded-2xl rounded-tl-sm shadow-sm border border-gray-100 mr-8 animate-fade-in-up">
                        <div class="flex items-baseline justify-between mb-1">
                            <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 text-white flex items-center justify-center text-[10px] uppercase">
                                    {{ substr($msg->sender_name, 0, 1) }}
                                </div>
                                {{ $msg->sender_name }}
                            </h4>
                            <span class="text-[10px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-sm pl-8">{{ $msg->message }}</p>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-gray-400">
                        <i class="bi bi-chat-square-heart text-5xl mb-3 opacity-50"></i>
                        <p class="text-sm">Belum ada obrolan. Jadilah yang pertama menyapa!</p>
                    </div>
                    @endforelse
                </div>

                <!-- Message Input Form -->
                <div class="p-5 border-t border-gray-100 bg-white relative">
                    <form id="chatForm" class="flex flex-col gap-3">
                        @csrf
                        <div class="flex gap-3">
                            <div class="w-1/3">
                                <input type="text" name="sender_name" id="senderName" placeholder="Nama Anda..." required maxlength="50"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                            </div>
                            <div class="w-2/3 flex relative">
                                <input type="text" name="message" id="chatMessage" placeholder="Ketik pesan di sini..." required maxlength="500"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 pr-12 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                                <button type="submit" id="sendBtn" class="absolute right-2 top-2 bottom-2 w-10 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg flex items-center justify-center shadow-md transition-colors">
                                    <i class="bi bi-send-fill text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-scroll chat to bottom
    const container = document.getElementById("chatContainer");
    
    function scrollToBottom() {
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    }

    document.addEventListener("DOMContentLoaded", scrollToBottom);

    // AJAX Form Submission
    document.getElementById('chatForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('sendBtn');
        const nameInput = document.getElementById('senderName');
        const msgInput = document.getElementById('chatMessage');
        const token = document.querySelector('input[name="_token"]').value;

        // Validasi simpel
        if (!nameInput.value || !msgInput.value) return;

        // Simpan state tombol
        const originalBtnHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split animate-spin text-xs"></i>';
        btn.disabled = true;

        try {
            const formData = new FormData();
            formData.append('_token', token);
            formData.append('sender_name', nameInput.value);
            formData.append('message', msgInput.value);

            // Fetch request
            const response = await fetch("{{ route('komunitas.message') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                // Buat elemen chat baru
                const newChat = document.createElement('div');
                newChat.className = 'bg-white p-4 rounded-2xl rounded-tl-sm shadow-sm border border-emerald-100 mr-8 animate-fade-in-up bg-emerald-50/30';
                
                const initial = nameInput.value.charAt(0).toUpperCase();
                
                newChat.innerHTML = `
                    <div class="flex items-baseline justify-between mb-1">
                        <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 text-white flex items-center justify-center text-[10px] uppercase">
                                ${initial}
                            </div>
                            ${nameInput.value}
                        </h4>
                        <span class="text-[10px] text-emerald-500 font-bold">Baru saja</span>
                    </div>
                    <p class="text-gray-600 text-sm pl-8">${msgInput.value}</p>
                `;

                // Hilangkan state kosong jika ada
                const emptyState = container.querySelector('.text-gray-400');
                if (emptyState && emptyState.querySelector('.bi-chat-square-heart')) {
                    emptyState.remove();
                }

                // Tambahkan ke container & scroll
                container.appendChild(newChat);
                scrollToBottom();

                // Bersihkan input pesan
                msgInput.value = '';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal mengirim pesan. Coba lagi!');
        } finally {
            btn.innerHTML = originalBtnHTML;
            btn.disabled = false;
        }
    });
</script>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.4s ease-out forwards;
    }
</style>
@endsection
