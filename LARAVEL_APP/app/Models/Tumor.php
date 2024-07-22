<?php

namespace App\Models;

use App\Traits\SaveFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tumor extends Model
{
    use HasFactory, SaveFiles;

    protected $fillable = ['title', 'description', 'picture'];
}