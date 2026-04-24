import numpy as np
from PIL import Image
import io
from utils.preprocessing import preprocess_image

def test_preprocess_image():
    # Create a dummy image
    img = Image.new('RGB', (100, 100), color='red')
    img_byte_arr = io.BytesIO()
    img.save(img_byte_arr, format='JPEG')
    img_bytes = img_byte_arr.getvalue()
    
    # Process
    result = preprocess_image(img_bytes)
    
    # Check shape
    assert result.shape == (1, 224, 224, 3)
    
    # Check normalization
    assert np.max(result) <= 1.0
    assert np.min(result) >= 0.0
