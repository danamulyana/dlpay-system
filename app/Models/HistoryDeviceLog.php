<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryDeviceLog extends Model
{
    use HasFactory;

    protected $table = 'history_device_logs';

    protected $fillable = [
        'uid',
        'user_id',
        'keterangan',
        'remark_log',
        'is_attendance',
        'createdBy',
    ];

    public function karyawan() : BelongsTo
    {
        return $this->belongsTo(memployee::class,'user_id');
    }

    public function device($device)
    {
        $cek_device = doorlockDevices::where('uid',$device)->first();
        if (is_null($cek_device)) {
            $cek_device = attendanceDevice::where('uid',$device)->first();
        }
        return $cek_device->name;
    }
}
