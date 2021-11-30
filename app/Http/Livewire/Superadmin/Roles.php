<?php

namespace App\Http\Livewire\Superadmin;

use App\Models\collectAttendance;
use App\Models\memployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Roles extends Component
{
    public function testing($user_id)
    {
        collectAttendance::create([
            'uid' => 1,
            'user_id' => $user_id,
            'jam_masuk' => Carbon::now(),
            'jam_masuk_photo_path' => 'files/Absensi/default/tidakmasuk.png',
            'jam_Keluar' => Carbon::now(),
            'jam_Keluar_photo_path' => 'files/Absensi/default/tidakmasuk.png',
            'keterangan' => 'tidak masuk',
            'keterangan_detail' => 'otomatis oleh sistem di angap tidak masuk',
            'createdBy' => 'System Tazaka',
            'updatedBy' => 'System Tazaka',
        ]);
    }
    public function absenceDialy()
    {
        $users = memployee::all();
        foreach ($users as $key => $value) {
            $cekAbsence = collectAttendance::where('user_id',$value->id)->orWhere('created_at',Carbon::now())->first();
            if (!$cekAbsence) {
                $this->testing($value->id);
            }
        }
    }
    public function render()
    {
        $this->absenceDialy();
        return view('livewire.superadmin.roles');
    }
}
