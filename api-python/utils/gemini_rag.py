import os
import json
import google.generativeai as genai
from dotenv import load_dotenv

# Load env variables
load_dotenv()

# Setup Gemini API
GEMINI_API_KEY = os.getenv("GEMINI_API_KEY")
if GEMINI_API_KEY and GEMINI_API_KEY != "your_google_gemini_api_key_here":
    genai.configure(api_key=GEMINI_API_KEY)
    gemini_model = genai.GenerativeModel('gemini-2.5-flash')
else:
    gemini_model = None

# Load Knowledge Base
KB_PATH = os.path.join(os.path.dirname(__file__), '..', 'data', 'knowledge_base.json')
try:
    with open(KB_PATH, 'r') as f:
        KNOWLEDGE_BASE = json.load(f)
except Exception:
    KNOWLEDGE_BASE = {}

def generate_recommendation(disease_name: str, confidence: float) -> str:
    """
    Generate agricultural recommendation using Gemini 1.5 Flash based on RAG knowledge base.
    """
    if not gemini_model:
        return "Rekomendasi AI tidak tersedia: GEMINI_API_KEY belum dikonfigurasi."
    
    # RAG Lookup
    disease_info = KNOWLEDGE_BASE.get(disease_name, {})
    agronomi = disease_info.get("agronomi_modern", "Data agronomi tidak tersedia.")
    kearifan = disease_info.get("kearifan_lokal", "Data kearifan lokal tidak tersedia.")
    
    prompt = f"""
    Anda adalah asisten ahli pertanian bernama MangsaPadi. Sistem deteksi kami mendeteksi penyakit: "{disease_name}" 
    pada daun padi dengan tingkat kepercayaan {confidence:.2f}%.
    
    Berikut adalah basis pengetahuan (Knowledge Base) kami untuk penyakit ini:
    - Ilmu Agronomi Modern: {agronomi}
    - Kearifan Lokal: {kearifan}
    
    Tugas Anda:
    Buatkan rekomendasi tindakan untuk petani. Rekomendasi harus singkat, praktis, dan menggabungkan 
    kedua pendekatan (agronomi dan kearifan lokal) tersebut. Format jawaban dalam 3 paragraf:
    1. Konfirmasi singkat tentang penyakit tersebut (dengan nada empati dan profesional).
    2. Rekomendasi tindakan secara kearifan lokal (ramah lingkungan / murah).
    3. Rekomendasi tindakan agronomi modern (pengendalian kimia/mekanis jika kondisi parah).
    
    Jangan gunakan kata-kata markdown yang berlebihan, cukup teks yang mudah dibaca.
    """
    
    try:
        response = gemini_model.generate_content(prompt, request_options={"timeout": 15})
        return response.text.strip()
    except Exception as e:
        return f"Terjadi kesalahan saat menghasilkan rekomendasi dari AI: {str(e)}"
