@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto min-h-screen px-4">
    <!-- Header -->
    <div class="mb-8 md:mb-12 text-center">
        <h1 class="text-3xl md:text-5xl font-heading font-black text-gray-900 mb-4 tracking-tight">
            Komunitas <span class="text-emerald-600">S.E.E.D</span>
        </h1>
        <p class="text-sm md:text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            Pusat informasi agribisnis terkini dan ruang diskusi para pahlawan pangan Indonesia.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12">
        
        <!-- Left Column: Berita Pertanian -->
        <div class="lg:col-span-7 space-y-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <i class="bi bi-newspaper text-xl"></i>
                    </div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-900">Kabar Pertanian</h2>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1 rounded-full">Updated Live</span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @forelse($newsList as $news)
                <a href="{{ $news['link'] }}" target="_blank" rel="noopener noreferrer" class="group bg-white/70 backdrop-blur-sm rounded-[2rem] shadow-sm border border-white overflow-hidden hover:shadow-xl transition-all duration-500 hover:-translate-y-2 flex flex-col h-full">
                    <div class="h-44 sm:h-48 overflow-hidden relative">
                        @if($news['image'])
                            <img src="{{ $news['image'] }}" alt="Cover" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-emerald-50 text-emerald-200">
                                <i class="bi bi-image text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-black text-emerald-700 shadow-sm border border-emerald-100/50">
                            <i class="bi bi-calendar3 mr-1"></i> {{ $news['pubDate'] }}
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="font-bold text-gray-900 leading-tight mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2 text-base md:text-lg">{{ $news['title'] }}</h3>
                        <p class="text-xs text-gray-500 line-clamp-3 mb-6 leading-relaxed">{{ $news['description'] }}</p>
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-emerald-600 text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                                Baca Artikel <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full bg-white/50 backdrop-blur-sm rounded-[2rem] p-12 text-center border border-dashed border-gray-200">
                    <div class="w-20 h-20 mx-auto bg-gray-100 rounded-3xl flex items-center justify-center mb-4">
                        <i class="bi bi-wifi-off text-3xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Gagal memuat berita saat ini.</p>
                    <button onclick="window.location.reload()" class="mt-4 text-emerald-600 font-bold text-sm hover:underline">Coba Muat Ulang</button>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Forum Diskusi -->
        <div class="lg:col-span-5 h-[600px] lg:h-[800px] flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                        <i class="bi bi-chat-dots text-xl"></i>
                    </div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-900">Obrolan Petani</h2>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Live Chat</span>
                </div>
            </div>
            
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-xl border border-white flex-grow flex flex-col overflow-hidden relative">
                
                <!-- Chat Messages Area -->
                <div class="flex-grow p-4 md:p-8 overflow-y-auto bg-gray-50/50 space-y-6" id="chatContainer">
                    @forelse($messages as $msg)
                    <div class="flex flex-col animate-fade-in-up">
                        <div class="flex items-center gap-3 mb-2 px-1">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white flex items-center justify-center text-xs font-black shadow-lg shadow-emerald-200 uppercase">
                                {{ substr($msg->sender_name, 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ $msg->sender_name }}</span>
                            <span class="text-[10px] text-gray-400 font-medium ml-auto">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-2xl rounded-tl-sm shadow-sm border border-gray-100 mr-8 ml-2">
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $msg->message }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-gray-400">
                        <div class="w-20 h-20 bg-white rounded-[2rem] flex items-center justify-center shadow-sm mb-4">
                            <i class="bi bi-chat-square-heart text-3xl opacity-30 text-emerald-500"></i>
                        </div>
                        <p class="text-sm font-medium">Belum ada obrolan. Mari menyapa!</p>
                    </div>
                    @endforelse
                </div>

                <!-- Message Input Form -->
                <div class="p-4 md:p-6 border-t border-gray-50 bg-white">
                    <form id="chatForm" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                            <div class="md:col-span-1">
                                <div class="relative">
                                    <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                    <input type="text" name="sender_name" id="senderName" placeholder="Nama..." required maxlength="50"
                                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-10 pr-4 py-3 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all font-semibold">
                                </div>
                            </div>
                            <div class="md:col-span-2 relative flex items-center">
                                <input type="text" name="message" id="chatMessage" placeholder="Apa kabarnya petani Indonesia?..." required maxlength="500"
                                    class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-3 pr-14 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none transition-all">
                                <button type="submit" id="sendBtn" class="absolute right-2 w-10 h-10 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200 transition-all active:scale-95">
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
    const container = document.getElementById("chatContainer");
    
    function scrollToBottom() {
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    }

    document.addEventListener("DOMContentLoaded", scrollToBottom);

    document.getElementById('chatForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('sendBtn');
        const nameInput = document.getElementById('senderName');
        const msgInput = document.getElementById('chatMessage');
        const token = document.querySelector('input[name="_token"]').value;

        if (!nameInput.value || !msgInput.value) return;

        const originalBtnHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split animate-spin text-xs"></i>';
        btn.disabled = true;

        try {
            const formData = new FormData();
            formData.append('_token', token);
            formData.append('sender_name', nameInput.value);
            formData.append('message', msgInput.value);

            const response = await fetch("{{ route('komunitas.message') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const newChat = document.createElement('div');
                newChat.className = 'flex flex-col animate-fade-in-up';
                
                const initial = nameInput.value.charAt(0).toUpperCase();
                
                newChat.innerHTML = `
                    <div class="flex items-center gap-3 mb-2 px-1">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white flex items-center justify-center text-xs font-black shadow-lg shadow-emerald-200 uppercase">
                            ${initial}
                        </div>
                        <span class="text-sm font-bold text-gray-800">${nameInput.value}</span>
                        <span class="text-[10px] text-emerald-500 font-bold ml-auto">Baru saja</span>
                    </div>
                    <div class="bg-emerald-50/50 p-4 rounded-2xl rounded-tl-sm shadow-sm border border-emerald-100 mr-8 ml-2">
                        <p class="text-gray-600 text-sm leading-relaxed">${msgInput.value}</p>
                    </div>
                `;

                const emptyState = container.querySelector('.bi-chat-square-heart');
                if (emptyState) {
                    container.innerHTML = '';
                }

                container.appendChild(newChat);
                scrollToBottom();
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
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    /* Hide scrollbar for Chrome, Safari and Opera */
    #chatContainer::-webkit-scrollbar {
        width: 4px;
    }
    #chatContainer::-webkit-scrollbar-track {
        background: transparent;
    }
    #chatContainer::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 10px;
    }
    #chatContainer::-webkit-scrollbar-thumb:hover {
        background: #d1d5db;
    }
</style>
@endsection
