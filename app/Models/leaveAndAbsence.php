<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveAndAbsence extends Model
{
    use HasFactory;

    protected $table = 'leave_and_absences';

    protected $fillable = [
        'category',
        'remark',
        'persentation',
        'createdBy',
        'updatedBy',
    ];
}
