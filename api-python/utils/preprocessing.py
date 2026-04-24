import numpy as np
from PIL import Image
import io

def preprocess_image(contents: bytes, target_size=(224, 224)) -> np.ndarray:
    """
    Preprocess image for MobileNetV2.
    Resizes image and normalizes pixel values to [0, 1].
    """
    image = Image.open(io.BytesIO(contents)).convert("RGB")
    image = image.resize(target_size)
    
    img_array = np.array(image) / 255.0
    img_array = np.expand_dims(img_array, axis=0)
    
    return img_array
