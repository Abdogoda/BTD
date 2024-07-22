<?php

namespace App\Models;

use App\Traits\SaveFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDocuments extends Model
{
    use HasFactory, SaveFiles;

    public $fillable = ['doctor_id', 'path', 'type'];
}