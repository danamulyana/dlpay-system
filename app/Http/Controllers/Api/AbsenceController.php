<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\memployee;
use App\Models\workingTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AbsenceController extends BaseController
{
    protected $keyAbsence;
    protected $Base;
    public function __construct(BaseController $base)
    {
        $this->keyAbsence = env('TAZAKA_KEY_ABSENCE', 'RFIDCAM2021');
        $this->Base = $base;
    }

    public function getmode(Request $request)
    {
        Log::channel('Apilog')->info($request->key);
        if (isset($request->key) && isset($request->iddev)) {
            if ($this->keyAbsence == $request->key) {
                echo 'X*SCAN*X';
            }
            return $this->sendErrorAbsence("salah-secret-key");
        }
        return $this->sendErrorAbsence("salah-param");
    }

    public function absensi(Request $request)
    {
        if (isset($request->key) && isset($request->iddev) && isset($request->rfid)) {
            if ($this->keyAbsence == $request->key) {
                $cekRfid = memployee::where('rfid_number',$request->rfid)->first();
                if (is_null($cekRfid)) {
                    return $this->sendErrorAbsence('rfid tidak ditemukan');
                }

                $workingTime = workingTime::all();
                foreach ($workingTime as $key => $time) {
                    if ($time->jam_masuk >= Carbon::now()->format('H:i')) {
                        if ($cekRfid->attendance_type == '2') {
                            $history = HistoryDeviceLog::where('is_attendance',true)->orWhere('user_id',$cekRfid->id)->orderBy('created_at', 'desc')->first();
                            if ($history == null) {
                                $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                                return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                            }
                            if ($history->uid === $cek_device->uid) {
                                $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                                return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                            }
                        }
                    }
                }
            }
            return $this->sendErrorAbsence("salah-secret-key");
        }
        return $this->sendErrorAbsence("salah-param");
    }
    public function timestamp(){
		return time();
	}

    public function datetime()
    {
        Log::channel('Apilog')->info('datetime');
        return date("Y,m,d,H,i,s",time());
    }
}

// buat absen
                // if ($cek_device->is_attendance == 1) {
                //     $workingTime = workingTime::all();
                    
                //     foreach ($workingTime as $key => $time) {
                //         // jam masuk
                //         if ($time->jam_masuk >= Carbon::now()->format('H:i')) {
                //             if ($cekRfid->attendance_type == '2') {
                //                 $history = HistoryDeviceLog::where('is_attendance',true)->orWhere('user_id',$cekRfid->id)->orderBy('created_at', 'desc')->first();
                //                 if ($history == null) {
                //                     $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                //                     return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                //                 }
                //                 if ($history->uid === $cek_device->uid) {
                //                     $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                //                     return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                //                 }
                //             }
                //             $isdata = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->first();
                //             if (!$isdata) {
                //                 if ($time->jam_masuk > 10) {
                //                     return 'okeh';
                //                 }
                //                 $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                //                 $this->sendAttendance($cek_device->uid,$cekRfid->id,Carbon::now(),'-','','', 'Tazaka Room : ' . $cek_device->uid);
                //                 return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                //             }
                //             $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                //             return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                //         }
                //         // jam keluar
                //         if (Carbon::now()->format('H:i') >= $time->jam_keluar ) {
                //             $cek_user = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
                //             if (!is_null($cek_user)) {
                //                 $overtime = Carbon::createFromTimeString($time->jam_keluar)->diffInHours();
                //                 $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                //                 $this->updateAttendance($cek_user->id,$cek_device->uid,$cekRfid->id,$cek_user->jam_masuk,Carbon::now(),$overtime);
                //                 return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                //             }
                //         }
                //     }
                // }