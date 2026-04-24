from fastapi import UploadFile, HTTPException

ALLOWED_EXTENSIONS = {"jpg", "jpeg", "png"}

def validate_image(file: UploadFile):
    """
    Validates if the uploaded file is a valid image.
    """
    if not file.filename:
        raise HTTPException(status_code=400, detail="No file uploaded")
    
    extension = file.filename.split(".")[-1].lower()
    if extension not in ALLOWED_EXTENSIONS:
        raise HTTPException(status_code=400, detail=f"Invalid file type. Allowed types: {', '.join(ALLOWED_EXTENSIONS)}")
    
    return True
