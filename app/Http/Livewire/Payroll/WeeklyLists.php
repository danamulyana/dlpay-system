<?php

namespace App\Http\Livewire\Payroll;

use App\Models\payrollWeekly;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class WeeklyLists extends Component
{
    use WithPagination;

    public $weekly;
    
    public $confirmingEditModal = false;
    public $payrols, $user_name = ' ';

    protected $rules = [

    ];

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = payrollWeekly::find($id);
        $this->payrols = $data->toArray();
        $this->user_name = $data->karyawan->nama;
    }

    public function edit()
    {
        $this->validate();

        $this->flash('success','Departement Berhasil di Ubah.');
        return redirect()->route('master.departement');
    }

    public function mount($weekly){
        $this->weekly = $weekly;
    }
    public function render()
    {
        Carbon::parse($this->weekly);
        $datas = payrollWeekly::whereDate('created_at', $this->weekly)->paginate(10);
        return view('livewire.payroll.weekly-lists',[
            'datas' => $datas,
        ]);
    }
}
