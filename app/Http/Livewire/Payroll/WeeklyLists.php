<?php

namespace App\Http\Livewire\Payroll;

use App\Models\collectAttendance;
use App\Models\leaveAndAbsence;
use App\Models\memployee;
use App\Models\payrollWeekly;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class WeeklyLists extends Component
{
    use WithPagination;

    public $weekly;
    
    public $confirmingEditModal = false;
    public $payrols, $user_name = ' ', $deductionsEdit = [], $salaryincrisEdit = [];

    protected $rules = [
        'payrols.overtime' => 'required'
    ];

    public function approvall($id)
    {
        $data = payrollWeekly::find($id);
        $data->Approve = true;
        $data->save();
    }

    public function showmodalEdit($id)
    {
        $this->emit('select2modal');
        $this->confirmingEditModal = true;
        $data = payrollWeekly::find($id);
        $this->payrols = $data->toArray();
        $this->user_name = $data->karyawan->nama;
    }

    public function edit()
    {
        $this->validate();

        $attandence = collectAttendance::where('user_id', $this->payrols['user_id'])->whereDate('created_at', '>=', Carbon::now()->subDays(5))->count();
        $karyawan = memployee::find($this->payrols['user_id']);
        $karyawangolongan = $karyawan->Golongan->nama;

        $overtimeKamus = $karyawan->basic_salary / env('TAZAKA_OVERTIME',173);
        $totalOvertime = $overtimeKamus * $this->payrols['overtime'];
        $salary_payment = $karyawan->basic_salary / 4;
        $basic_payment = $salary_payment / 5 * $attandence;

        $deductionTotal = 0;
        $incrissTotal = 0;
        foreach ($this->deductionsEdit as $key => $value) {
            $deductions = leaveAndAbsence::find($value)->toArray();
            $deductionTotal += $deductions['value_'.$karyawangolongan];
        }
        foreach ($this->salaryincrisEdit as $key => $value) {
            $salaryincris = leaveAndAbsence::find($value)->toArray();
            $incrissTotal += $salaryincris['value_'.$karyawangolongan];
        }

        $data = payrollWeekly::find($this->payrols['id']);
        $data->overtime = $totalOvertime;
        $data->basic_payment = $basic_payment;
        $data->salary_deductions = $deductionTotal;
        $data->salary_increase = $incrissTotal;
        $data->total_payment = $basic_payment + $totalOvertime + $incrissTotal - $deductionTotal;

        $data->save();

        $this->flash('success','Data Payroll Berhasil di Ubah.');
        return redirect()->route('payroll.weekly.list',[$this->weekly]);
    }

    public function mount($weekly){
        $this->weekly = $weekly;
    }
    public function render()
    {
        Carbon::parse($this->weekly);
        $datas = payrollWeekly::whereDate('created_at', $this->weekly)->paginate(10);
        $deductions = leaveAndAbsence::where('category','payroll deductions')->get();
        $salaryincris = leaveAndAbsence::where('category','salary increase')->get();
        // dd($deductions);
        return view('livewire.payroll.weekly-lists',[
            'datas' => $datas,
            'deductions' => $deductions,
            'salaryincris' => $salaryincris,
        ]);
    }
}
