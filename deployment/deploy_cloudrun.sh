#!/bin/bash
# Script untuk Deploy Aplikasi ke Google Cloud Run & Cloud SQL via Cloud Shell

echo "Masukkan PROJECT ID Google Cloud Anda:"
read PROJECT_ID

REGION="asia-southeast2"
DB_PASSWORD="password_super_rahasia_123!"

gcloud config set project $PROJECT_ID

echo ""
echo "Pilih opsi:"
echo "1. Buat Database Cloud SQL"
echo "2. Deploy AI Engine (Python)"
echo "3. Deploy Web App (Laravel)"
echo "4. Deploy Semua (1, 2, dan 3)"
read -p "Masukkan pilihan Anda (1/2/3/4): " pilihan

if [ "$pilihan" == "1" ] || [ "$pilihan" == "4" ]; then
    echo -e "\n[1/3] Membuat Database Cloud SQL..."
    gcloud sql instances create hackathon-db-v2 --database-version=MYSQL_8_0 --tier=db-f1-micro --region=$REGION --root-password=$DB_PASSWORD
    gcloud sql databases create backend_core --instance=hackathon-db-v2
    echo "Cloud SQL berhasil dibuat!"
fi

if [ "$pilihan" == "2" ] || [ "$pilihan" == "4" ]; then
    echo -e "\n[2/3] Deploy AI Engine..."
    # Salin sementara Dockerfile ke root karena gcloud builds submit default membaca ./Dockerfile
    cp deployment/Dockerfile.api Dockerfile
    gcloud builds submit --tag "gcr.io/$PROJECT_ID/ai-engine" .
    rm Dockerfile
    
    gcloud run deploy ai-engine \
        --image "gcr.io/$PROJECT_ID/ai-engine" \
        --platform managed \
        --region $REGION \
        --allow-unauthenticated \
        --port 8001
    echo "AI Engine berhasil di-deploy!"
fi

if [ "$pilihan" == "3" ] || [ "$pilihan" == "4" ]; then
    echo -e "\n[3/3] Deploy Web App..."
    
    CONNECTION_NAME=$(gcloud sql instances describe hackathon-db-v2 --format="value(connectionName)")
    AI_URL=$(gcloud run services describe ai-engine --platform managed --region $REGION --format="value(status.url)")
    
    cp deployment/Dockerfile.web Dockerfile
    gcloud builds submit --tag "gcr.io/$PROJECT_ID/web-app" .
    rm Dockerfile
    
    gcloud run deploy web-app \
        --image "gcr.io/$PROJECT_ID/web-app" \
        --platform managed \
        --region $REGION \
        --allow-unauthenticated \
        --port 8000 \
        --add-cloudsql-instances=$CONNECTION_NAME \
        --set-env-vars="DB_CONNECTION=mysql,DB_SOCKET=/cloudsql/$CONNECTION_NAME,DB_DATABASE=backend_core,DB_USERNAME=root,DB_PASSWORD=$DB_PASSWORD,AI_API_URL=$AI_URL,APP_ENV=production,APP_DEBUG=true,APP_KEY=base64:rahasia="
    echo "Web App berhasil di-deploy!"
fi

echo -e "\nSelesai! Anda bisa melihat layanan Anda di Google Cloud Console."
