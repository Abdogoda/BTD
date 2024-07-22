<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorEducation extends Model{

    use HasFactory;

    public $fillable = ['doctor_id', 'name', 'description', 'start', 'end', 'type'];
}