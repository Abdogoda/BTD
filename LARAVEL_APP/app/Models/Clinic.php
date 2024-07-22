<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model{

    use HasFactory;
    public $fillable = ['name', 'doctor_id', 'address', 'location', 'visiting_price', 'follow_up_price', 'phone'];

    public function clinic_schedule(){
        return $this->hasMany(ClinicSchedule::class, 'clinic_id');
    }
}