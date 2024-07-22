# ---------------------------------------
# Import Libraries ----------------------
# ---------------------------------------
import os
import cv2
import math
import shutil
import pickle
import base64
import numpy as np
from waitress import serve
from ultralytics import YOLO
from datetime import datetime
from werkzeug.utils import secure_filename
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
from flask import Flask, request, send_file, jsonify


# ---------------------------------------
# Define a Flask app --------------------
# ---------------------------------------
app = Flask(__name__)
UPLOAD_FOLDER = "uploads"
output_dir = os.getcwd()


# ---------------------------------------
# Load The Models -----------------------
# ---------------------------------------
detection_model = YOLO("best.pt")
classification_model = load_model('brain_tumor_classifier.h5')

print("---------------------------------------------------")
print("The Server Is Ready ✔️ ---------------------------")
print("---------------------------------------------------")


# ---------------------------------------------
# The Detection Model Route -------------------
# ---------------------------------------------
@app.route('/detect', methods=['POST'])
def detect():
    if request.method == 'POST':
        try:
            if 'file' not in request.files:
                return jsonify({'error': 'No file part'}), 400

            file = request.files['file']
            if file.filename == '':
                return jsonify({'error': 'No selected file'}), 400

            if file:
                cv_image = cv2.imdecode(np.frombuffer(file.read(), np.uint8), cv2.IMREAD_COLOR)

                # =======================================================
                # MAKE DETECTION
                # =======================================================
                results = detection_model(cv_image, save=True)
                path = results[0].save_dir
                output_path = os.path.join(output_dir, path)
                output_image = os.path.join("static", output_path, "image0.JPG")

                # Process the results
                detections = []
                for result in results:
                    if result.boxes:
                        for box in result.boxes:
                            ClassInd = int(box.cls)
                            detections.append(detection_model.names[ClassInd])

                detection_result = 0
                if len(detections) > 0: 
                    detection_result = 1


                # =======================================================
                # MAKE CLASSIFICATION
                # =======================================================
                classification_result = 'no_tumor'
                if(detection_result == 1):
                    input_size = (150, 150)
                    resized_image = cv2.resize(cv_image, input_size)
                    normalized_image = resized_image / 255.0
                    input_image = np.expand_dims(normalized_image, axis=0)

                    preds = classification_model.predict(input_image)
                    pred_index = np.argmax(preds,axis = 1)[0]
                    class_labels = ['glioma_tumor', 'meningioma_tumor', 'no_tumor', 'pituitary_tumor']
                    classification_result = class_labels[pred_index]


                # =======================================================
                # SEND THE RESULT
                # =======================================================
                response = send_file(output_image, conditional=True)
                response.headers['detection_result'] = detection_result
                response.headers['classification_result'] = classification_result
                return response

                print(detection_result)
                print("Response Sent Successfully\n")

        except Exception as e:
            return jsonify({'error': str(e)})
    return "Post Method Required"



# --------------------------------------------
# Run The App --------------------------------
# --------------------------------------------
if __name__ == '__main__':
    serve(app, host='0.0.0.0', port=5000, threads=100)