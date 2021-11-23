<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\HistoryResource;
use App\Models\attendanceDevice;
use App\Models\doorlockDevices;
use App\Models\HistoryDeviceLog;
use App\Models\memployee;
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
        $response = [
            "success" => true,
            "message" => "Welcome To Api Doorlock PT Cahaya Sukses Plastindo",
            "data" => [],
        ];

        return response()->json($response);
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
                    return $this->sendError('Device tidak terdaftar');
                }
                
                $cekRfid = memployee::where('rfid_number',$request->rfid)->first();
                if (is_null($cekRfid)) {
                    return $this->sendError('RFID tidak terdaftar');
                }

                $lock  = $cek_device->access_mode == 1 ? 'close' : 'open';
                
                if ($cek_device->type == 'restricted') {
                    if ($cek_device->departement_id === $cekRfid->departement_id) {
                        $cekPrivelage = $cekRfid->Doorlock()->get(['uid']);
                        foreach ($cekPrivelage as  $value) {
                            if ($value->uid == $cek_device->uid) {
                                $history = $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                                $withremark = $this->withremarks($cek_device->remarks,$history);
                                $withLinks = $this->withLinksCounter($history,$cekRfid->user_DoorTime);
                                return $this->sendMessage('success','Access Granted',$cekRfid->departement->nama,$lock,$cek_device, $cekRfid,$withremark,$withLinks);
                            }
                        }
                        return $this->sendMessage('failed','No Access',$cekRfid->departement->nama,'close',$cek_device, $cekRfid);
                    }
                }

                // Cek Privelage
                $cekPrivelage = $cekRfid->Doorlock()->get(['uid']);

                foreach ($cekPrivelage as  $value) {
                    if ($value->uid == $cek_device->uid) {
                        $history = $this->SendHistory($cekRfid->id,'Access Granted',$cek_device->uid);
                        $withremark = $this->withremarks($cek_device->remarks,$history);
                        $withLinks = $this->withLinksCounter($history,$cekRfid->user_DoorTime);
                        return $this->sendMessage('success','Access Granted',$cekRfid->departement->nama,$lock,$cek_device, $cekRfid,$withremark,$withLinks);
                    }
                }
                return $this->sendMessage('failed','No Access',$cekRfid->departement->nama,'close',$cek_device, $cekRfid);

            }else{
                return $this->sendError('salah secret key');
            }
        }else{
            return $this->sendError('salah parameter');
        }
    }

    public function remarks(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            return $this->sendError('Link Expired',401);
        }

        $history = HistoryDeviceLog::find($id);

        if (!$history) {
            return $this->sendError('Data Not Found');
        }

        if (isset($request->key) && isset($request->remark) && isset($request->iddev)) {
            if ($this->key == $request->key) {
                $cekRemark = doorlockDevices::find($history->uid);
                $user = memployee::find($history->user_id);
                if ($request->iddev == $history->uid) {
                    foreach ($cekRemark->remarks as $value) {
                        if ($request->remark == $value->id) {
                            $this->editHistory($id,$value->name);
                            return $this->sendResponseRemark('success','Access Granted',$user->departement->nama,'open',$cekRemark,$user);
                        }
                    }
                    return $this->sendResponseRemark('failed','No Access',$user->departement->nama,'close',$cekRemark, $user);
                }
            }
            return $this->sendError('salah secret key');
        }
        return $this->sendError('salah parameter');
    }
    public function counter(Request $request, $id)
    {
        // if (! $request->hasValidSignature()) {
        //     return $this->sendError('Link Expired',401);
        // }

        $history = HistoryDeviceLog::find($id);

        if (!$history) {
            return $this->sendError('Data Not Found');
        }
        if (isset($request->key) && isset($request->count) && isset($request->iddev)) {
            if ($this->key == $request->key) {
                $door = doorlockDevices::find($history->uid);
                $user = memployee::find($history->user_id);
                if ($request->iddev == $history->uid) {
                    $data = $this->editHistoryCount($id,$request->count);

                    return response()->json(new HistoryResource($data));
                }
            }
            return $this->sendError('salah secret key');
        }
        return $this->sendError('salah parameter');
    }
}