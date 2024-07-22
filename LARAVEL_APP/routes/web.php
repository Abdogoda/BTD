<?php

use App\Http\Controllers\Backend\AdminController as BackendAdminController;
use App\Http\Controllers\Backend\DoctorController as BackendDoctorController;
use App\Http\Controllers\Backend\HospitalController as BackendHospitalController;
use App\Http\Controllers\Backend\ClinicController as BackendClinicController;
use App\Http\Controllers\Backend\MessageController as BackendMessageController;
use App\Http\Controllers\Backend\SettingController as BackendSettingController;
use App\Http\Controllers\Backend\TreatmentController as BackendTreatmentController;
use App\Http\Controllers\Backend\TumorController as BackendTumorController;
use App\Http\Controllers\NotificationController as BackendNotificationController;
use App\Http\Controllers\Backend\ScheduleController as BackendScheduleController;
use App\Http\Controllers\Frontend\DoctorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\HospitalController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Backend\AppointmentController as BackendAppointmentController;
use App\Http\Controllers\Backend\DetectionController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\DoctorReviewController;
use App\Http\Controllers\Frontend\PaypalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ----------- UNUATH ROUTES -----------
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals');
Route::get('/hospitals/{hospital}', [HospitalController::class, 'show'])->name('hospitals.show');
Route::post('/message', [HomeController::class, 'store_message'])->name('store_message');


// ----------- PAYMENT ROUTES -----------
Route::get('payment', [PaypalController::class, 'payment'])->name('payment');
Route::get('payment/cancel', [PaypalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PaypalController::class, 'success'])->name('payment.success');

// ----------- AUTH ROUTES -----------
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Appointment
    Route::get('/make-appointment', [AppointmentController::class, 'create'])->name('user.appointment');
    Route::post('/make-appointment', [AppointmentController::class, 'store'])->name('user.appointment_store');
    
    // Doctor Review
    Route::post('/make-review', [DoctorReviewController::class, 'store'])->name('review_store');
});

// ----------- USER ROUTES -----------
Route::middleware(['auth', 'role:user'])->group(function () {
    
    // Profile
    Route::get('/user/profile', [HomeController::class, 'profile'])->name('user.profile');
    
    
    // ----------- USER CONFIRMED ROUTES -----------
    Route::middleware(['password.confirm', 'verified'])->group(function(){
    });
});


// ----------- ADMIN ROUTES -----------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [BackendAdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Settings
    Route::get('/settings', [BackendSettingController::class, 'index'])->name('admin.settings');
    
    // Notifications
    Route::get('/notifications', [BackendNotificationController::class, 'admin_notifications'])->name('admin.notifications');
    
    // Message
    Route::get('/messages', [BackendMessageController::class, 'index'])->name('admin.messages');
    
    // Hospitals
    Route::get('/hospitals', [BackendHospitalController::class, 'index'])->name('admin.hospitals');
    Route::get('/hospitals/{hospital}', [BackendHospitalController::class, 'show'])->name('admin.hospital');
    Route::get('/hospitals-create', [BackendHospitalController::class, 'create'])->name('admin.hospital_create');
    
    // Doctors
    Route::get('/doctors', [BackendDoctorController::class, 'index'])->name('admin.doctors');
    Route::get('/doctors/{doctor}', [BackendDoctorController::class, 'show'])->name('admin.doctor');
    
    // Admins
    Route::get('/admins', [BackendAdminController::class, 'index'])->name('admin.admins');
    Route::get('/admins/{admin}', [BackendAdminController::class, 'show'])->name('admin.admin');
    Route::get('/admins-create', [BackendAdminController::class, 'create'])->name('admin.admin_create');
    
    // Treatments
    Route::get('/treatments', [BackendTreatmentController::class, 'index'])->name('admin.treatments');
    Route::get('/treatments/{treatment}', [BackendTreatmentController::class, 'show'])->name('admin.treatment');
    Route::get('/treatments-create', [BackendTreatmentController::class, 'create'])->name('admin.treatment_create');
    
    // Tumors
    Route::get('/tumors', [BackendTumorController::class, 'index'])->name('admin.tumors');
    Route::get('/tumors/{tumor}', [BackendTumorController::class, 'show'])->name('admin.tumor');
    Route::get('/tumors-create', [BackendTumorController::class, 'create'])->name('admin.tumor_create');
    
    // ----------- ADMIN CONFIRMED ROUTES -----------
    Route::middleware(['password.confirm'])->group(function(){
        
        // Settings
        Route::put('/settings/{setting}', [BackendSettingController::class, 'update'])->name('admin.setting_update');
        
        // Notifications
        Route::get('/notifications/read_all', [BackendNotificationController::class, 'read_all_admin'])->name('admin.notifications_read');
        Route::get('/notifications/read/{notification}', [BackendNotificationController::class, 'read'])->name('notification_read');
        Route::get('/notifications/delete/{notification}', [BackendNotificationController::class, 'delete'])->name('notification_delete');
        
        // Messages
        Route::get('/messages/read_all', [BackendMessageController::class, 'read_all'])->name('admin.messages_read');
        Route::get('/messages/read/{message}', [BackendMessageController::class, 'read'])->name('admin.message_read');
        Route::get('/messages/delete/{message}', [BackendMessageController::class, 'delete'])->name('admin.message_delete');
        
        // Hospitals
        Route::post('/hospitals/new', [BackendHospitalController::class, 'store'])->name('admin.hospital_store');
        Route::post('/hospitals/{hospital}', [BackendHospitalController::class, 'update'])->name('admin.hospital_update');
        Route::get('/hospitals/delete/{hospital}', [BackendHospitalController::class, 'destroy'])->name('admin.hospital_delete');
        
        // Doctors
        Route::get('/doctors/change_status/{doctor}', [BackendDoctorController::class, 'change_status'])->name('admin.doctor_change_status');
        
        // Admins
        Route::get('/profile', [BackendAdminController::class, 'profile'])->name('admin.profile');
        Route::post('/admins/new', [BackendAdminController::class, 'store'])->name('admin.admin_store');
        
        // Treatments
        Route::post('/treatments/new', [BackendTreatmentController::class, 'store'])->name('admin.treatment_store');
        Route::post('/treatments/{treatment}', [BackendTreatmentController::class, 'update'])->name('admin.treatment_update');
        Route::get('/treatments/delete/{treatment}', [BackendTreatmentController::class, 'destroy'])->name('admin.treatment_delete');
        
        // Tumors
        Route::post('/tumors/new', [BackendTumorController::class, 'store'])->name('admin.tumor_store');
        Route::post('/tumors/{tumor}', [BackendTumorController::class, 'update'])->name('admin.tumor_update');
        Route::get('/tumors/delete/{tumor}', [BackendTumorController::class, 'destroy'])->name('admin.tumor_delete');
    });
});

// ----------- DOCTOR ROUTES -----------
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [BackendDoctorController::class, 'dashboard'])->name('doctor.dashboard');
    
    // Notifications
    Route::get('/notifications', [BackendNotificationController::class, 'doctor_notifications'])->name('doctor.notifications');
    
    // Porfile
    Route::get('/profile', [BackendDoctorController::class, 'profile'])->name('doctor.profile');
    Route::patch('/profile', [BackendDoctorController::class, 'update_profile'])->name('doctor.profile_update');
    Route::post('/profile/document', [BackendDoctorController::class, 'document_store'])->name('doctor.document_store');
    Route::get('/profile/documents/{id}', [BackendDoctorController::class, 'document_delete'])->name('doctor.document_delete');
    
    // Clinics
    Route::get('/clinics', [BackendClinicController::class, 'index'])->name('doctor.clinics');
    Route::get('/clinics/{clinic}', [BackendClinicController::class, 'show'])->name('doctor.clinic');
    Route::get('/clinics-create', [BackendClinicController::class, 'create'])->name('doctor.clinic_create');
    
    // Appointments
    Route::get('/appointments', [BackendAppointmentController::class, 'index'])->name('doctor.appointments');
    Route::get('/appointments/{appointment}', [BackendAppointmentController::class, 'show'])->name('doctor.appointment');
    
    // Detections
    Route::get('/detections', [DetectionController::class, 'index'])->name('doctor.detections');
    Route::get('/detections/new', [DetectionController::class, 'create'])->name('doctor.detections.create');
    Route::post('/detections/new', [DetectionController::class, 'store'])->name('doctor.detections.store');
    
    // ----------- DOCTOR CONFIRMED ROUTES -----------
    Route::middleware(['password.confirm'])->group(function(){
        
        // Notifications
        Route::get('/notifications/read_all', [BackendNotificationController::class, 'read_all_doctor'])->name('doctor.notifications_read');
        Route::get('/notifications/read/{notification}', [BackendNotificationController::class, 'read'])->name('notification_read');
        Route::get('/notifications/delete/{notification}', [BackendNotificationController::class, 'delete'])->name('notification_delete');
        
        // Clinics
        Route::post('/clinics/new', [BackendClinicController::class, 'store'])->name('doctor.clinic_store');
        Route::post('/clinics/{clinic}', [BackendClinicController::class, 'update'])->name('doctor.clinic_update');
        Route::get('/clinics/delete/{clinic}', [BackendClinicController::class, 'destroy'])->name('doctor.clinic_delete');
        
        // Clinics Schedule
        Route::post('/schedules', [BackendScheduleController::class, 'store'])->name('doctor.clinic_schedule_store');
        Route::post('/schedules/{clinicSchedule}', [BackendScheduleController::class, 'update'])->name('doctor.clinic_schedule_update');
        
        // Appointments
        Route::post('/appointments/{appointment}/update_status', [BackendAppointmentController::class, 'update_status'])->name('doctor.appointment_update_staus');
        Route::post('/appointments/{appointment}/add_report', [BackendAppointmentController::class, 'add_report'])->name('doctor.appointment_add_report');
        Route::get('/appointments/delete/{appointment}', [BackendAppointmentController::class, 'destroy'])->name('doctor.appointment_delete');
        
    });

});



require __DIR__.'/auth.php';