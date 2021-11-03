<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workingTime extends Model
{
    use HasFactory;

    protected $table = 'working_times';

    protected $fillable = [
        'shift_name',
        'jam_masuk',
        'jam_keluar',
        'createdBy',
        'updatedBy',
    ];
}
