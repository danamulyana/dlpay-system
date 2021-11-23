<?php

namespace App\Http\Livewire\Payroll;

use App\Models\leaveAndAbsence;
use App\Models\payrollWeekly;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class WeeklyLists extends Component
{
    use WithPagination;

    public $weekly;
    
    public $confirmingEditModal = false;
    public $payrols, $user_name = ' ', $deductionsEdit = [];

    protected $rules = [

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

        $this->flash('success','Data Payroll Berhasil di Ubah.');
        return redirect()->route('');
    }

    public function mount($weekly){
        $this->weekly = $weekly;
    }
    public function render()
    {
        Carbon::parse($this->weekly);
        $datas = payrollWeekly::whereDate('created_at', $this->weekly)->paginate(10);
        $deductions = leaveAndAbsence::where('category','payroll deductions')->get();
        // dd($deductions);
        return view('livewire.payroll.weekly-lists',[
            'datas' => $datas,
            'deductions' => $deductions,
        ]);
    }
}
