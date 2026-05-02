<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\ForumMessage;
use App\Services\NewsService;

class CommunityController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index()
    {
        $newsList = $this->newsService->getLatestNews(6);
        $messages = ForumMessage::latest()->take(50)->get()->reverse();

        return view('pages.komunitas', compact('newsList', 'messages'));
    }

    public function storeMessage(Request $request)
    {
        // Rate limit: maksimal 10 pesan per menit per IP
        $throttleKey = 'forum-message:' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 10)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => "Terlalu cepat. Coba lagi dalam {$seconds} detik."
                ], 429);
            }
            return back()->withErrors(['message' => "Terlalu cepat. Coba lagi dalam {$seconds} detik."]);
        }

        $request->validate([
            'sender_name' => 'required|string|max:50',
            'message' => 'required|string|max:500',
        ]);

        ForumMessage::create([
            'sender_name' => strip_tags($request->sender_name),
            'message' => strip_tags($request->message),
        ]);

        RateLimiter::hit($throttleKey, 60);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Pesan terkirim']);
        }

        return redirect()->route('komunitas.index')->with('success', 'Pesan berhasil dikirim!');
    }
}
