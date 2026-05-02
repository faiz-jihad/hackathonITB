import os
import json
import re
from typing import Dict, Optional, List, Tuple
from datetime import datetime
import google.generativeai as genai
from dotenv import load_dotenv
import mysql.connector
from mysql.connector import Error

load_dotenv()

# Setup Gemini API
GEMINI_API_KEY = os.getenv("GEMINI_API_KEY")
GEMINI_MODEL_NAME = os.getenv("GEMINI_MODEL", "gemini-2.5-flash")

gemini_model = None
if GEMINI_API_KEY and GEMINI_API_KEY != "your_google_gemini_api_key_here":
    try:
        genai.configure(api_key=GEMINI_API_KEY)
        gemini_model = genai.GenerativeModel(
            GEMINI_MODEL_NAME,
            generation_config={
                "temperature": 0.1,
                "top_p": 0.9,
                "top_k": 40,
                "max_output_tokens": 1000,
                "response_mime_type": "application/json",
            },
            safety_settings=[
                {"category": "HARM_CATEGORY_HARASSMENT", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_HATE_SPEECH", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold": "BLOCK_NONE"},
                {"category": "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold": "BLOCK_NONE"},
            ]
        )
    except Exception as e:
        print(f"[ERROR] Gagal inisialisasi Gemini: {e}")

# Load Enhanced Knowledge Base
KB_PATH = os.path.join(os.path.dirname(__file__), "..", "data", "knowledge_base.json")
KNOWLEDGE_BASE = {}
try:
    with open(KB_PATH, "r", encoding="utf-8") as f:
        KNOWLEDGE_BASE = json.load(f)
    print(f"[INFO] Knowledge base dimuat: {len(KNOWLEDGE_BASE)} penyakit")
except FileNotFoundError:
    print(f"[WARNING] Knowledge base tidak ditemukan di: {KB_PATH}")
except json.JSONDecodeError:
    print(f"[ERROR] Format JSON tidak valid di: {KB_PATH}")


def validate_input(
    disease_name: str,
    confidence: float,
    weather_context: str = None,
    location: str = None,
    crop_stage: str = None,
) -> Tuple[bool, List[str]]:
    """Validasi semua input"""
    errors = []

    if (
        not disease_name
        or not isinstance(disease_name, str)
        or len(disease_name.strip()) < 2
    ):
        errors.append("Nama penyakit tidak valid")

    try:
        confidence = float(confidence)
        if confidence < 0 or confidence > 1:
            errors.append("Confidence harus antara 0.0 dan 1.0")
    except (TypeError, ValueError):
        errors.append("Confidence harus berupa angka")

    if weather_context and len(weather_context) > 500:
        errors.append("Konteks cuaca terlalu panjang")

    if location and len(location) > 100:
        errors.append("Nama lokasi terlalu panjang")

    if crop_stage and crop_stage not in [
        "semai",
        "anakan",
        "anakan_maksimum",
        "berbunga",
        "pengisian",
        "matang",
    ]:
        errors.append("Tahap tanaman tidak dikenali")

    return len(errors) == 0, errors


def analyze_conditions_risk(
    disease_info: Dict, weather_context: str, crop_stage: str
) -> Dict:
    """Analisis risiko komprehensif berdasarkan kondisi"""
    risk_analysis = {
        "risk_level": "rendah",
        "matching_conditions": [],
        "warning_messages": [],
        "recommended_actions": [],
    }

    if not disease_info or not weather_context:
        return risk_analysis

    kondisi_pemicu = disease_info.get("kondisi_pemicu", {})
    weather_lower = weather_context.lower()

    # Cek kecocokan cuaca
    cuaca_picu = kondisi_pemicu.get("cuaca", [])
    for kondisi in cuaca_picu:
        if kondisi in weather_lower:
            risk_analysis["matching_conditions"].append(f"Cuaca {kondisi}")
            risk_analysis["risk_level"] = "sedang"

    # Cek kelembaban
    if "lembab tinggi" in cuaca_picu and (
        "lembab" in weather_lower or "hujan" in weather_lower
    ):
        risk_analysis["matching_conditions"].append("Kelembaban tinggi")
        risk_analysis["risk_level"] = "tinggi"

    # Cek fase rentan
    fase_rentan = disease_info.get("fase_rentan", [])
    if crop_stage in fase_rentan:
        risk_analysis["matching_conditions"].append(f"Fase {crop_stage} yang rentan")
        if risk_analysis["risk_level"] == "rendah":
            risk_analysis["risk_level"] = "sedang"
        else:
            risk_analysis["risk_level"] = "tinggi"

    # Generate warning messages
    if risk_analysis["risk_level"] == "tinggi":
        risk_analysis["warning_messages"].append(
            "KONDISI SANGAT MENGUNTUNGKAN UNTUK PERKEMBANGAN PENYAKIT"
        )
        risk_analysis["warning_messages"].append(
            "Segera lakukan tindakan pencegahan maksimal"
        )
    elif risk_analysis["risk_level"] == "sedang":
        risk_analysis["warning_messages"].append(
            "Kondisi cukup mendukung perkembangan penyakit"
        )
        risk_analysis["warning_messages"].append(
            "Tingkatkan kewaspadaan dan monitoring"
        )

    return risk_analysis


def calculate_risk_score(confidence: float, conditions_risk: Dict) -> Tuple[int, str]:
    """Hitung skor risiko numerik dan level"""
    base_score = confidence * 50  # 0-50 dari confidence

    # Tambahan dari kondisi
    condition_bonus = 0
    if conditions_risk["risk_level"] == "tinggi":
        condition_bonus = 40
    elif conditions_risk["risk_level"] == "sedang":
        condition_bonus = 25

    # Bonus dari jumlah kondisi yang cocok
    matching_count = len(conditions_risk["matching_conditions"])
    condition_bonus += matching_count * 5

    total_score = min(base_score + condition_bonus, 100)

    # Tentukan level
    if total_score >= 80:
        level = "SANGAT TINGGI"
    elif total_score >= 60:
        level = "TINGGI"
    elif total_score >= 40:
        level = "SEDANG"
    elif total_score >= 20:
        level = "RENDAH"
    else:
        level = "MINIMAL"

    return total_score, level


def generate_comprehensive_fallback(
    disease_info: Dict,
    disease_name: str,
    confidence: float,
    weather_context: str,
    conditions_risk: Dict,
    risk_score: int,
    risk_level: str,
    location: str = None,
    crop_stage: str = None,
) -> str:
    """Generate fallback yang sangat detail dan terstruktur"""

    if not disease_info:
        return f"""
==================================================
ERROR: PENYAKIT TIDAK DIKENALI
==================================================

Penyakit "{disease_name}" tidak ditemukan dalam database.
Segera konsultasi dengan PPL atau ahli pertanian setempat.

==================================================
"""

    conf_percent = min(confidence * 100, 100)
    current_time = datetime.now().strftime("%d %B %Y, %H:%M")
    nama_lokal = disease_info.get("nama_lokal", disease_name)
    nama_ilmiah = disease_info.get("nama_ilmiah", "Tidak tersedia")
    kategori = disease_info.get("kategori", "Umum")

    # Info dasar
    output = f"""
==================================================
LAPORAN DIAGNOSA DAN REKOMENDASI MANGSA PADI
==================================================

WAKTU DIAGNOSA: {current_time}
LOKASI: {location if location else 'Tidak disebutkan'}
TAHAP TANAMAN: {crop_stage if crop_stage else 'Tidak spesifik'}

--------------------------------------------------
IDENTIFIKASI PENYAKIT
--------------------------------------------------
Penyakit: {disease_name}
Nama Lokal: {nama_lokal}
Nama Ilmiah: {nama_ilmiah}
Kategori: {kategori}
Tingkat Keyakinan Deteksi: {conf_percent:.1f}%

--------------------------------------------------
ANALISIS RISIKO
--------------------------------------------------
Skor Risiko: {risk_score}/100
Level Risiko: {risk_level}
"""

    # Analisis kondisi
    if conditions_risk["matching_conditions"]:
        output += "\nKondisi yang meningkatkan risiko:\n"
        for kondisi in conditions_risk["matching_conditions"]:
            output += f"- {kondisi}\n"

    if conditions_risk["warning_messages"]:
        output += "\nPERINGATAN:\n"
        for warning in conditions_risk["warning_messages"]:
            output += f"[!] {warning}\n"

    # Gejala
    output += f"""
--------------------------------------------------
GEJALA DAN IDENTIFIKASI
--------------------------------------------------
Gejala Awal:
{disease_info.get('gejala_awal', 'Tidak tersedia')}

Gejala Lanjut:
{disease_info.get('gejala_lanjut', 'Tidak tersedia')}

Deskripsi Lengkap:
{disease_info.get('gejala', 'Tidak tersedia')}

--------------------------------------------------
KONDISI PEMICU
--------------------------------------------------
"""

    kondisi_pemicu = disease_info.get("kondisi_pemicu", {})
    for key, value in kondisi_pemicu.items():
        if key != "cuaca":
            output += f"{key.upper()}: {value}\n"

    # Informasi penularan
    penularan = disease_info.get("penularan", [])
    if penularan:
        output += "\nCARA PENULARAN:\n"
        for cara in penularan:
            output += f"- {cara}\n"

    # Rekomendasi
    agronomi = disease_info.get("agronomi_modern", {})
    output += f"""
==================================================
REKOMENDASI TINDAKAN
==================================================

A. PENCEGAHAN (SEBELUM TERLALU PARAH):
"""

    if isinstance(agronomi, dict) and "pencegahan" in agronomi:
        for i, langkah in enumerate(agronomi["pencegahan"], 1):
            output += f"{i}. {langkah}\n"
    else:
        output += "Data pencegahan spesifik tidak tersedia.\n"

    output += "\nB. PENGENDALIAN (SAAT SUDAH TERSERANG):\n"

    if isinstance(agronomi, dict) and "pengendalian" in agronomi:
        for i, langkah in enumerate(agronomi["pengendalian"], 1):
            output += f"{i}. {langkah}\n"
    else:
        output += "Data pengendalian spesifik tidak tersedia.\n"

    if isinstance(agronomi, dict) and "interval_semprot" in agronomi:
        output += f"\nInterval Aplikasi: {agronomi['interval_semprot']}\n"
    if isinstance(agronomi, dict) and "waktu_aplikasi" in agronomi:
        output += f"Waktu Terbaik: {agronomi['waktu_aplikasi']}\n"

    # Kearifan lokal
    kearifan = disease_info.get("kearifan_lokal", {})
    output += f"""
==================================================
SOLUSI TRADISIONAL (KEARIFAN LOKAL)
==================================================
"""

    if isinstance(kearifan, dict) and "bahan" in kearifan:
        for i, bahan in enumerate(kearifan["bahan"], 1):
            output += f"""
{i}. {bahan.get('nama', 'Tanpa nama').upper()}
   Cara Membuat: {bahan.get('cara', 'Tidak tersedia')}
   Frekuensi: {bahan.get('frekuensi', 'Tidak spesifik')}
   Efektivitas: {bahan.get('efektivitas', 'Tidak diketahui')}
"""
    elif isinstance(kearifan, dict) and "tradisi" in kearifan:
        for i, tradisi in enumerate(kearifan["tradisi"], 1):
            output += f"""
{i}. {tradisi.get('nama', 'Tanpa nama').upper()}
   Cara: {tradisi.get('cara', 'Tidak tersedia')}
   Frekuensi: {tradisi.get('frekuensi', 'Tidak spesifik')}
   Efektivitas: {tradisi.get('efektivitas', 'Tidak diketahui')}
"""

    # Dampak
    dampak = disease_info.get("potensi_dampak", {})
    output += f"""
==================================================
POTENSI KERUGIAN
==================================================
"""

    if isinstance(dampak, dict):
        for fase, deskripsi in dampak.items():
            if fase != "kerugian_ekonomi":
                output += f"Fase {fase}: {deskripsi}\n"
        if "kerugian_ekonomi" in dampak:
            output += f"\nEstimasi Kerugian: {dampak['kerugian_ekonomi']}\n"

    # Ambang ekonomi dan siklus
    output += f"""
==================================================
INFORMASI TEKNIS PENTING
==================================================
Ambang Ekonomi: {disease_info.get('ambang_ekonomi', 'Tidak ditentukan')}
Siklus Hidup: {disease_info.get('siklus_hidup', 'Tidak diketahui')}
Predator Alami: {disease_info.get('predator_alami', 'Tidak teridentifikasi')}

==================================================
JADWAL PEMANTAUAN HARIAN
==================================================

PAGI (06:00 - 08:00):
- Periksa daun bagian bawah dan tengah untuk gejala awal
- Amati permukaan bawah daun saat embun masih ada
- Catat jumlah tanaman/rumpun yang menunjukkan gejala baru

SORE (16:00 - 18:00):
- Lakukan aplikasi pengendalian jika diperlukan
- Evaluasi efektivitas tindakan yang sudah dilakukan
- Periksa populasi hama/serangga aktif

FREKUENSI PEMERIKSAAN: {"Setiap hari" if risk_score >= 60 else "Setiap 2-3 hari" if risk_score >= 40 else "Setiap minggu"}

--------------------------------------------------
Dokumen dibuat: {current_time}
MangsaPadi - Asisten Pertanian Cerdas
==================================================
"""

    return output


def generate_recommendation(
    disease_name: str,
    confidence: float,
    weather_context: str = None,
    location: str = None,
    crop_stage: str = None,
) -> str:
    """
    Generate rekomendasi pertanian yang sangat detail dan praktis.
    """

    # Validasi input
    is_valid, errors = validate_input(
        disease_name, confidence, weather_context, location, crop_stage
    )
    if not is_valid:
        error_text = "ERROR INPUT:\n"
        for error in errors:
            error_text += f"- {error}\n"
        return error_text

    # Ambil data penyakit
    disease_info = KNOWLEDGE_BASE.get(disease_name, {})

    if not disease_info:
        return f"""
==================================================
PERINGATAN: PENYAKIT TIDAK DIKENALI
==================================================

Penyakit "{disease_name}" tidak ditemukan dalam database MangsaPadi.

Tindakan yang disarankan:
1. Ambil sampel tanaman yang sakit
2. Foto gejala dengan jelas
3. Segera hubungi PPL atau penyuluh pertanian setempat
4. Jangan melakukan pengobatan sebelum identifikasi pasti

==================================================
"""

    # Analisis risiko
    conditions_risk = analyze_conditions_risk(
        disease_info, weather_context or "", crop_stage or ""
    )
    risk_score, risk_level = calculate_risk_score(confidence, conditions_risk)

    # Jika API tidak tersedia, gunakan fallback komprehensif
    if not gemini_model:
        return generate_comprehensive_fallback(
            disease_info,
            disease_name,
            confidence,
            weather_context,
            conditions_risk,
            risk_score,
            risk_level,
            location,
            crop_stage,
        )

    # Siapkan konteks untuk prompt
    nama_lokal = disease_info.get("nama_lokal", disease_name)
    nama_ilmiah = disease_info.get("nama_ilmiah", "")
    kategori = disease_info.get("kategori", "")
    conf_percent = min(confidence * 100, 100)
    current_time = datetime.now().strftime("%d %B %Y, %H:%M")

    # Prompt yang sangat terstruktur
    prompt = f"""Anda adalah MangsaPadi, asisten penyuluh pertanian padi profesional di Indonesia.

Gunakan bahasa Indonesia sederhana, tegas, dan praktis seperti penyuluh lapangan yang berbicara langsung ke petani.

DATA DIAGNOSA:
- Waktu: {current_time}
- Lokasi: {location if location else 'Tidak spesifik'}
- Tahap Tanam: {crop_stage if crop_stage else 'Tidak spesifik'}
- Penyakit: {disease_name}
- Nama Lokal: {nama_lokal}
- Nama Ilmiah: {nama_ilmiah}
- Kategori: {kategori}
- Tingkat Keyakinan: {conf_percent:.1f}%
- Skor Risiko: {risk_score}/100
- Level Risiko: {risk_level}

KONDISI LINGKUNGAN:
- Cuaca: {weather_context if weather_context else 'Tidak terdeteksi'}

KONDISI BERISIKO TERPENUHI:
{chr(10).join(['- ' + c for c in conditions_risk['matching_conditions']]) if conditions_risk['matching_conditions'] else '- Tidak ada yang terpenuhi'}

DATA TEKNIS PENYAKIT:
- Gejala Awal: {disease_info.get('gejala_awal', '')}
- Gejala Lanjut: {disease_info.get('gejala_lanjut', '')}
- Deskripsi Lengkap: {disease_info.get('gejala', '')}

PENCEGAHAN:
{chr(10).join(['- ' + p for p in disease_info.get('agronomi_modern', {}).get('pencegahan', [])])}

PENGENDALIAN:
{chr(10).join(['- ' + p for p in disease_info.get('agronomi_modern', {}).get('pengendalian', [])])}

Waktu Aplikasi: {disease_info.get('agronomi_modern', {}).get('waktu_aplikasi', 'Pagi/sore')}
Interval: {disease_info.get('agronomi_modern', {}).get('interval_semprot', '7-14 hari')}

SOLUSI TRADISIONAL:
{chr(10).join(['- ' + b.get('nama', '') + ': ' + b.get('cara', '') for b in disease_info.get('kearifan_lokal', {}).get('bahan', [])])}

POTENSI KERUGIAN:
{chr(10).join(['- ' + k + ': ' + v for k, v in disease_info.get('potensi_dampak', {}).items()])}

Ambang Ekonomi: {disease_info.get('ambang_ekonomi', '')}
Cara Penularan: {', '.join(disease_info.get('penularan', []))}
Predator Alami: {disease_info.get('predator_alami', '')}

TUGAS ANDA:
Buat rekomendasi terstruktur dengan format berikut (MAKSIMAL 800 KATA):

1. HASIL DIAGNOSA DAN ANALISIS RISIKO (singkat, 2-3 kalimat)
   Jelaskan apa penyakit ini, seberapa serius kondisinya saat ini.

2. TINDAKAN SEGERA HARI INI (3-5 langkah praktis)
   Setiap langkah harus jelas: APA, BAGAIMANA, KAPAN.

3. STRATEGI JANGKA PENDEK (3-7 hari ke depan)
   Apa yang harus dilakukan secara rutin.

4. SOLUSI BERTAHAP (ringan ke berat)
   Tahap 1 (ringan): solusi tradisional
   Tahap 2 (sedang): kombinasi
   Tahap 3 (berat): solusi modern/teknis

5. JADWAL PEMANTAUAN PRAKTIS
   Pagi: apa yang diamati
   Sore: apa yang dilakukan

6. PERINGATAN PENTING
   - Larangan spesifik
   - Tanda harus hubungi ahli

ATURAN BAHASA:
- Tidak menggunakan emoji atau simbol dekoratif
- Gunakan poin bernomor atau bullet (-)
- Kalimat pendek, maksimal 20 kata per kalimat
- Langsung ke inti, tidak bertele-tele
- Gunakan istilah yang dipahami petani
"""

    try:
        response = gemini_model.generate_content(
            prompt, request_options={"timeout": 45}
        )

        response_text = response.text.strip()

        # Validasi panjang minimum
        if len(response_text) < 150:
            return generate_comprehensive_fallback(
                disease_info,
                disease_name,
                confidence,
                weather_context,
                conditions_risk,
                risk_score,
                risk_level,
                location,
                crop_stage,
            )

        # Tambahkan footer
        response_text += f"""

==================================================
Rekomendasi dibuat: {current_time}
MangsaPadi - Asisten Pertanian Cerdas
==================================================
"""

        return response_text

    except Exception as e:
        print(f"[WARNING] Gemini Error: {str(e)}")
        return generate_comprehensive_fallback(
            disease_info,
            disease_name,
            confidence,
            weather_context,
            conditions_risk,
            risk_score,
            risk_level,
            location,
            crop_stage,
        )


def fetch_kearifan_lokal_dari_db(nama_penyakit: str) -> Dict:
    """Mengambil data kearifan lokal dari MySQL database Laravel."""
    try:
        connection = mysql.connector.connect(
            host=os.getenv("DB_HOST", "db"),
            database=os.getenv("DB_DATABASE", "backend_core"),
            user=os.getenv("DB_USERNAME", "root"),
            password=os.getenv("DB_PASSWORD", "secret")
        )
        if connection.is_connected():
            cursor = connection.cursor(dictionary=True)
            # Cari berdasarkan keyword nama penyakit
            query = "SELECT * FROM kearifan_lokals WHERE nama_penyakit LIKE %s ORDER BY created_at DESC LIMIT 1"
            cursor.execute(query, (f"%{nama_penyakit}%",))
            record = cursor.fetchone()
            return record if record else {}
    except Error as e:
        print(f"[ERROR DB] Gagal mengambil kearifan lokal: {e}")
    finally:
        if 'connection' in locals() and connection.is_connected():
            cursor.close()
            connection.close()
    return {}


def generate_structured_recommendation(
    nama_penyakit: str, suhu: float, kelembaban: float, prediksi_cuaca: str
) -> Dict:
    """
    Generate structured agricultural recommendation in JSON format.
    Workflow: Receive inputs -> Build prompt -> Call LLM -> Parse JSON -> Return Dict.
    """
    if not gemini_model:
        return {
            "Analisis": f"Identifikasi penyakit: {nama_penyakit} pada kondisi suhu {suhu}°C dan kelembaban {kelembaban}%.",
            "Langkah Preventif": "Pastikan sanitasi lahan terjaga dan hindari genangan air berlebih.",
            "Rekomendasi Obat": "Konsultasikan dengan penyuluh pertanian untuk pestisida yang tepat.",
        }

    # Ambil konteks dari Knowledge Base untuk mencegah AI berhalusinasi
    disease_info = KNOWLEDGE_BASE.get(nama_penyakit, {})
    kb_context = ""
    if disease_info:
        agronomi = disease_info.get('agronomi_modern', {})
        pencegahan = agronomi.get('pencegahan', [])
        pengendalian = agronomi.get('pengendalian', [])
        
        kb_context = f"""
    Referensi Penyakit (DARI BUKU INDUK):
    - Penyebab: {disease_info.get('scientific_name', '-')}
    - Pencegahan: {', '.join(pencegahan) if pencegahan else 'Gunakan sanitasi standar'}
    - Obat/Pengendalian: {', '.join(pengendalian) if pengendalian else 'Konsultasikan dengan penyuluh'}
    """

    # Tambahkan Konteks Kearifan Lokal dari Database
    kearifan_db = fetch_kearifan_lokal_dari_db(nama_penyakit)
    if kearifan_db:
        kb_context += f"""
    Referensi Kearifan Lokal & Obat dari Admin:
    - Penanganan RAG: {kearifan_db.get('penanganan_kearifan_lokal', '-')}
    - Rekomendasi Obat Spesifik: {kearifan_db.get('nama_obat', '-')} ({kearifan_db.get('deskripsi_obat', '-')})
    """

    prompt = f"""
    Anda adalah pakar agronomi senior Indonesia yang memberi saran langsung ke petani padi.
    Analisis penyakit berikut berdasarkan kondisi lingkungan terkini dan berikan solusi yang jelas.
    
    Data Input:
    - Nama Penyakit: {nama_penyakit}
    - Suhu Saat Ini: {suhu}°C
    - Kelembaban Saat Ini: {kelembaban}%
    - Prediksi Cuaca: {prediksi_cuaca}
    {kb_context}
    
    INSTRUKSI FORMAT:
    Berikan jawaban menggunakan TAG XML berikut. Jangan tambahkan teks apapun di luar tag.
    Gunakan format Markdown di DALAM setiap tag (bold, numbered list, dll) agar mudah dibaca.
    
    <analisis>
    Tulis 1-2 paragraf analisis kondisi tanaman berdasarkan data cuaca.
    Jelaskan mengapa kondisi saat ini berbahaya/aman untuk penyakit ini.
    Gunakan **bold** untuk istilah penting. Tulis seperti pakar yang menjelaskan ke petani.
    </analisis>
    
    <langkah>
    Berikan 4-6 langkah pencegahan dalam format daftar bernomor Markdown:
    1. **Judul langkah** — penjelasan singkat
    2. **Judul langkah** — penjelasan singkat
    Fokus pada tindakan nyata dan praktis yang bisa dilakukan petani.
    </langkah>
    
    <obat>
    Berikan 3-5 rekomendasi obat/teknis dalam format daftar bernomor Markdown:
    1. **Nama obat/teknik** — dosis, cara pakai, dan waktu aplikasi
    2. **Nama obat/teknik** — dosis, cara pakai, dan waktu aplikasi
    Sertakan nama bahan aktif dan dosis spesifik jika memungkinkan.
    </obat>
    
    <produk>
    Berikan 3-4 nama produk obat pertanian NYATA yang bisa dibeli petani di toko pertanian atau marketplace online untuk mengatasi penyakit ini.
    Format WAJIB per baris (satu produk per baris, pisahkan dengan newline):
    NamaProduk|BahanAktif|KisaranHarga|KataKunciCari
    
    Contoh:
    Nordox 56 WP|Tembaga Oksida 56%|Rp 45.000 - 65.000/250g|fungisida nordox 56 wp
    Agrept 20 WP|Streptomycin Sulfat 20%|Rp 35.000 - 50.000/50g|bakterisida agrept 20 wp
    
    PENTING: Gunakan nama produk yang BENAR-BENAR ADA di pasaran Indonesia. Jangan mengarang nama.
    </produk>
    
    <diy>
    Berikan 2-3 resep obat racikan sendiri (DIY) dari bahan-bahan murah/alami yang bisa digunakan petani untuk menghemat pengeluaran.
    Format daftar bernomor Markdown:
    1. **Nama Racikan** — Bahan: (daftar bahan). Cara buat: (langkah singkat). Cara pakai: (dosis dan frekuensi).
    2. **Nama Racikan** — Bahan: (daftar bahan). Cara buat: (langkah singkat). Cara pakai: (dosis dan frekuensi).
    Gunakan bahan yang mudah ditemukan di sekitar petani (bawang putih, kunyit, kapur sirih, abu sekam, dll).
    </diy>
    """

    try:
        response = gemini_model.generate_content(
            prompt,
            generation_config=genai.types.GenerationConfig(
                response_mime_type="text/plain",
                temperature=0.1,
                max_output_tokens=4096
            )
        )
        
        if not response or not hasattr(response, 'text') or not response.text:
            raise Exception("AI memberikan jawaban kosong atau terblokir filter keamanan.")
            
        text = response.text.strip()
        
        # Ekstraksi menggunakan XML tags
        analisis_match = re.search(r'<analisis>(.*?)</analisis>', text, re.DOTALL | re.IGNORECASE)
        langkah_match = re.search(r'<langkah>(.*?)</langkah>', text, re.DOTALL | re.IGNORECASE)
        obat_match = re.search(r'<obat>(.*?)</obat>', text, re.DOTALL | re.IGNORECASE)
        produk_match = re.search(r'<produk>(.*?)</produk>', text, re.DOTALL | re.IGNORECASE)
        diy_match = re.search(r'<diy>(.*?)</diy>', text, re.DOTALL | re.IGNORECASE)
        
        if not analisis_match or not langkah_match or not obat_match:
            raise Exception("Tag XML tidak lengkap.")
        
        # Parse produk ke list of dicts
        produk_list = []
        if produk_match:
            for line in produk_match.group(1).strip().split('\n'):
                line = line.strip()
                if '|' in line:
                    parts = [p.strip() for p in line.split('|')]
                    if len(parts) >= 4:
                        produk_list.append({
                            "nama": parts[0],
                            "bahan_aktif": parts[1],
                            "harga": parts[2],
                            "keyword": parts[3]
                        })
            
        return {
            "Analisis": analisis_match.group(1).strip(),
            "Langkah Preventif": langkah_match.group(1).strip(),
            "Rekomendasi Obat": obat_match.group(1).strip(),
            "Produk": produk_list,
            "DIY": diy_match.group(1).strip() if diy_match else ""
        }
            
    except Exception as e:
        error_msg = str(e)
        raw_text = getattr(response, 'text', 'NO_TEXT') if 'response' in locals() else 'NO_RESPONSE'
        print(f"[ERROR] Structured LLM Error: {error_msg}")
        print(f"[DEBUG] Raw Text: {raw_text}")
        
        debug_info = f"Error: {error_msg}. Raw: {raw_text}"
        return {
            "Analisis": f"Analisis teknis gagal diproses. Debug: {debug_info}",
            "Langkah Preventif": "- Pastikan sanitasi lahan terjaga\n- Hindari genangan air berlebih\n- Gunakan varietas tahan",
            "Rekomendasi Obat": "Konsultasikan dengan penyuluh pertanian (PPL) untuk rekomendasi teknis terbaru.",
            "Produk": [],
            "DIY": ""
        }

