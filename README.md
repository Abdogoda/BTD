### Brain Tumor Detection (BTD)

### Project Overview
**Brain Tumor Detection (BTD)** is a comprehensive web application designed to assist in the detection and management of brain tumors. It leverages the Laravel framework for the backend, MySQL for the database, and a combination of HTML, CSS, JavaScript, Bootstrap, and jQuery for the frontend. The AI server is powered by Python Flask and OpenCV, which facilitates the detection of brain tumors from medical imaging data.

### Technology Stack
- **Backend:** Laravel Framework, MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap, jQuery
- **AI Server:** Python Flask, OpenCV
- **Version Control:** Git, GitHub

### Database Structure
The project includes the following tables:

- **users**
- **hospitals**
- **specializations**
- **clinics**
- **clinic_schedules**
- **doctors**
- **doctor_documents**
- **doctor_reviews**
- **doctor_experiences**
- **messages**
- **tumors**
- **treatments**
- **appointments**
- **reports**
- **detections**
- **settings**

### Features

1. **Multiauthentication:**
   - User, Admin, and Doctor login and registration.

2. **Admin Controls:**
   - Manage tables for tumors, treatments, hospitals, doctors, and settings.

3. **Doctor Dashboard:**
   - Manage profile, user appointments, and AI detections.

4. **User Interaction:**
   - Access hospitals and doctors, make appointments.

5. **Doctor Clinics:**
   - Each doctor can have multiple clinics with schedules and capacities.

6. **Account Activation:**
   - Admin must activate doctor accounts for them to log in and manage their profile.

### Usage
#### Admin
- Login to the admin panel.
- Manage hospitals, doctors, tumors, and treatments.
- Activate doctor accounts.

#### Doctor
- Login to the doctor dashboard.
- Update profile information.
- Manage user appointments.
- Access AI detections for brain tumors.

#### User
- Register and login.
- Search for hospitals and doctors.
- Book appointments with doctors in available clinics.

### Contribution
Contributions are welcome! Please fork the repository and submit a pull request with your changes.

### License
This project is licensed under the MIT License. See the [LICENSE](https://github.com/Abdogoda/BTD/blob/main/LICENSE) file for details.
