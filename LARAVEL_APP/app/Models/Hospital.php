<?php

namespace App\Models;

use App\Traits\SaveFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model{
    use HasFactory, SaveFiles;
    protected $fillable = [
        'name',
        'address',
        'location',
        'email',
        'phone',
        'description',
        'picture',
    ];

    public function doctors(){
        return $this->hasMany(Doctor::class, 'hospital_id');
    }
}