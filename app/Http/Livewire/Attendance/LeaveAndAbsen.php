<?php

namespace App\Http\Livewire\Attendance;

use App\Models\leaveAndAbsence as ModelLeaveAndAbsence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveAndAbsen extends Component
{
    use WithPagination;

    public $data;
    public $state;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingEditModal = false;
    public $confirmingAddModal = false;
    public $confirmingDeleteModal = false;

    public $id_del, $password;

    protected $rules = [
        'state.category' => 'required',
        'state.remark' => 'required',
    ];

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();

        $data = new ModelLeaveAndAbsence();
        $data->category = $this->state['category'];
        $data->remark = $this->state['remark'];
        $data->value_1A = curremcyIDRToNumeric($this->state['1A']);
        $data->value_1B = curremcyIDRToNumeric($this->state['1B']);
        $data->value_1C = curremcyIDRToNumeric($this->state['1C']);
        $data->value_1D = curremcyIDRToNumeric($this->state['1D']);
        $data->value_1E = curremcyIDRToNumeric($this->state['1E']);
        $data->value_1F = curremcyIDRToNumeric($this->state['1F']);
        $data->value_2A = curremcyIDRToNumeric($this->state['2A']);
        $data->value_2B = curremcyIDRToNumeric($this->state['2B']);
        $data->value_2C = curremcyIDRToNumeric($this->state['2C']);
        $data->value_2D = curremcyIDRToNumeric($this->state['2D']);
        $data->value_2E = curremcyIDRToNumeric($this->state['2E']);
        $data->value_2F = curremcyIDRToNumeric($this->state['2F']);
        $data->value_3A = curremcyIDRToNumeric($this->state['3A']);
        $data->value_3B = curremcyIDRToNumeric($this->state['3B']);
        $data->value_3C = curremcyIDRToNumeric($this->state['3C']);
        $data->value_3D = curremcyIDRToNumeric($this->state['3D']);
        $data->value_3E = curremcyIDRToNumeric($this->state['3E']);
        $data->value_3F = curremcyIDRToNumeric($this->state['3F']);
        $data->value_4A = curremcyIDRToNumeric($this->state['4A']);
        $data->value_4B = curremcyIDRToNumeric($this->state['4B']);
        $data->value_4C = curremcyIDRToNumeric($this->state['4C']);
        $data->value_4D = curremcyIDRToNumeric($this->state['4D']);
        $data->value_4E = curremcyIDRToNumeric($this->state['4E']);
        $data->value_4F = curremcyIDRToNumeric($this->state['4F']);
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();
        
        $this->flash('success',' Leave & Absence Berhasil di tambahkan.');
        return redirect()->route('atd.absence');

    }

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = ModelLeaveAndAbsence::find($id);
        $this->data = $data->toArray();
    }

    public function edit()
    {
        $this->validate([
            'data.category' => 'required',
            'data.remark' => 'required',
            'data.value_1A' => 'required',
            'data.value_1B' => 'required',
            'data.value_1C' => 'required',
            'data.value_1D' => 'required',
            'data.value_1E' => 'required',
            'data.value_1F' => 'required',
            'data.value_2A' => 'required',
            'data.value_2B' => 'required',
            'data.value_2C' => 'required',
            'data.value_2D' => 'required',
            'data.value_2E' => 'required',
            'data.value_2F' => 'required',
            'data.value_3A' => 'required',
            'data.value_3B' => 'required',
            'data.value_3C' => 'required',
            'data.value_3D' => 'required',
            'data.value_3E' => 'required',
            'data.value_3F' => 'required',
            'data.value_4A' => 'required',
            'data.value_4B' => 'required',
            'data.value_4C' => 'required',
            'data.value_4D' => 'required',
            'data.value_4E' => 'required',
            'data.value_4F' => 'required',
        ]);

        $data = ModelLeaveAndAbsence::find($this->data['id']);
        $data->category = $this->data['category'];
        $data->remark = $this->data['remark'];
        $data->value_1A = curremcyIDRToNumeric($this->data['value_1A']);
        $data->value_1B = curremcyIDRToNumeric($this->data['value_1B']);
        $data->value_1C = curremcyIDRToNumeric($this->data['value_1C']);
        $data->value_1D = curremcyIDRToNumeric($this->data['value_1D']);
        $data->value_1E = curremcyIDRToNumeric($this->data['value_1E']);
        $data->value_1F = curremcyIDRToNumeric($this->data['value_1F']);
        $data->value_2A = curremcyIDRToNumeric($this->data['value_2A']);
        $data->value_2B = curremcyIDRToNumeric($this->data['value_2B']);
        $data->value_2C = curremcyIDRToNumeric($this->data['value_2C']);
        $data->value_2D = curremcyIDRToNumeric($this->data['value_2D']);
        $data->value_2E = curremcyIDRToNumeric($this->data['value_2E']);
        $data->value_2F = curremcyIDRToNumeric($this->data['value_2F']);
        $data->value_3A = curremcyIDRToNumeric($this->data['value_3A']);
        $data->value_3B = curremcyIDRToNumeric($this->data['value_3B']);
        $data->value_3C = curremcyIDRToNumeric($this->data['value_3C']);
        $data->value_3D = curremcyIDRToNumeric($this->data['value_3D']);
        $data->value_3E = curremcyIDRToNumeric($this->data['value_3E']);
        $data->value_3F = curremcyIDRToNumeric($this->data['value_3F']);
        $data->value_4A = curremcyIDRToNumeric($this->data['value_4A']);
        $data->value_4B = curremcyIDRToNumeric($this->data['value_4B']);
        $data->value_4C = curremcyIDRToNumeric($this->data['value_4C']);
        $data->value_4D = curremcyIDRToNumeric($this->data['value_4D']);
        $data->value_4E = curremcyIDRToNumeric($this->data['value_4E']);
        $data->value_4F = curremcyIDRToNumeric($this->data['value_4F']);
        $data->updatedBy = auth()->user()->username;

        $data->save();
        $this->flash('success',' Leave & Absence Berhasil di Ubah.');
        return redirect()->route('atd.absence');
    }

    public function showmodalDelete($id)
    {
        $this->resetErrorBag();

        $this->password = '';
        $this->id_del = $id;

        $this->dispatchBrowserEvent('confirming-modal-delete');

        $this->confirmingDeleteModal = true;
    }

    public function delete()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $data = ModelLeaveAndAbsence::find($this->id_del);
        $data->delete();

        $this->flash('success','Leave & Absence Berhasil di Hapus.');
        return redirect()->route('atd.absence');
    }

    public function render()
    {
        $absences = ModelLeaveAndAbsence::query()->where('category', 'like', '%'.$this->searchTerms.'%')
        ->orWhere('remark', 'like', '%'.$this->searchTerms.'%')->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.attendance.leave-and-absen',[
            'absences' => $absences,
        ]);
    }
    
    public function updatedSearchTerms()
    {
        $this->resetPage();
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        }else{
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }
}
