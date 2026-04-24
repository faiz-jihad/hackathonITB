from fastapi import APIRouter, File, UploadFile
from fastapi.responses import JSONResponse
import tensorflow as tf
import numpy as np
import os
from utils.preprocessing import preprocess_image
from utils.labels import load_labels
from utils.validation import validate_image
from utils.gemini_rag import generate_recommendation

router = APIRouter()

# Load Model
MODEL_PATH = os.path.join(os.path.dirname(__file__), '..', 'model', 'rice_disease_model.h5')
# Try to load model, handle if not found yet (for boilerplate setup)
try:
    model = tf.keras.models.load_model(MODEL_PATH, compile=False)
except Exception as e:
    print(f"Warning: Model not found at {MODEL_PATH}. Prediction will fail until model is provided.")
    model = None

# Load Labels
LABELS_PATH = os.path.join(os.path.dirname(__file__), '..', 'model', 'class_labels.json')
try:
    kelas_penyakit = load_labels(LABELS_PATH)
except Exception as e:
    kelas_penyakit = []

@router.post("/predict")
async def predict(file: UploadFile = File(...)):
    try:
        # Validate File
        validate_image(file)
        
        # 1. Baca gambar yang dikirim
        contents = await file.read()
        
        # 2. Preprocessing
        img_array = preprocess_image(contents)
        
        if model is None:
            return JSONResponse(content={"error": "Model not loaded"}, status_code=500)
            
        # 3. Prediksi dengan AI
        prediksi = model.predict(img_array)
        indeks = np.argmax(prediksi[0])
        akurasi = float(np.max(prediksi[0]) * 100)
        
        if not kelas_penyakit:
            return JSONResponse(content={"error": "Labels not loaded"}, status_code=500)
            
        penyakit = kelas_penyakit[indeks]
        
        # 4. Generate Rekomendasi (Gemini RAG)
        rekomendasi = generate_recommendation(penyakit, akurasi)
        
        # 5. Kirim balasan
        return JSONResponse(content={
            "penyakit": penyakit,
            "akurasi": akurasi,
            "rekomendasi": rekomendasi
        })
        
    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)
