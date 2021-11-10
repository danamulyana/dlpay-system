<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attendanceDevice;
use App\Models\collectAttendance;
use App\Models\doorlockDevices;
use App\Models\HistoryDeviceLog;
use App\Models\memployee;
use App\Models\workingTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class device extends BaseController
{

    protected $key;
    protected $Base;
    public function __construct(BaseController $base)
    {
        $this->key = env('TAZAKA_KEY');
        $this->Base = $base;
    }

    public function index()
    {
        return "REST API for Device";
    }
    public function registerdev(Request $request)
    {
        if (isset($request->key) && isset($request->rfid) && isset($request->token)) {
            $key = $request->key;

            if ($this->key == $key) {
                $rfid = $request->rfid;

                $cekRfid = memployee::where('rfid_number',$rfid)->first();

                if ($cekRfid) {
                    return $this->sendError('RFID sudah terdaftar',200);
                } else {
                }
            }else{
                return $this->sendError('salah secret key',401);
            }
        }else{
            return $this->sendError('salah parameter',401);
        }
    }
    public function getroom(Request $request)
    {
        if (isset($request->key) && isset($request->iddev)) {
            if ($this->key == $request->key) {
                
                $cek_device = attendanceDevice::where('uid',$request->iddev)->first();
                if (is_null($cek_device)) {
                    $cek_device = doorlockDevices::where('uid',$request->iddev)->first();
                }
                
                if (!is_null($cek_device)) {
                    Log::channel('Apilog')->info('Room : ' . $cek_device->name . ' Berhasil Masuk, Success : Device Terdaftar');
                    return $this->sendRoom('Device terdaftar',$cek_device->name,$cek_device->departement->nama,$cek_device->type);
                }
                Log::channel('Apilog')->info('Room : ' . $request->iddev . ' Mencoba Masuk Tapi Gagal, Error : Device Tidak Terdaftar');
                return $this->sendError('Device tidak ada');
            } else {
                Log::channel('Apilog')->info('Room : ' . $request->iddev . ' Mencoba Masuk Tapi Gagal, Error : Secret Key Salah');
                return $this->sendError('salah secret key');
            }
        }else{
            Log::channel('Apilog')->info('Room : ' . $request->iddev . ' Mencoba Masuk Tapi Gagal, Error : salah parameter');
            return $this->sendError('salah parameter');
        }
    }

    public function access_room(Request $request)
    {
        if (isset($request->key) && isset($request->rfid) && isset($request->iddev)) {
            if ($this->key == $request->key) {
                
                $cek_device = doorlockDevices::where('uid',$request->iddev)->first();
                if (is_null($cek_device)) {
                    $cek_device = attendanceDevice::where('uid',$request->iddev)->first();
                    
                    if (is_null($cek_device)) {
                        return $this->sendError('Device tidak terdaftar');
                    }
                }
                
                $cekRfid = memployee::where('rfid_number',$request->rfid)->first();
                if (is_null($cekRfid)) {
                    return $this->sendError('RFID tidak terdaftar');
                }

                // buat absen
                if ($cek_device->is_attendance == 1) {
                    $workingTime = workingTime::all();
                    
                    foreach ($workingTime as $key => $time) {
                        // jam masuk
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
                            $isdata = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->first();
                            if (!$isdata) {
                                if ($time->jam_masuk > 10) {
                                    return 'okeh';
                                }
                                $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                                $this->sendAttendance($cek_device->uid,$cekRfid->id,Carbon::now(),'-','','', 'Tazaka Room : ' . $cek_device->uid);
                                return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                            }
                            $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                            return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                        }
                        // jam keluar
                        if (Carbon::now()->format('H:i') >= $time->jam_keluar ) {
                            $cek_user = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
                            if (!is_null($cek_user)) {
                                $overtime = Carbon::createFromTimeString($time->jam_keluar)->diffInHours();
                                $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                                $this->updateAttendance($cek_user->id,$cek_device->uid,$cekRfid->id,$cek_user->jam_masuk,Carbon::now(),$overtime);
                                return $this->sendMessage('success','attendance recorded',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                            }
                        }
                    }
                }

                if ($cek_device->type == 'restricted') {
                    if ($cek_device->departement_id === $cekRfid->departement_id) {
                        if ($cek_device->access_Privelage == 1) {
                            $cekPrivelage = $cek_device->Privelage()->get();
                            foreach ($cekPrivelage as  $value) {
                                if ($value->rfid_number == $request->rfid) {
                                    $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                                    return $this->sendMessage('success','Access Granted',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                                }
                            }
                            return $this->sendMessage('failed','User No Access',$cekRfid->nama,$cekRfid->departement->nama,'close',$cek_device->name);
                        }else{
                            $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                            return $this->sendMessage('success','Access Granted',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                        }
                    }
                    return $this->sendMessage('failed','No Access',$cekRfid->nama,$cekRfid->departement->nama,'close',$cek_device->name);
                }

                // Jika Ada Privelage
                if ($cek_device->access_Privelage == 1) {
                    $cekPrivelage = $cek_device->Privelage()->get();

                    foreach ($cekPrivelage as  $value) {
                        if ($value->rfid_number == $request->rfid) {
                            $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                            return $this->sendMessage('success','Access Granted',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                        }
                    }
                    return $this->sendMessage('failed','No Access',$cekRfid->nama,$cekRfid->departement->nama,'close',$cek_device->name);
                }

                // with Remark
                if ($cek_device->access_mode == 1) {
                    if ($cek_device->access_Privelage == 1) {
                        $cekPrivelage = $cek_device->Privelage()->get();
                        foreach ($cekPrivelage as  $value) {
                            if ($value->rfid_number == $request->rfid) {

                                $timeRemark = 3600;



                                $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                                return $this->sendMessage('success','Access Granted',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                            }
                        }
                        return $this->sendMessage('failed','User No Access',$cekRfid->nama,$cekRfid->departement->nama,'close',$cek_device->name);
                    }else{
                        $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                        return $this->sendMessage('success','Access Granted',$cekRfid->nama,$cekRfid->departement->nama,'open',$cek_device->name);
                    }
                }
                // Semua Pegawai / Public
                return $this->sendError($cek_device);
                // $cekAccessRoom = 

            }else{
                return $this->sendError('salah secret key');
            }
        }else{
            return $this->sendError('salah parameter');
        }
    }
}
