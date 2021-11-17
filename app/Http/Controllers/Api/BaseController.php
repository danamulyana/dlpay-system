<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\collectAttendance;
use App\Models\HistoryDeviceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function sendMessage($status, $ketetangan, $nama, $departement, $lock, $namaroom, $code = 200)
    {
        $response = [
            'status' => $status, 
            'ket' => $ketetangan,
            'nama' => $nama, 
            'department' => $departement, 
            'lock' => $lock, 
            'nama_room' => $namaroom
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
        HistoryDeviceLog::create([
            'uid' => $id_room,
            'user_id' => $id_karyawan,
            'keterangan' => $keterangan,
            'remark_log' => $remarks_log,
            'is_attendance' => $absence,
            'createdBy' => 'Tazaka Room : ' . $id_room,
            'updatedBy' => 'Tazaka Room : ' . $id_room,
        ]);
    }
    public function sendAttendance($uid, $user_id, $jamMasuk, $jamKeluar, $keterangan, $record, $cb)
    {
        collectAttendance::create([
            'uid' => $uid,
            'user_id' => $user_id,
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'keterangan' => $keterangan,
            'keterangan_detail' => $record,
            'createdBy' => $cb,
            'updatedBy' => 'Tazaka Room : ' . $uid,
        ]);
    }
    public function updateAttendance($id ,$uid, $user_id, $jamMasuk, $jamKeluar,$keterangan, $record)
    {
        $data = collectAttendance::find($id);
        $data->uid = $uid;
        $data->user_id = $user_id;
        $data->jam_masuk = $jamMasuk;
        $data->jam_keluar = $jamKeluar;
        $data->keterangan = $keterangan;
        $data->keterangan_detail = $record;
        $data->updatedBy = 'Tazaka Room : ' . $uid;

        $data->save();
    }

    // absence
    public function sendErrorAbsence($errorMessage)
    {
        $response = "x*".$errorMessage."*x";

        return $response;
    }
}
