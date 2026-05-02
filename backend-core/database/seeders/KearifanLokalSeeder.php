<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KearifanLokalSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nama_penyakit' => 'Bacterial Leaf Blight',
                'penanganan_kearifan_lokal' => 'Di kalangan petani lokal, penyakit ini sering disebut "Kresek". Penanganan tradisional yang sering dilakukan adalah dengan mengurangi pupuk urea (nitrogen) karena memicu daun makin rimbun dan lembab, serta membuat jarak tanam lebih renggang (sistem jajar legowo).',
                'nama_obat' => 'Ramuan Daun Sirih & Tembakau',
                'deskripsi_obat' => 'Rebus 10-15 lembar daun sirih dan 2 genggam tembakau dalam 2 liter air. Diamkan semalaman. Saring dan campurkan dengan air biasa untuk disemprotkan ke daun yang terkena Kresek. Senyawa aktif pada sirih berfungsi sebagai antibakteri alami.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Bacterial Leaf Streak',
                'penanganan_kearifan_lokal' => 'Sering disebut "Godhong garis bakteri" atau "kresek garis" karena bentuk serangannya bergaris tembus cahaya pada daun. Petani biasanya menaburkan abu tungku (abu kayu/sekam) ke area perakaran untuk menyeimbangkan pH dan menguatkan batang daun.',
                'nama_obat' => 'Ekstrak Bawang Putih dan Kunyit',
                'deskripsi_obat' => 'Tumbuk halus 3 bonggol bawang putih dan 2 ruas kunyit, rendam dalam 1 liter air hangat selama 12 jam. Bawang putih mengandung allicin sebagai bakterisida alami.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Bacterial Panicle Blight',
                'penanganan_kearifan_lokal' => 'Dikenal dengan nama "Hawar malai" atau "malai bosok / rusak". Penyakit ini menyerang gabah. Cara mencegah secara tradisional adalah memastikan lahan tidak terlalu tergenang air saat padi mulai bunting atau berbunga, dikeringkan perlahan (intermittent irrigation).',
                'nama_obat' => 'Larutan Garam Dapur dan Sabun Cuci',
                'deskripsi_obat' => 'Gunakan sedikit larutan garam dapur ringan yang dicampur sabun cuci sebagai perekat untuk membersihkan malai dari spora bakteri di awal serangan. Jangan terlalu pekat agar daun tidak terbakar.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Blast',
                'penanganan_kearifan_lokal' => 'Petani Jawa sering menyebutnya "Blas" atau "gulu padi patah" (patah leher). Ini karena jamur menyerang tangkai leher malai. Mengurangi pemupukan N dan memperbanyak pupuk K (Kalium) dari jerami sisa panen adalah cara lokal terbaik.',
                'nama_obat' => 'Fungisida Nabati Ekstrak Lengkuas',
                'deskripsi_obat' => 'Lengkuas mengandung atsiri yang tidak disukai jamur Blas. Tumbuk 1 kg lengkuas, rendam dalam 5 liter air, lalu saring. Semprotkan terutama pada bagian leher malai.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Brown Spot',
                'penanganan_kearifan_lokal' => 'Dikenal sebagai "Bercak coklat" atau "bintik coklat nang godhong". Ini menandakan tanah kekurangan nutrisi (biasanya Kalium atau Silika). Pengeringan lahan sementara (macak-macak) membantu sirkulasi udara akar.',
                'nama_obat' => 'Pupuk Cair Organik (POC) Daun Kelor',
                'deskripsi_obat' => 'Daun kelor kaya akan nutrisi makro dan mikro yang menguatkan imun padi dari Brown Spot. Fermentasi daun kelor dengan air cucian beras dan gula merah, lalu semprotkan ke daun.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Downy Mildew',
                'penanganan_kearifan_lokal' => 'Disebut "Embun bulu" atau "jamur alus" karena bentuknya seperti lapisan tepung putih di daun. Biasa terjadi jika pagi hari berkabut pekat. Petani biasa memangkas daun bawah yang terlalu rimbun agar sinar matahari bisa masuk.',
                'nama_obat' => 'Larutan Baking Soda (Natrium Bikarbonat)',
                'deskripsi_obat' => 'Baking soda merubah pH daun menjadi basa sehingga jamur Downy Mildew tidak bisa berkembang. Larutkan 1 sendok makan baking soda dalam 4 liter air. Semprotkan pagi hari.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Tungro',
                'penanganan_kearifan_lokal' => 'Tungro tidak memiliki terjemahan khusus (tetap Tungro). Karena ditularkan oleh wereng hijau, cara tradisional mengatasinya adalah dengan menanam refugia (bunga kuning seperti kenikir atau bunga matahari) di galengan untuk memancing predator wereng hijau.',
                'nama_obat' => 'Pestisida Nabati Daun Mimba dan Sambiloto',
                'deskripsi_obat' => 'Daun mimba dan sambiloto sangat pahit dan efektif mengusir wereng hijau sang pembawa virus Tungro. Rebus dan ambil ekstrak airnya, semprotkan ke pangkal batang padi.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Dead Heart',
                'penanganan_kearifan_lokal' => 'Ini adalah serangan Penggerek Batang. Petani menyebutnya "Sundep" jika terjadi di masa vegetatif (awal), dan "Beluk" jika terjadi di masa generatif (malai). Pencegahan paling manjur adalah melakukan pencabutan massal telur hama (berkelompok kecil warna putih/coklat) di ujung daun padi sebelum menetas menjadi ulat.',
                'nama_obat' => 'Ekstrak Biji Mahoni / Bratawali',
                'deskripsi_obat' => 'Rasa sangat pahit dari ekstrak Bratawali atau biji Mahoni membuat ulat penggerek batang tidak mau memakan batang padi. Semprotkan secara merata ke seluruh batang.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_penyakit' => 'Hispa',
                'penanganan_kearifan_lokal' => 'Dikenal dengan nama "Kumbang hispa" atau "hispa". Hama ini memakan jaringan epidermis daun hingga tersisa kulit luar putih. Cara lokal adalah dengan mengumpulkan kumbang ini secara manual di pagi hari karena mereka lambat bergerak saat embun masih dingin.',
                'nama_obat' => 'Perangkap Cahaya dan Minyak Serai',
                'deskripsi_obat' => 'Pasang lampu di tengah sawah pada malam hari, di bawahnya beri baskom berisi air campur minyak serai/sabun. Kumbang Hispa akan mendatangi cahaya dan jatuh ke baskom.',
                'link_pembelian' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('kearifan_lokals')->insert($data);
    }
}
