<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mpriset extends Model
{
    use HasFactory;

    protected $table = 'mprisets';

    protected $fillable = [
        'name',
        'createdBy',
        'updatedBy',
    ];
}
