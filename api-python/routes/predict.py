from fastapi import APIRouter, File, UploadFile, Form
from fastapi.responses import JSONResponse
import tensorflow as tf
import numpy as np
import os
from utils.preprocessing import preprocess_image
from utils.labels import load_labels
from utils.validation import validate_image
from utils.gemini_rag import generate_recommendation, generate_structured_recommendation
from pydantic import BaseModel

router = APIRouter()

class RecommendationRequest(BaseModel):
    nama_penyakit: str
    suhu: float
    kelembaban: float
    prediksi_cuaca: str

# Load Model
MODEL_PATH = os.path.join(os.path.dirname(__file__), '..', 'model', 'model_penyakit_padi_v2_finetuned.h5')
class CustomDense(tf.keras.layers.Dense):
    @classmethod
    def from_config(cls, config):
        config.pop('quantization_config', None)
        return super().from_config(config)

model_load_error = None
try:
    model = tf.keras.models.load_model(
        MODEL_PATH, 
        compile=False, 
        custom_objects={'Dense': CustomDense}
    )
except Exception as e:
    model_load_error = str(e)
    model = None

# Load Labels
LABELS_PATH = os.path.join(os.path.dirname(__file__), '..', 'model', 'class_labels.json')
try:
    kelas_penyakit = load_labels(LABELS_PATH)
except Exception as e:
    kelas_penyakit = []

@router.post("/recommend")
async def get_structured_recommendation(request: RecommendationRequest):
    """
    Workflow: Receive JSON -> Call LLM -> Dynamic Prompt -> Parse Response -> Return Structured JSON.
    """
    try:
        recommendation = generate_structured_recommendation(
            request.nama_penyakit,
            request.suhu,
            request.kelembaban,
            request.prediksi_cuaca
        )
        return recommendation
    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)

@router.post("/predict")
async def predict(file: UploadFile = File(...), weather: str = Form(None)):
    try:
        # Validate File
        validate_image(file)
        
        # 1. Baca gambar yang dikirim
        contents = await file.read()
        
        # 2. Preprocessing
        img_array = preprocess_image(contents)
        
        if model is None:
            return JSONResponse(content={"error": f"Model not loaded. Details: {model_load_error}"}, status_code=500)
            
        # 3. Prediksi dengan AI
        prediksi = model.predict(img_array)
        indeks = np.argmax(prediksi[0])
        akurasi = float(np.max(prediksi[0]) * 100)
        
        if not kelas_penyakit:
            return JSONResponse(content={"error": "Labels not loaded"}, status_code=500)
            
        penyakit = kelas_penyakit[indeks]
        
        # 4. Generate Rekomendasi Terstruktur (Gemini RAG)
        # We use the new structured recommendation logic here
        try:
            # We can combine the best of both: 
            # Use the structured logic but pass the disease context
            rekomendasi = generate_structured_recommendation(
                penyakit,
                28.0, # Default if weather not parsed
                80.0, # Default if weather not parsed
                weather or "Normal"
            )
        except:
            # Fallback to simple recommendation if structured fails
            rekomendasi = {
                "Analisis": f"Terdeteksi penyakit {penyakit} dengan akurasi {akurasi:.1f}%.",
                "Langkah Preventif": "Jaga kebersihan lahan dan hindari kelembapan berlebih.",
                "Rekomendasi Obat": "Gunakan fungisida atau bakterisida yang sesuai."
            }
        
        # 5. Kirim balasan
        return JSONResponse(content={
            "penyakit": penyakit,
            "akurasi": akurasi,
            "rekomendasi": rekomendasi
        })
        
    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)
