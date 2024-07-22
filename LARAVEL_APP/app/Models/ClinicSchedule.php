<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicSchedule extends Model{

    use HasFactory;

    public $fillable = ['clinic_id', 'doctor_id', 'day', 'capacity', 'start_time', 'end_time'];
    protected $casts = [
        'start_time' => 'datetime:H:i', // Assuming your time is stored as 'H:i:s'
        'end_time' => 'datetime:H:i',   // Assuming your time is stored as 'H:i:s'
    ];

    public function clinic(){
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}