<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model{

    use HasFactory;

    protected $fillable = [ 'doctor_id', 'input_image', 'output_image', 'detection_result', 'classification_result'];

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}