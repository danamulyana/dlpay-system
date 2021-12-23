<?php

namespace App\Console;

use App\Models\collectAttendance;
use App\Models\memployee;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $users = memployee::all();
            $absence = [];
            $adaAbsen = [];
            foreach ($users as $key => $value) {
                $cekAbsence = collectAttendance::whereDate('created_at','=',Carbon::today())->where('user_id',$value->id)->first();
                if ($cekAbsence === null) {
                    $absence[] = $value->id;
                }else{
                    $adaAbsen[] = $cekAbsence;
                }
            }
            foreach ($absence as $key => $value) {
                $data = new collectAttendance();
                $data->uid = 1;
                $data->user_id = $value;
                $data->jam_masuk = Carbon::now();
                $data->jam_keluar = Carbon::now();
                $data->keterangan_detail = 'Tidak Masuk';
                $data->keterangan = 'tidak masuk';
                $data->createdBy = 'System';
                $data->updatedBy = 'System';
                $data->save();
            }
        })->dailyAt('22:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
