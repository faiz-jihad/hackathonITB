<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NewsService
{
    private const RSS_URL = 'https://www.antaranews.com/rss/pertanian';

    /**
     * Mengambil berita dari RSS Antara News (Ekonomi & Agribisnis)
     */
    public function getLatestNews($limit = 6)
    {
        return Cache::remember('agriculture_news', 86400, function () use ($limit) {
            try {
                $response = Http::timeout(3)->get(self::RSS_URL);
                if (!$response->successful()) {
                    throw new \Exception("Gagal mengambil data RSS dari Antara News.");
                }

                $xml = simplexml_load_string($response->body());
                if ($xml === false) {
                    throw new \Exception("Gagal mem-parsing XML Berita.");
                }

                $newsList = [];
                $count = 0;

                foreach ($xml->channel->item as $item) {
                    if ($count >= $limit) {
                        break;
                    }

                    // Ekstrak gambar jika ada (biasanya di tag <enclosure> atau <description>)
                    $image = null;
                    if (isset($item->enclosure)) {
                        $image = (string) $item->enclosure['url'];
                    }

                    // Jika tidak ada enclosure, coba cari img tag di description
                    if (!$image) {
                        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', (string) $item->description, $imageMatch);
                        $image = $imageMatch['src'] ?? null;
                    }

                    $newsList[] = [
                        'title' => (string) $item->title,
                        'link' => (string) $item->link,
                        'description' => strip_tags((string) $item->description),
                        'image' => $image,
                        'pubDate' => date('d M Y H:i', strtotime((string) $item->pubDate))
                    ];

                    $count++;
                }

                return $newsList;

            } catch (\Exception $e) {
                Log::error("[News Service] " . $e->getMessage());
                return [];
            }
        });
    }
}
