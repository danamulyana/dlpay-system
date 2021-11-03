<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class attendanceDevice extends Model
{
    use HasFactory;

    protected $table = 'attendance_devices';

    protected $fillable = [
        'uid',
        'name',
        'createdBy',
        'updatedBy',
    ];

    public function Location() : BelongsTo
    {
        return $this->belongsTo(dataLocation::class,'location_id');
    }
    public function Departement() : BelongsTo
    {
        return $this->belongsTo(mdepartement::class, 'departement_id');
    }
}
