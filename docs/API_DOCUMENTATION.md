# API Documentation: AI Engine & RAG System

Layanan `api-python` berjalan secara mandiri dan menyediakan fungsi *Computer Vision* (Klasifikasi Gambar) serta integrasi ke Google Gemini (LLM) untuk memberikan saran pintar berbasis data.

---

## 🏗 Konsep RAG Dinamis (Terhubung MySQL)
Berbeda dengan sistem AI statis, endpoint di bawah ini sudah terintegrasi secara **langsung ke Database MySQL (Laravel)**.
Setiap kali AI akan memberikan rekomendasi (RAG - *Retrieval-Augmented Generation*), sistem akan bekerja dengan alur berikut:
1. **Deteksi**: CNN mendeteksi gambar dan menghasilkan nama penyakit (misal: "Bacterial Leaf Blight").
2. **Retrieval (MySQL)**: Python akan melakukan *query* ke tabel `kearifan_lokals` di database MySQL untuk mencari panduan tradisional dan referensi obat yang diinputkan oleh Admin.
3. **Augmented Generation (Gemini)**: Data dari database tersebut digabungkan ke dalam *prompt* AI sebagai konteks wajib, sehingga jawaban akhir AI selaras dengan anjuran Admin di Dasbor.

---

## `POST /predict`
Endpoint AI utama untuk menerima gambar daun padi, melakukan klasifikasi penyakit menggunakan Computer Vision, mencari referensi Admin dari Database, dan mengembalikan rekomendasi penanganan otomatis dari Gemini RAG.

**Request:**
- Header: `Content-Type: multipart/form-data`
- Body: 
  - `file` (Gambar daun padi - `.jpg`, `.png`, `.jpeg`)
  - `weather` (Optional string, contoh: "Cerah, 30C, 70%")

**Response:**
```json
{
  "penyakit": "Blast (Penyakit Blas)",
  "akurasi": 98.5,
  "rekomendasi": {
    "Analisis": "Jelaskan secara singkat MASALAH YANG ADA...",
    "Langkah Preventif": "Tindakan pencegahan dengan rumus JIKA X MAKA Y (Diperkaya dari Database Admin)...",
    "Rekomendasi Obat": "Solusi medis/teknis dengan rumus JIKA X MAKA Y (Menyebutkan obat spesifik dari Database Admin)..."
  }
}
```

---

## `POST /recommend`
Endpoint AI sekunder untuk meminta ulang saran dari Gemini RAG secara spesifik berdasarkan nama penyakit dan metrik cuaca tanpa perlu mengirim gambar. Endpoint ini juga **terhubung ke database** untuk mengambil konteks Admin.

**Request:**
- Header: `Content-Type: application/json`
- Body:
```json
{
  "nama_penyakit": "Bacterial Leaf Blight (Hawar Daun Bakteri)",
  "suhu": 28.0,
  "kelembaban": 80.0,
  "prediksi_cuaca": "Hujan"
}
```

**Response:**
```json
{
  "Analisis": "Jelaskan secara singkat MASALAH YANG ADA...",
  "Langkah Preventif": "Tindakan pencegahan dengan rumus JIKA X MAKA Y...",
  "Rekomendasi Obat": "Solusi medis/teknis dengan rumus JIKA X MAKA Y..."
}
```
