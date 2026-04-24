from fastapi import FastAPI, File, UploadFile
from fastapi.responses import JSONResponse
import tensorflow as tf
import numpy as np
from PIL import Image
import io

# Inisialisasi Aplikasi API
app = FastAPI(title="MangsaPadi AI API")

# Memuat model saat server menyala (Pastikan nama filenya sama persis!)
print("Memuat otak AI MangsaPadi...")
model = tf.keras.models.load_model('model_penyakit_padi_v2_finetuned.h5', compile=False)

# Daftar 10 kelas penyakit padi (sesuai urutan abjad dari Kaggle)
kelas_penyakit = [
    'Bacterial Leaf Blight (Hawar Daun Bakteri)',
    'Bacterial Leaf Streak (Bercak Daun Bakteri)',
    'Bacterial Panicle Blight (Hawar Malai Bakteri)',
    'Blast (Penyakit Blas)',
    'Brown Spot (Bercak Cokelat)',
    'Dead Heart (Penggerek Batang)',
    'Downy Mildew (Bulu Embun)',
    'Hispa (Hama Hispa)',
    'Normal (Padi Sehat)',
    'Tungro (Penyakit Tungro)'
]

@app.get("/")
def read_root():
    return {"message": "Server API MangsaPadi Menyala dan Siap Menerima Foto!"}

@app.post("/predict")
async def predict(file: UploadFile = File(...)):
    try:
        # 1. Baca gambar yang dikirim dari Laravel
        contents = await file.read()
        image = Image.open(io.BytesIO(contents)).convert("RGB")
        
        # 2. Preprocessing (Samakan persis dengan di Colab)
        image = image.resize((224, 224))
        img_array = np.array(image) / 255.0
        img_array = np.expand_dims(img_array, axis=0)
        
        # 3. Prediksi dengan AI
        prediksi = model.predict(img_array)
        indeks = np.argmax(prediksi[0])
        akurasi = float(np.max(prediksi[0]) * 100)
        
        # 4. Kirim balasan ke Laravel (Format JSON)
        return JSONResponse(content={
            "penyakit": kelas_penyakit[indeks],
            "akurasi": akurasi
        })
        
    except Exception as e:
        # Jika ada error, kirim pesan error agar Laravel tidak crash
        return JSONResponse(content={"error": str(e)}, status_code=500)