# Script untuk Deploy Aplikasi ke Google Cloud Run & Cloud SQL
# Harap baca panduan di cloud_run_deployment_guide.md terlebih dahulu sebelum menjalankan.

$PROJECT_ID = "GANTI_DENGAN_PROJECT_ID_ANDA"
$REGION = "asia-southeast2"
$DB_PASSWORD = "password_super_rahasia_123!"

Write-Host "Pastikan Anda sudah login menggunakan: gcloud auth login"
Write-Host "Setel project menggunakan: gcloud config set project $PROJECT_ID"
Write-Host ""
Write-Host "Pilih opsi:"
Write-Host "1. Buat Database Cloud SQL"
Write-Host "2. Deploy AI Engine (Python)"
Write-Host "3. Deploy Web App (Laravel)"
Write-Host "4. Deploy Semua (1, 2, dan 3)"
$pilihan = Read-Host "Masukkan pilihan Anda (1/2/3/4)"

if ($pilihan -eq '1' -or $pilihan -eq '4') {
    Write-Host "`n[1/3] Membuat Database Cloud SQL..."
    # Buat instance
    gcloud sql instances create hackathon-db --database-version=MYSQL_8_0 --tier=db-f1-micro --region=$REGION --root-password=$DB_PASSWORD
    # Buat database
    gcloud sql databases create backend_core --instance=hackathon-db
    Write-Host "Cloud SQL berhasil dibuat!"
}

if ($pilihan -eq '2' -or $pilihan -eq '4') {
    Write-Host "`n[2/3] Deploy AI Engine..."
    # Build Image
    gcloud builds submit --tag "gcr.io/$PROJECT_ID/ai-engine" -f deployment/Dockerfile.api .
    # Deploy
    gcloud run deploy ai-engine `
        --image "gcr.io/$PROJECT_ID/ai-engine" `
        --platform managed `
        --region $REGION `
        --allow-unauthenticated `
        --port 8001
    Write-Host "AI Engine berhasil di-deploy!"
}

if ($pilihan -eq '3' -or $pilihan -eq '4') {
    Write-Host "`n[3/3] Deploy Web App..."
    
    $CONNECTION_NAME = gcloud sql instances describe hackathon-db --format="value(connectionName)"
    $AI_URL = gcloud run services describe ai-engine --platform managed --region $REGION --format="value(status.url)"
    
    # Build Image
    gcloud builds submit --tag "gcr.io/$PROJECT_ID/web-app" -f deployment/Dockerfile.web .
    
    # Deploy
    gcloud run deploy web-app `
        --image "gcr.io/$PROJECT_ID/web-app" `
        --platform managed `
        --region $REGION `
        --allow-unauthenticated `
        --port 8000 `
        --add-cloudsql-instances=$CONNECTION_NAME `
        --set-env-vars="DB_CONNECTION=mysql,DB_SOCKET=/cloudsql/$CONNECTION_NAME,DB_DATABASE=backend_core,DB_USERNAME=root,DB_PASSWORD=$DB_PASSWORD,AI_API_URL=$AI_URL,APP_ENV=production,APP_DEBUG=true,APP_KEY=base64:rahasia="
    Write-Host "Web App berhasil di-deploy!"
}

Write-Host "`nSelesai! Untuk menjalankan migrasi database, masuk ke container Web App melalui Cloud Shell dan jalankan 'php artisan migrate --force'."
