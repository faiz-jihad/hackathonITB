# Buku Panduan Pengguna (User Guide) MangsaPadi S.E.E.D

Selamat datang di MangsaPadi! Panduan ini akan membantu Anda memahami cara menggunakan aplikasi untuk mendeteksi penyakit daun padi dan mendapatkan rekomendasi penanganan yang bijak.

## 1. Persiapan Menjalankan Aplikasi
Sebelum menggunakan aplikasi, pastikan sistem sudah berjalan:
1. Anda telah memiliki API Key dari Google Gemini.
2. Anda telah menyalin `api-python/.env.example` ke `api-python/.env` dan menempelkan API Key Anda.
3. Menjalankan perintah `docker-compose up -d --build` di terminal.
4. Menjalankan migrasi database dengan `docker-compose exec web php artisan migrate`.

Jika semua langkah di atas berhasil, buka browser Anda dan kunjungi: **http://localhost:8000**

## 2. Cara Melakukan Diagnosa (Bagi Petani/Penyuluh)

**Langkah 1: Siapkan Foto**
Ambil foto daun padi yang menunjukkan gejala penyakit. Pastikan:
- Pencahayaan cukup terang.
- Daun terlihat jelas dan fokus.
- Format foto berupa `.jpg`, `.jpeg`, atau `.png`.
- Ukuran maksimal foto adalah 5MB.

**Langkah 2: Unggah Foto ke Sistem**
1. Di halaman utama MangsaPadi, Anda akan melihat kotak "Diagnosa Penyakit Padi".
2. Klik tombol **"Choose File"** (atau "Pilih File").
3. Pilih foto daun padi dari perangkat Anda.
4. Klik tombol hijau **"Mulai Diagnosa"**.

**Langkah 3: Membaca Hasil & Rekomendasi**
Sistem akan memproses gambar Anda ke AI Engine. Setelah selesai (biasanya 2-5 detik), Anda akan melihat halaman hasil:
- **Gambar:** Mengonfirmasi foto yang Anda unggah.
- **Penyakit Terdeteksi:** Nama penyakit yang didiagnosis oleh sistem Computer Vision.
- **Tingkat Kepercayaan:** Seberapa yakin AI terhadap diagnosanya (misal: 98.50%).
- **Rekomendasi Tindakan (AI):** Kotak biru ini berisi panduan penanganan hasil pemikiran Gemini AI yang telah disesuaikan dengan ilmu agronomi modern dan kearifan lokal. Bacalah panduan ini secara seksama sebelum melakukan tindakan pada lahan Anda.

## 3. Pemecahan Masalah (Troubleshooting)

- **"Terjadi kesalahan saat memproses gambar" / "Model not loaded"**
  Ini berarti AI Engine gagal memuat model `.h5`. Pastikan Anda telah mengunduh/menyediakan file `model/rice_disease_model.h5` di dalam folder `api-python/model`.

- **"Rekomendasi AI tidak tersedia: GEMINI_API_KEY belum dikonfigurasi"**
  Peringatan ini muncul jika file `.env` di folder `api-python` belum memiliki `GEMINI_API_KEY` yang sah. Silakan periksa kembali konfigurasi Anda.

- **Aplikasi Web tidak bisa diakses (Error 502/Connection Refused)**
  Pastikan Docker container sedang berjalan dengan perintah `docker-compose ps`. Jika status container "Exit", coba cek log-nya dengan `docker-compose logs web`.
