<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KearifanLokal;

class KearifanLokalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_penyakit' => 'Hawar Daun Bakteri',
                'penanganan_kearifan_lokal' => 'Petani tradisional sering menggunakan ramuan tumbukan daun sirih dan ekstrak bawang putih yang disemprotkan pada pagi hari sebelum embun hilang. Campuran abu dapur di sekitar pangkal batang juga terbukti mengurangi penyebaran bakteri lewat air genangan.',
                'nama_obat' => 'Fungisida & Bakterisida Nordox 56 WP',
                'deskripsi_obat' => 'Bakterisida kontak berbahan aktif tembaga oksida yang efektif membasmi hawar daun bakteri pada padi.',
                'gambar_obat' => null,
                'link_pembelian' => 'https://tokopedia.com/search?q=nordox+56+wp',
            ],
            [
                'nama_penyakit' => 'Blast',
                'penanganan_kearifan_lokal' => 'Untuk penyakit blas, kearifan lokal menggunakan ekstrak daun mimba (neem) atau brotowali yang difermentasikan selama 3 hari. Semprotkan secara merata pada sore hari untuk mencegah penyebaran spora jamur saat malam yang lembap.',
                'nama_obat' => 'Fungisida Amistar Top 325 SC',
                'deskripsi_obat' => 'Fungisida sistemik spektrum luas, sangat ampuh mengendalikan jamur penyebab penyakit Blast (Pyricularia oryzae).',
                'gambar_obat' => null,
                'link_pembelian' => 'https://tokopedia.com/search?q=amistar+top',
            ],
            [
                'nama_penyakit' => 'Tungro',
                'penanganan_kearifan_lokal' => 'Penyakit Tungro ditularkan oleh wereng hijau. Penanganan lokal menggunakan tanaman penolak hama (refugia) seperti bunga kenikir dan menanam sereh wangi di pematang sawah. Penyemprotan air rebusan tembakau dan lada hitam terbukti mengusir wereng hijau.',
                'nama_obat' => 'Insektisida Plenum 50 WG',
                'deskripsi_obat' => 'Insektisida sistemik yang memblokir saraf makan wereng hijau sehingga mencegah penularan virus Tungro lebih lanjut.',
                'gambar_obat' => null,
                'link_pembelian' => 'https://tokopedia.com/search?q=plenum+50+wg',
            ],
            [
                'nama_penyakit' => 'Brown Spot',
                'penanganan_kearifan_lokal' => 'Bercak cokelat menandakan sawah kekurangan nutrisi. Petani lokal biasa memberikan pupuk kompos dari kotoran kambing dan jerami sisa panen sebelumnya yang dibakar (abu jerami) untuk meningkatkan Kalium (K) dan Silika.',
                'nama_obat' => 'Pupuk Kalium Silika (K-Sil)',
                'deskripsi_obat' => 'Pupuk cair tinggi Kalium dan Silika untuk menebalkan dinding sel daun agar jamur penyebab bercak cokelat tidak mudah masuk.',
                'gambar_obat' => null,
                'link_pembelian' => 'https://tokopedia.com/search?q=pupuk+kalium+silika',
            ]
        ];

        foreach ($data as $item) {
            KearifanLokal::create($item);
        }
    }
}
