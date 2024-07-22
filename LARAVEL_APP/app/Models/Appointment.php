<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{
    use HasFactory;
    protected $fillable = [ "doctor_id", "user_id", "clinic_id", "patient_name", "patient_gender", "patient_age", "patient_phone", "appointment_price", "appointment_type", "appointment_number", "appointment_date", "appointment_day", "appointment_time", "status", "message" ];

    
    protected $casts = [
        'time' => 'datetime:H:i'
    ];
    
    public function clinic(){
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function report(){
        return $this->hasOne(Report::class, 'appointment_id');
    }
}