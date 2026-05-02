from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from routes.predict import router as predict_router
import os

# Inisialisasi Aplikasi API
app = FastAPI(title="MangsaPadi AI API")

# Konfigurasi CORS agar hanya backend Laravel yang bisa mengakses API ini
ALLOWED_ORIGINS = os.getenv("ALLOWED_ORIGINS", "http://localhost,http://localhost:8000,http://web,http://127.0.0.1:8000").split(",")

app.add_middleware(
    CORSMiddleware,
    allow_origins=ALLOWED_ORIGINS,
    allow_credentials=True,
    allow_methods=["GET", "POST"],
    allow_headers=["*"],
)

# Include routers
app.include_router(predict_router)

@app.get("/")
def read_root():
    return {"message": "Server API MangsaPadi Menyala dan Siap Menerima Foto!"}