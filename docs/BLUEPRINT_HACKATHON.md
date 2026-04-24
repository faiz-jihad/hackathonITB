# 📐 Blueprint Pengembangan MangsaPadi S.E.E.D
**Edisi Hackathon 2026: Ketahanan Pangan Nasional**

Dokumen ini berfungsi sebagai panduan teknis bagi tim (FE, BE, AI) agar proses pengembangan tetap selaras, efisien, dan memiliki standar kualitas tinggi sesuai kriteria penilaian juri.

---

## 🏗️ 1. Arsitektur Global
Sistem menggunakan pendekatan **Microservices Minimalis** berbasis Docker:
- **Web App (Port 8080)**: Laravel 11 (Orchestrator).
- **AI Engine (Port 8081)**: FastAPI (Brain).
- **Database (Port 3307)**: MySQL 8.0 (Persistence).

---

## 🎨 2. Frontend (FE) Engineer Blueprint
**Fokus Utama**: *Aesthetic Wow Factor*, UX intuitif, dan visualisasi data AI.

### Tanggung Jawab:
- **Modern UI Styling**: Mengimplementasikan tema Emerald-Zinc dengan sentuhan *Glassmorphism* dan *Subtle Gradients* menggunakan Tailwind CSS.
- **Micro-Animations**:
  - `Loading-Spinner`: Overlay layar penuh dengan *pulsing logo* saat AI sedang memproses.
  - `Drag-and-Drop`: Area unggah yang memberikan *preview* instan setelah gambar dipilih.
- **Responsive Design**: Memastikan UI berjalan sempurna di perangkat Mobile (untuk petani di lapangan) maupun Desktop (untuk admin/penyuluh).
- **Editorial Layout**: Menyusun tampilan hasil (Result) agar teks rekomendasi dari Gemini AI mudah dibaca (typography tinggi, *line-height* lega).

---

## ⚙️ 3. Backend (BE) Engineer Blueprint
**Fokus Utama**: Integrasi sistem, keamanan data, dan stabilitas server.

### Tanggung Jawab:
- **API Integration**: Menghubungkan Laravel ke AI Engine via `AIService` menggunakan library `Http` (dengan *timeout* dan *error handling* yang kuat).
- **Database Management**: Merancang migrasi tabel `diagnosas` untuk menyimpan metadata gambar, hasil prediksi, dan teks rekomendasi RAG.
- **File System**: Menangani unggahan gambar secara aman ke dalam `storage/app/public` dan memastikan symlink (`storage:link`) aktif.
- **Containerization**: Mengelola `docker-compose.yml` agar semua layanan saling terhubung melalui *internal network* Docker.
- **Environment Logic**: Memastikan konfigurasi `.env` (API Keys, Database Host) tetap sinkron dan aman.

---

## 🧠 4. AI Engineer Blueprint
**Fokus Utama**: Akurasi Computer Vision dan kualitas Rekomendasi Generative (RAG).

### Tanggung Jawab:
- **Computer Vision Model**: 
  - Memastikan model MobileNetV2 (.h5) terintegrasi dengan benar di FastAPI.
  - Melakukan pra-proses gambar (resize 224x224, rescaling) sesuai kebutuhan input model.
- **RAG System (Retrieval-Augmented Generation)**:
  - Mengelola `knowledge_base.json` berisi data agronomis dan kearifan lokal yang valid.
  - Melakukan *Prompt Engineering* pada `gemini_rag.py` agar output Gemini AI terstruktur dalam 3 paragraf sesuai target S.E.E.D.
- **API Development**: Menyediakan endpoint `/predict` yang mengembalikan JSON bersih untuk dikonsumsi oleh Backend.
- **Gemini 3 Flash Integration**: Menggunakan SDK `google-generativeai` dengan penanganan limitasi API (timeout & retry logic).

---

## ⏳ 5. Strategi Target (Timeline Hackathon)
Agar tim tetap fokus pada *Core Value* (RAG & AI):

| Fase | Durasi | Target Output |
| :--- | :--- | :--- |
| **I: Scaffolding** | 2 Jam | Docker Up & Running, Migrasi DB selesai. |
| **II: Core Logic** | 4 Jam | AI Predict berfungsi, Data RAG tersuntik ke Gemini. |
| **III: UI Polish** | 6 Jam | Desain Premium, Animasi Loading, Responsive Check. |
| **IV: Final Audit** | 2 Jam | Tes E2E (End-to-End), Penulisan Dokumentasi, Persiapan Demo. |

---

## 💡 Kriteria "Winning App"
- **Unique Selling Point**: Kolaborasi antara Ilmu Modern & Kearifan Lokal (S.E.E.D).
- **Performance**: Prediksi di bawah 5 detik (setelah *warm-up*).
- **Scalability**: Arsitektur Docker memudahkan deployment ke cloud (AWS/GCP).

---
*Blueprint ini bersifat dinamis dan dapat disesuaikan dengan kebutuhan teknis mendadak selama hackathon berlangsung.*
