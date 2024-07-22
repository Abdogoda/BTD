<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'specialization_id', 'years_of_experience', 'hospital_id', 'status', 'about'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');    
    }

    public function specialization(){
        return $this->belongsTo(Specialization::class, 'specialization_id');    
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id');    
    }

    public function educations(){
        return $this->hasMany(DoctorEducation::class, 'doctor_id')->where('type', 'education');    
    }

    public function experiences(){
        return $this->hasMany(DoctorEducation::class, 'doctor_id')->where('type', 'experience');    
    }

    public function clinics(){
        return $this->hasMany(Clinic::class, 'doctor_id');    
    }

    public function schedule(){
        return $this->hasMany(ClinicSchedule::class, 'doctor_id');
    }

    public function documents(){
        return $this->hasMany(DoctorDocuments::class, 'doctor_id');
    }

    public function reviews(){
        return $this->hasMany(DoctorReview::class, 'doctor_id');
    }
}