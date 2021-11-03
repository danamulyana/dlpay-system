<?php

namespace App\Http\Livewire;

use App\Models\attendanceDevice;
use App\Models\collectAttendance;
use App\Models\doorlockDevices;
use App\Models\memployee;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $pekerja = memployee::all();
        $doorlock = doorlockDevices::all()->count();
        $attencanceDevice = attendanceDevice::all()->count();
        $totalDevice = $doorlock + $attencanceDevice;
        $log = collectAttendance::selectRaw('DISTINCT user_id')->whereDate('created_at', Carbon::today())->get();
        $absence = count($pekerja) - count($log);
        return view('livewire.dashboard',[
            'pekerja' => $pekerja,
            'totalDevice' => $totalDevice,
            'log'=>$log,
            'absence'=>$absence,
        ]);
    }
}
