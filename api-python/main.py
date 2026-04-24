from fastapi import FastAPI
from routes.predict import router as predict_router

# Inisialisasi Aplikasi API
app = FastAPI(title="MangsaPadi AI API")

# Include routers
app.include_router(predict_router)

@app.get("/")
def read_root():
    return {"message": "Server API MangsaPadi Menyala dan Siap Menerima Foto!"}