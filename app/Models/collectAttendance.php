<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class collectAttendance extends Model
{
    use HasFactory;

    protected $table = 'collect_attendances';

    protected $fillable = [
        'uid',
        'user_id',
        'jam_masuk',
        'jam_Keluar',
        'overtime',
        'keterangan_detail',
        'keterangan',
        'createdBy',
        'updatedBy',
    ];
    public function karyawan() : BelongsTo
    {
        return $this->belongsTo(memployee::class,'user_id');
    }
}
