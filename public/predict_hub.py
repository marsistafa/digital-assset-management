# predict_hub.py

import sys
from PIL import Image
import urllib
import torch
import timm 

def load_model():
    # Load EfficientNet model using timm
    model = timm.create_model('tf_efficientnet_b0', pretrained=True)
    model.eval()
    return model

def preprocess_image(image_path):
    # Load and preprocess the image using timm's data configuration and transforms
    img = Image.open(image_path).convert('RGB')
    
    # Get data config and transform
    config = timm.data.resolve_data_config({}, model=model)
    transform = timm.data.transforms_factory.create_transform(**config)

    tensor = transform(img).unsqueeze(0)
    return tensor

def predict_image(model, img_tensor):
    # Get model predictions
    with torch.no_grad():
        out = model(img_tensor)
    probabilities = torch.nn.functional.softmax(out[0], dim=0)
    return probabilities

if __name__ == "__main__":
    # Check if the correct number of command-line arguments is provided
    if len(sys.argv) != 2:
        print("Usage: python predict_hub.py <image_path>")
        sys.exit(1)

    model = load_model()
    
    # Get the image path from the command-line argument
    image_path = sys.argv[1]
    img_tensor = preprocess_image(image_path)
    predictions = predict_image(model, img_tensor)

    # Print top-5 predictions class names (you can modify this part based on your needs)
    url, filename = ("https://raw.githubusercontent.com/pytorch/hub/master/imagenet_classes.txt", "imagenet_classes.txt")
    urllib.request.urlretrieve(url, filename) 
    with open("imagenet_classes.txt", "r") as f:
        categories = [s.strip() for s in f.readlines()]

    # Get top 5 predictions
    top_prob, top_catid = torch.topk(predictions, 5)
    
    # Print top categories per image
    for i in range(top_prob.size(0)):
        print(categories[top_catid[i]], top_prob[i].item())
