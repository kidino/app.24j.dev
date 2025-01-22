<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_reg',
        'type',
        'maker',
        'model',
        'colour',
        'fuel',
        'state'
    ];

    protected $casts = [
        'date_reg' => 'date',
    ];
}