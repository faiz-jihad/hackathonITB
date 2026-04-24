# API Documentation

## `POST /predict`
Endpoint AI untuk menerima gambar daun padi dan mengembalikan prediksi penyakit.

**Request:**
- Header: `Content-Type: multipart/form-data`
- Body: `file` (Gambar daun padi - `.jpg`, `.png`, `.jpeg`)

**Response:**
```json
{
  "penyakit": "Blast (Penyakit Blas)",
  "akurasi": 98.5
}
```
