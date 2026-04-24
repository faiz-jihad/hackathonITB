import json
import os

def load_labels(filepath: str) -> list:
    if not os.path.exists(filepath):
        raise FileNotFoundError(f"Label file not found: {filepath}")
    
    with open(filepath, 'r') as f:
        labels_dict = json.load(f)
    
    # Sort by key to ensure correct order
    labels = [labels_dict[str(i)] for i in range(len(labels_dict))]
    return labels
