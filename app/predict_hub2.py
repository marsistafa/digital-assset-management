# predict_hub.py

# import tensorflow as tf
# import tensorflow_hub as hub
# import numpy as np

# def load_model():
#     model_url = "https://tfhub.dev/google/tf2-preview/inception_v3/classification/4"  # Example URL
#     model = tf.keras.Sequential([hub.KerasLayer(model_url,output_shape=[1001])])
#     return model

# def preprocess_image(image_path):
#     img = tf.keras.preprocessing.image.load_img(image_path, target_size=(299, 299))
#     img_array = tf.keras.preprocessing.image.img_to_array(img)
#     img_array = tf.expand_dims(img_array, 0)
#     img_array = tf.keras.applications.inception_v3.preprocess_input(img_array)  # Adjust to match the model's preprocessing
#     return img_array

# def predict_image(model, img_array):
#     predictions = model.predict(img_array)
#     return predictions

# if __name__ == "__main__":
#     model = load_model()
#     image_path = "C:/Users/Marsiona Stafa/Desktop/laravel testins/laravel-app-digital-asset-management/example-app/storage/app/public/FOLDER 1/0n8xZksrMH.jpg"
#     img_array = preprocess_image(image_path)
#     predictions = predict_image(model, img_array)
#     print(predictions)
