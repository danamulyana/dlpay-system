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
    public $month = [];
    public $dataAttandanceChart = [];
    public $dataTodayChart = [];
    public $hadiranPer = 0;
    public $terlamabatPer = 0;
    public $tidakHadirPer = 0;
    public $lineH = [];
    public $lineT = [];
    public $lineTH = [];
    public $absence = 0;
    public $log = 0;

    public function mount()
    {
        $this->fetchDataRecapotulation();
        $this->fetchDataTodayAtd();
    }

    public function fetchDataRecapotulation()
    {
        $year = Carbon::now()->year;
        $data = collectAttendance::whereYear('created_at','=',$year)->orderBy('created_at','asc')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        $months = [];
        foreach ($data as $month => $value) {
            $months[] = $month;
        }
        $this->month = $months;
        
        $d = collectAttendance::whereYear('created_at','=',$year)->orderBy('created_at','asc')->get(['keterangan','created_at'])->groupBy('keterangan');

        $y = $d->map(function($data){
            return $data->groupBy(function($data){
                return Carbon::parse($data->created_at)->format('M');
            });
        });

        $h = empty($y['hadir']) ? collect([]) : $y['hadir'];
        $hCount = $h->map(function ($item, $key) {
            return collect($item)->count();
        });

        $t = empty($y['terlambat']) ? collect([]) : $y['terlambat'];
        $tCount = $t->map(function ($item, $key) {
            return collect($item)->count();
        });

        $th = empty($y['tidak masuk'])? collect([]) : $y['tidak masuk'];
        $thCount = $th->map(function ($item, $key) {
            return collect($item)->count();
        });

        $this->lineH = $hCount;
        $this->lineT = $tCount;
        $this->lineTH = $thCount;
        // dd($d,$hCount,$tCount,$thCount);
    }

    public function fetchDataTodayAtd()
    {
        
        $data = collectAttendance::whereDate('created_at','=',Carbon::now())->orderBy('created_at','asc')->get()->groupBy(function($data){
            return $data->keterangan;
        });
        $totalKaryawan = count(memployee::all());

        $keterangan = [];
        $keteranganCount = [];
        $keteranganMap = [];
        $kehadiranPersentase = 0;
        $terlambatPersentase = 0;
        $tidakhadirPersentase = 0;
        foreach ($data as $ket => $value) {
            $keterangan[] = $ket;
            $keteranganCount[] = count($value);
            $keteranganMap[] = $value;
        }

        $ke = collect($keteranganMap)->collapse()->groupBy('keterangan');
        $groupCount = $ke->map(function ($item, $key) {
            return collect($item)->count();
        });
        $kehadiranPersentase = empty($groupCount['hadir']) ? 0 : round($groupCount['hadir']/$totalKaryawan * 100,2);
        $terlambatPersentase = empty($groupCount['terlambat']) ? 0 : round($groupCount['terlambat']/$totalKaryawan * 100,2);
        $tidakhadirPersentase = empty($groupCount['tidak masuk']) ? 0 : round($groupCount['tidak masuk']/$totalKaryawan * 100,2);

        $this->hadiranPer = $kehadiranPersentase;
        $this->terlamabatPer = $terlambatPersentase;
        $this->tidakHadirPer = $tidakhadirPersentase;
        $this->log = empty($groupCount['hadir']) ? 0 : $groupCount['hadir'];
        $this->absence = empty($groupCount['tidak masuk']) ? 0 : $groupCount['tidak masuk'];

        $this->dataTodayChart = $keteranganCount != null ? [empty($groupCount['tidak masuk']) ? 0 : $groupCount['tidak masuk'],empty($groupCount['terlambat']) ? 0 : $groupCount['terlambat'],empty($groupCount['hadir']) ? 0 : $groupCount['hadir']] : [0,0,0,$totalKaryawan];
        // dd($kehadiranPersentase,$terlambatPersentase,$tidakhadirPersentase);
    }

    public function render()
    {
        $pekerja = memployee::all();
        $doorlock = doorlockDevices::all()->count();
        $attencanceDevice = attendanceDevice::all()->count();
        $totalDevice = $doorlock + $attencanceDevice;
        return view('livewire.dashboard',[
            'pekerja' => $pekerja,
            'totalDevice' => $totalDevice,
        ]);
    }
}
