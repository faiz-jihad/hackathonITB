# 🌾 SEED: Smart Eco-Expert Detector (MangsaPadi)
### *Karya Tim PECINTASAWIT untuk Ketahanan Iklim & Pangan*

<div align="center">
  
![SEED Banner](https://readme-typing-svg.demolab.com?font=Fira+Code&weight=800&size=35&duration=3000&pause=1000&color=2E8B57&center=true&vCenter=true&width=800&lines=%F0%9F%8C%BE+SEED+%3A+Smart+Eco-Expert+Detector;%F0%9F%93%B8+Deteksi+Instan+Penyakit+Padi;%F0%9F%A7%A0+Ditenagai+AI+%26+TensorFlow;%F0%9F%8C%8D+Untuk+Ketahanan+Iklim+%26+Pangan)

</div>

<div align="center">
  
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white&labelColor=black&color=FF2D20)](https://laravel.com)
[![FastAPI](https://img.shields.io/badge/FastAPI-005571?style=for-the-badge&logo=fastapi&labelColor=black&color=009688)](https://fastapi.tiangolo.com/)
[![TensorFlow](https://img.shields.io/badge/TensorFlow-FF6F00?style=for-the-badge&logo=tensorflow&logoColor=white&labelColor=black&color=FF6F00)](https://www.tensorflow.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white&labelColor=black&color=38B2AC)](https://tailwindcss.com/)
[![Python](https://img.shields.io/badge/Python-3776AB?style=for-the-badge&logo=python&logoColor=white&labelColor=black&color=3776AB)](https://www.python.org/)

</div>

<br>

<div align="center">
  
```text
🌱 "Melihat Daun, Menyelamatkan Panen" 🌱
🎬 Tentang SEED (MangsaPadi)
SEED (Smart Eco-Expert Detector) adalah solusi agrikultur cerdas berbasis AI yang dikembangkan untuk Hackathon bertema Climate Resilience & Local Wisdom. Cuaca ekstrem akibat perubahan iklim sering memicu lonjakan hama dan penyakit tanaman yang tak terprediksi. SEED hadir memberdayakan petani dengan antarmuka yang sangat ramah (Local Wisdom UI) untuk mendeteksi 10 jenis penyakit padi dalam hitungan detik.

⚡ FOTO	🧠 ANALISIS	📊 HASIL	🌾 SOLUSI
📸	🔬	📋	✅
JEPRET!	AI Bekerja	Diagnosis Akurat	Panen Terselamatkan
1 Detik	0.5 Detik	Instan	Masa Depan
✨ Keunggulan & Fitur Utama
🚀 Deteksi Super Cepat (< 2 Detik): Memanfaatkan arsitektur microservices, web tetap ringan sementara AI bekerja di background.

🎯 Akurasi Tinggi (93.15%): Ditenagai oleh model MobileNetV2 yang telah di-fine-tune secara khusus pada 10.000+ dataset daun padi.

🧑‍🌾 Local Wisdom UI: Desain antarmuka yang sederhana, menggunakan bahasa membumi agar mudah diakses oleh petani dari berbagai kalangan usia.

Bacterial Leaf Blight (Hawar Daun Bakteri / Kresek) 🦠

Bacterial Leaf Streak (Bercak Daun Bakteri) 🧫

Bacterial Panicle Blight (Hawar Malai Bakteri) 💀

Blast (Penyakit Blas) 💥

Brown Spot (Bercak Cokelat) 🟤

Dead Heart (Penggerek Batang / Beluk) 🪱

Downy Mildew (Bulu Embun) 🌫️

Hispa (Hama Kumbang Hispa) 🪲

Tungro (Penyakit Tungro) ☣️

Normal (Padi Sehat) ✅

🏗️ Arsitektur Microservices (Canggih di Balik Layar)
Kami memisahkan beban kerja sistem menjadi dua engine yang berkomunikasi via REST API agar aplikasi sangat tangguh dan scalable.

Cuplikan kode
sequenceDiagram
    actor Petani
    participant Web App (Laravel)
    participant API Gateway
    participant AI Engine (FastAPI)
    participant TensorFlow Model
    
    Petani->>Web App (Laravel): 📸 Upload Foto Padi
    activate Web App (Laravel)
    Web App (Laravel)->>API Gateway: 📤 Kirim file via HTTP POST
    deactivate Web App (Laravel)
    
    activate API Gateway
    API Gateway->>AI Engine (FastAPI): 🚀 Panggil /predict
    deactivate API Gateway
    
    activate AI Engine (FastAPI)
    AI Engine (FastAPI)->>TensorFlow Model: 🧮 Jalankan Inferensi .h5
    activate TensorFlow Model
    TensorFlow Model-->>AI Engine (FastAPI): 📊 Probabilitas 10 Kelas
    deactivate TensorFlow Model
    AI Engine (FastAPI)-->>API Gateway: 📦 Response JSON
    deactivate AI Engine (FastAPI)
    
    activate API Gateway
    API Gateway-->>Web App (Laravel): 📥 Return hasil diagnosis
    deactivate API Gateway
    
    activate Web App (Laravel)
    Web App (Laravel)-->>Petani: 🌾 Hasil & Rekomendasi
    deactivate Web App (Laravel)
🚀 Quick Start: Jalankan SEED di Lokal (Local Development)
Anda membutuhkan dua terminal yang berjalan bersamaan untuk menghidupkan Web App dan AI Engine.

1. Kloning Repository
Bash
git clone [https://github.com/PecintaSawit-Team/mangsapadi.git](https://github.com/PecintaSawit-Team/mangsapadi.git)
cd mangsapadi
2. Hidupkan AI Engine (Terminal 1 - FastAPI)
Bash
cd api-python

# Install library (Pastikan Python 3.10+ terpasang)
pip install -r requirements.txt

# Nyalakan server AI (Aktif di [http://127.0.0.1:8000](http://127.0.0.1:8000))
uvicorn main:app --reload
3. Hidupkan Web App (Terminal 2 - Laravel)
Bash
cd backend-core

# Install library PHP
composer install

# Siapkan environment
cp .env.example .env
php artisan key:generate

# Hubungkan folder penyimpanan gambar
php artisan storage:link

# Nyalakan server Web (Aktif di http://localhost:8000)
php artisan serve
🎉 Selesai! Buka browser Anda di http://localhost:8000 dan cobalah mengunggah foto daun padi.

📊 Performa Model AI (MobileNetV2)
Plaintext
               🎯 OVERALL ACCURACY: 93.15% | F1-Score: 0.92

    [INFO] Proses Training:
    ✅ Base Model   : MobileNetV2 (Transfer Learning via ImageNet)
    ✅ Optimizer    : Adam (Learning Rate disesuaikan)
    ✅ Augmentasi   : Rotation, Horizontal Flip, Zoom Range
    ✅ Callbacks    : EarlyStopping & ModelCheckpoint diimplementasikan
👨‍💻 Kolaborator Hebat di Balik SEED (Tim PECINTASAWIT)

Tino Nurcahya


TIO Ramadhan


Faiz Jihad A.B.

🎨 Frontend Engineer	⚙️ Backend Engineer	🧠 AI Engineer
UI/UX magis yang ramah petani dengan Tailwind & Blade!	Arsitektur web tangguh, Routing, & Integrasi API Laravel!	Data Preprocessing, Fine-Tuning, & FastAPI Engine!
Plaintext
╔═══════════════════════════════════════════════════════╗
║                                                       ║
║   🌾 Kami percaya teknologi harus menyentuh bumi.     ║
║   Dari petani, oleh teknologi, untuk masa depan.      ║
║                                                       ║
║   SEED adalah bukti bahwa AI dan kearifan lokal       ║
║   bisa berjalan bersama menyongsong ketahanan pangan. ║
║                                                       ║
║   — Tim PECINTASAWIT 🌱                               ║
║                                                       ║
╚═══════════════════════════════════════════════════════╝
Dibuat dengan ☕ dan ❤️ untuk Petani Indonesia.
