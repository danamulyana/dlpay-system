<?php

namespace App\Http\Livewire\Attendance;

use App\Models\leaveAndAbsence as ModelLeaveAndAbsence;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveAndAbsen extends Component
{
    use WithPagination;

    public $data;

    public $confirmingEditModal = false;

    protected $rules = [
        'data.remark' => 'required',
    ];

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = ModelLeaveAndAbsence::find($id);
        $this->data = $data->toArray();
    }

    public function edit()
    {
        $this->validate();

        $data = ModelLeaveAndAbsence::find($this->data['id']);
        $data->category = $this->data['category'];
        $data->remark = $this->data['remark'];
        $data->updatedBy = auth()->user()->username;

        $data->save();
        $this->flash('success','Keterangan Leave & Absence Berhasil di Ubah.');
        return redirect()->route('atd.absence');
    }

    public function render()
    {
        $absences = ModelLeaveAndAbsence::all();
        return view('livewire.attendance.leave-and-absen',[
            'absences' => $absences,
        ]);
    }
}
