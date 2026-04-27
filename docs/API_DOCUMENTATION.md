# API Documentation

## `POST /predict`
Endpoint AI utama untuk menerima gambar daun padi, melakukan klasifikasi penyakit menggunakan Computer Vision, dan mengembalikan rekomendasi penanganan otomatis dari Gemini RAG.

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
    "Langkah Preventif": "Tindakan pencegahan dengan rumus JIKA X MAKA Y...",
    "Rekomendasi Obat": "Solusi medis/teknis dengan rumus JIKA X MAKA Y..."
  }
}
```

---

## `POST /recommend`
Endpoint AI sekunder untuk meminta ulang saran dari Gemini RAG secara spesifik berdasarkan nama penyakit dan metrik cuaca tanpa perlu mengirim gambar.

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
