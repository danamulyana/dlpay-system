<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\collectAttendance;
use App\Models\HistoryDeviceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class BaseController extends Controller
{
    public function sendError($error, $code = 200)
    {
        $response = [
            'status' => 'failed',
            'ket' => $error,
        ];

        return response()->json($response, $code);
    }
    public function withremarks($remarks,$link)
    {
        $response = [
            "data" => $remarks->makeHidden(['createdBy','updatedBy','created_at','updated_at','pivot']),
            "links" => [
                "self" => URL::temporarySignedRoute('withremarks', now()->addMinutes(5),['id' => $link->id]),
            ],
        ];
        return $response;
    }
    public function withLinksCounter($link,$expired = 5)
    {
        $response = [
            "self" => URL::temporarySignedRoute('withcounter', now()->addMinutes($expired),['id' => $link->id]),
        ];
        return $response;
    }

    public function sendMessage($status, $keterangan, $departement, $lock, $device, $user, $remarks = [], $links = [], $code = 200)
    {
        $response = [
            'status' => $status, 
            'ket' => $keterangan,
            'nama' => $user->nama, 
            'department' => $departement, 
            'lock' => $lock, 
            'nama_room' => $device->name,
            'remark' => $device->access_mode,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'nip' => $user->nip,
                    'rfid_number' => $user->rfid_number,
                    'fingerprint' => $user->fingerprint,
                    'doorTime' => $user->user_DoorTime,
                ],
                "remarks" => $remarks,
            ],
            "links" => $links,
        ];

        return response()->json($response, $code);
    }
    public function sendRoom($keterangan, $room_name, $departement, $type = 'public', $code = 200)
    {
        $response = [
            'status' => 'success', 
            'ket' => $keterangan, 
            'nama_room' => $room_name, 
            'department' => $departement, 
            'type' => $type
        ];
        return response()->json($response, $code);
    }

    public function SendHistory($id_karyawan, $keterangan, $id_room, $absence = false ,$remarks_log = '-')
    {
        $id_history = HistoryDeviceLog::create([
            'uid' => $id_room,
            'user_id' => $id_karyawan,
            'keterangan' => $keterangan,
            'remark_log' => $remarks_log,
            'is_attendance' => $absence,
            'createdBy' => 'Tazaka Room : ' . $id_room,
            'updatedBy' => 'Tazaka Room : ' . $id_room,
        ]);

        return $id_history;
    }

    public function editHistory($id_history,$remarks)
    {
        $data = HistoryDeviceLog::find($id_history);
        $data->remark_log = $remarks;
        $data->save();
    }
    public function editHistoryCount($id_history,$counter)
    {
        $data = HistoryDeviceLog::find($id_history);
        $data->count_access = $counter;
        $data->save();

        return $data;
    }

    public function sendResponseRemark($status, $keterangan, $departement, $lock, $device, $user,$code = 200)
    {
        $response = [
            'status' => $status, 
            'ket' => $keterangan,
            'nama' => $user->nama, 
            'department' => $departement, 
            'lock' => $lock, 
            'nama_room' => $device->name,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'nip' => $user->nip,
                    'rfid_number' => $user->rfid_number,
                    'fingerprint' => $user->fingerprint,
                    'doorTime' => $user->user_DoorTime,
                ],
            ],
        ];

        return response()->json($response,$code);
    }

    // absence
    public function sendErrorAbsence($errorMessage)
    {
        $response = "x*".$errorMessage."*x";

        return $response;
    }
    public function sendMessageAbsence($response,$nama,$statFoto, $wkt)
    {
        $response = "x*success*".$response."*".$nama."*".$wkt."*".$statFoto."*x";
        return $response;
    }

    public function sendAttendance($uid, $user_id, $jamKeluar, $keterangan, $record, $cb, $photojamMasuk)
    {
        collectAttendance::create([
            'uid' => $uid,
            'user_id' => $user_id,
            'jam_masuk' => Carbon::now(),
            'jam_masuk_photo_path' => $photojamMasuk,
            'jam_keluar' => $jamKeluar,
            'keterangan' => $keterangan,
            'keterangan_detail' => $record,
            'createdBy' => $cb,
            'updatedBy' => 'Tazaka Room : ' . $uid,
        ]);
    }
    public function updateAttendance($id ,$uid,$photojamKeluar)
    {
        $data = collectAttendance::find($id);
        $data->uid = $uid;
        $data->jam_keluar = Carbon::now();
        $data->jam_keluar_photo_path = $photojamKeluar;
        $data->updatedBy = 'Tazaka Room : ' . $uid;

        $data->save();
    }
}
