<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\attendanceDevice;
use App\Models\collectAttendance;
use App\Models\HistoryDeviceLog;
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
                $cek_device = attendanceDevice::where('uid',$request->iddev)->first();
                if (is_null($cek_device)) {
                    return $this->sendErrorAbsence('Device tidak terdaftar');
                }
                return 'x*'.$cek_device->mode.'*x';
            }
            return $this->sendErrorAbsence("salah-secret-key");
        }
        return $this->sendErrorAbsence("salah-param");
    }

    public function addcardrfidcam(Request $request)
    {
        if (isset($request->key) && isset($request->iddev) && isset($request->rfid)) {
            if ($this->keyAbsence == $request->key) {
                $cek_device = attendanceDevice::where('uid',$request->iddev)->first();
                $cekRfid = memployee::where('rfid_number',$request->rfid)->first();
                if (is_null($cek_device)) {
                    return $this->sendErrorAbsence('Device tidak terdaftar');
                }
                if (is_null($cekRfid)) {
                    $kar =  $this->addKaryawanByRfid($request->rfid);
                    $this->SendHistory($kar->id,'Menambahkan Rfid',$cek_device->uid,true);
                    return $this->sendErrorAbsence('Berhasil Menambahkan Rfid');
                }
                return $this->sendErrorAbsence('rfid sudah terdaftar');
            }
            return $this->sendErrorAbsence("salah-secret-key");
        }
        return $this->sendErrorAbsence("salah-param");
    }

    public function absensi(Request $request)
    {
        if (isset($request->key) && isset($request->iddev) && isset($request->rfid)) {
            if ($this->keyAbsence == $request->key) {

                $cek_device = attendanceDevice::where('uid',$request->iddev)->first();
                if (is_null($cek_device)) {
                    return $this->sendErrorAbsence('Device tidak terdaftar');
                }

                $cekRfid = memployee::where('rfid_number',$request->rfid)->first();
                if (is_null($cekRfid)) {
                    return $this->sendErrorAbsence('rfid tidak ditemukan');
                }

                $foto = $request->file("foto");
                $statFoto = '';
                $workingTime = $cekRfid->shiftcode;

                $jamKeluar = carbon::parse($workingTime->jam_keluar);

                // Jam Masuk
                if (Carbon::now() >= carbon::parse($workingTime->jam_masuk)->addHours(-1)  && Carbon::now() <= carbon::parse($workingTime->jam_masuk)->addHours(4)) 
                {
                    // Foto Absen
                    if (isset($foto)) {
                        $imgname = $cekRfid->nama . '_masuk_' . date("dmY_H-i-s_", time()).uniqid(rand(0,5)).'.'. $foto->getClientOriginalExtension();
                        if(in_array($foto->getClientOriginalExtension(), array("jpg", "jpeg", "gif", "png"))){
                            $tujuan_upload = 'files/Absensi/' . Carbon::now()->format('Y').'/'.Carbon::now()->format('m');
                            $foto->move($tujuan_upload,$imgname);
                            $statFoto = "capture foto sukses";
                        }else{
                            $statFoto = "capture foto gagal";
                        }
                    }
                    $namafoto = $tujuan_upload .'/' . $imgname;
                    // END : Foto Absen
                    // Absen kalo 2 kali tap
                    if ($cekRfid->attendance_type == '2') {
                        $history = HistoryDeviceLog::where('is_attendance',true)->orWhere('user_id',$cekRfid->id)->orderBy('created_at', 'desc')->first();
                        if ($history == null) {
                            $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                            return $this->sendMessageAbsence('Absen berhasil',$cekRfid->nama,$statFoto,now());
                        }
                        if ($history->uid != $cek_device->uid) {
                            $timedeff1Hour = carbon::parse($workingTime->jam_masuk)->addHours(2);
                            if (Carbon::now() > $timedeff1Hour) {
                                $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                                $this->sendAttendance($cek_device->uid,$cekRfid->id,'-','terlambat','telat masuk lebih dari 1 jam','Tazaka Room : ' . $cek_device->uid,$namafoto);
                                $this->notifyDB('System ATD','Karyawan NIP: '.$cekRfid->nip.' Terlambat Hadir');
                                return $this->sendMessageAbsence('terlambat',$cekRfid->nama,$statFoto,Carbon::now()->format('H-i-s'));
                            }
                            $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                            $this->sendAttendance($cek_device->uid,$cekRfid->id,'-','hadir','masuk tepat waktu','Tazaka Room : ' . $cek_device->uid,$namafoto);
                            return $this->sendMessageAbsence('hadir',$cekRfid->nama,$statFoto,Carbon::now()->format('H-i-s'));
                        }
                    }
                    // END: Absen Kalo 2 kali tap
                    $isdata = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->first();
                    if (!$isdata) {
                        $timedeff1Hour = carbon::parse($workingTime->jam_masuk)->addHours(2);
                        if (Carbon::now() > $timedeff1Hour) {
                            $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                            $this->sendAttendance($cek_device->uid,$cekRfid->id,'-','terlambat','telat masuk lebih dari 1 jam','Tazaka Room : ' . $cek_device->uid,$namafoto);
                            $this->notifyDB('System ATD','Karyawan NIP: '.$cekRfid->nip.' Terlambat Hadir');
                            return $this->sendMessageAbsence('terlambat',$cekRfid->nama,$statFoto,Carbon::now()->format('H-i-s'));
                        }
                        $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                        $this->sendAttendance($cek_device->uid,$cekRfid->id,'-','hadir','masuk tepat waktu','Tazaka Room : ' . $cek_device->uid,$namafoto);
                        return $this->sendMessageAbsence('hadir',$cekRfid->nama,$statFoto,Carbon::now()->format('H-i-s'));
                    }
                    $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                    return $this->sendErrorAbsence('sudah absen*'.$cekRfid->nama);
                }
                // END : Jam Masuk
                // Jam Keluar
                if (Carbon::now() >= $jamKeluar )
                {
                    $cek_user = collectAttendance::where('user_id', $cekRfid->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
                    if (!is_null($cek_user)) {
                        if (isset($foto)) {
                            $imgname = $cekRfid->nama . '_pulang_' . date("dmY_H-i-s_", time()).uniqid(rand(0,5)).'.'. $foto->getClientOriginalExtension();
                            if(in_array($foto->getClientOriginalExtension(), array("jpg", "jpeg", "gif", "png"))){
                                $tujuan_upload = 'files/Absensi/' . Carbon::now()->format('Y').'/'.Carbon::now()->format('m');
                                $foto->move($tujuan_upload,$imgname);
                                $statFoto = "capture foto sukses";
                            }else{
                                $statFoto = "capture foto gagal";
                            }
                        }
                        $namafoto = $tujuan_upload .'/' . $imgname;
                        $this->SendHistory($cekRfid->id,'attendance recorded',$cek_device->uid,true);
                        $this->updateAttendance($cek_user->id,$cek_device->uid,$namafoto);
                        return $this->sendMessageAbsence('success',$cekRfid->nama,$statFoto,Carbon::now()->format('H-i-s'));
                    }
                    return $this->sendErrorAbsence("absen masuk tidak di temukan");
                    $this->SendHistory($cekRfid->id,'attendance not recorded',$cek_device->uid,true);
                }
                // END : Jam Keluar
                return $this->sendErrorAbsence("error waktu operasional");
                $this->SendHistory($cekRfid->id,'error waktu operasional',$cek_device->uid,true);
            }
            return $this->sendErrorAbsence("salah secret key");
        }
        return $this->sendErrorAbsence("salah param");
    }
    public function timestamp(){
		return time();
	}

    public function datetime()
    {
        return date("Y,m,d,H,i,s",time());
    }
}