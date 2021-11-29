<?php

namespace App\Http\Livewire\Payroll;

use App\Models\collectAttendance;
use App\Models\leaveAndAbsence;
use App\Models\memployee;
use App\Models\payrollMonthly;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MonthLists extends Component
{
    use WithPagination;

    public $month;
    public $confirmingEditModal = false;
    public $payrols, $user_name = ' ', $deductionsEdit = [], $salaryincrisEdit = [];

    protected $rules = [
        'payrols.overtime' => 'required'
    ];

    public function approvall($id)
    {
        $data = payrollMonthly::find($id);
        $data->Approve = true;
        $data->save();
    }

    public function showmodalEdit($id)
    {
        $this->emit('select2modal');
        $this->confirmingEditModal = true;
        $data = payrollMonthly::find($id);
        $this->payrols = $data->toArray();
        $this->user_name = $data->karyawan->nama;
    }

    public function edit()
    {
        $this->validate();

        $attandence = collectAttendance::where('user_id', $this->payrols['user_id'])->whereDate('created_at', '>=', Carbon::now()->subDays(30))->count();
        $karyawan = memployee::find($this->payrols['user_id']);
        $karyawangolongan = $karyawan->Golongan->nama;

        $overtimeKamus = $karyawan->basic_salary / env('TAZAKA_OVERTIME',173);
        $totalOvertime = $overtimeKamus * $this->payrols['overtime'];
        $salary_payment = $karyawan->basic_salary;
        $basic_payment = $salary_payment / 24 * $attandence;

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

        $data = payrollMonthly::find($this->payrols['id']);
        $data->overtime = $totalOvertime;
        $data->basic_payment = $basic_payment;
        $data->salary_deductions = $deductionTotal;
        $data->salary_increase = $incrissTotal;
        $data->total_payment = $basic_payment + $totalOvertime + $incrissTotal - $deductionTotal;

        $data->save();

        $this->flash('success','Data Payroll Berhasil di Ubah.');
        return redirect()->route('payroll.monthly.list',[$this->month]);
    }

    public function mount($month){
        $this->month = $month;
    }
    public function render()
    {
        Carbon::parse($this->month);
        $datas = payrollMonthly::whereDate('created_at', $this->month)->paginate(10);
        $deductions = leaveAndAbsence::where('category','payroll deductions')->get();
        $salaryincris = leaveAndAbsence::where('category','salary increase')->get();
        return view('livewire.payroll.month-lists',[
            'datas' => $datas,
            'deductions' => $deductions,
            'salaryincris' => $salaryincris,
        ]);
    }
}
