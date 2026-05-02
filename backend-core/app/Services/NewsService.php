<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NewsService
{
    private const RSS_URL = 'https://www.antaranews.com/rss/pertanian.xml';

    /**
     * Mengambil berita dari RSS Antara News
     */
    public function getLatestNews($limit = 6)
    {
        return Cache::remember('agriculture_news', 3600, function () use ($limit) {
            try {
                // Tambahkan User-Agent agar tidak diblokir oleh server Antara
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ])->timeout(5)->get(self::RSS_URL);

                if (!$response->successful()) {
                    throw new \Exception("Gagal mengambil data RSS. Status: " . $response->status());
                }

                $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                if ($xml === false) {
                    throw new \Exception("Gagal mem-parsing XML Berita.");
                }

                $newsList = [];
                $count = 0;

                if (isset($xml->channel->item)) {
                    foreach ($xml->channel->item as $item) {
                        if ($count >= $limit) break;

                        $image = null;
                        if (isset($item->enclosure)) {
                            $image = (string) $item->enclosure['url'];
                        }

                        if (!$image) {
                            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', (string) $item->description, $imageMatch);
                            $image = $imageMatch['src'] ?? null;
                        }

                        // Fallback image if still null
                        if (!$image) {
                            $image = 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800&auto=format&fit=crop';
                        }

                        $newsList[] = [
                            'title' => (string) $item->title,
                            'link' => (string) $item->link,
                            'description' => trim(strip_tags((string) $item->description)),
                            'image' => $image,
                            'pubDate' => date('d M Y', strtotime((string) $item->pubDate))
                        ];

                        $count++;
                    }
                }

                if (empty($newsList)) {
                    return $this->getFallbackNews();
                }

                return $newsList;

            } catch (\Exception $e) {
                Log::error("[News Service] " . $e->getMessage());
                return $this->getFallbackNews();
            }
        });
    }

    /**
     * Data cadangan jika API Antara News down
     */
    private function getFallbackNews()
    {
        return [
            [
                'title' => 'Tips Menjaga Ketahanan Padi di Musim Hujan',
                'link' => 'https://www.google.com/search?q=tips+menjaga+ketahanan+padi+musim+hujan',
                'description' => 'Pastikan drainase sawah berjalan baik untuk mencegah busuk akar dan serangan jamur blas saat curah hujan tinggi.',
                'image' => 'https://images.unsplash.com/photo-1530507629858-e4977d30e9e0?q=80&w=800&auto=format&fit=crop',
                'pubDate' => date('d M Y')
            ],
            [
                'title' => 'Mengenal Pupuk Organik Cair (POC) dari Limbah Jerami',
                'link' => 'https://www.google.com/search?q=cara+membuat+pupuk+organik+cair+jerami+padi',
                'description' => 'Limbah jerami jangan dibakar! Ubah menjadi pupuk cair untuk menghemat biaya produksi dan memperbaiki struktur tanah.',
                'image' => 'https://images.unsplash.com/photo-1592982537447-7440770cbfc9?q=80&w=800&auto=format&fit=crop',
                'pubDate' => date('d M Y')
            ],
            [
                'title' => 'Waspada Serangan Hama Wereng di Awal Tahun',
                'link' => 'https://www.google.com/search?q=cara+mengatasi+hama+wereng+padi+terbaru',
                'description' => 'Pantau populasi wereng setiap pagi. Gunakan pestisida nabati jika ditemukan lebih dari 10 ekor per rumpun.',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=800&auto=format&fit=crop',
                'pubDate' => date('d M Y')
            ]
        ];
    }
}
