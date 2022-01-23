<?php

namespace App\Http\Livewire\Attendance;

use App\Models\workingTime as ModelsWorkingTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class WorkingTime extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingEditModal = false;
    public $confirmingDeleteModal = false;

    //delete
    public $id_del, $password;

    // add
    public $jam_masuk, $nama, $jam_keluar;

    // edit
    public $data;

    protected $rules = [
        'nama' => 'required',
        'jam_masuk' => 'required|date_format:H:i',
        'jam_keluar' => 'required|date_format:H:i',
    ];

    protected $messages = [
        'jam_keluar.after' => 'Jam Keluar Harus Lebih dari jam masuk.',
        'data.jam_keluar.after' => 'Jam Keluar Harus Lebih dari jam masuk.',
    ];

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

        $data = ModelsWorkingTime::find($this->id_del);
        $data->delete();
        $this->flash('success','Jam Kerja Berhasil di dihapus.');

        return redirect()->route('atd.working');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = ModelsWorkingTime::find($id);
        $this->data = $data->toArray();
    }

    public function edit()
    {
        $this->validate([
            'data.shift_name' => 'required',
            'data.jam_masuk' => 'required|date_format:H:i',
            'data.jam_keluar' => 'required|date_format:H:i',
        ]);

        $data = ModelsWorkingTime::find($this->data['id']);
        $data->shift_name = $this->data['shift_name'];
        $data->jam_masuk = $this->data['jam_masuk'];
        $data->jam_keluar = $this->data['jam_keluar'];
        $data->updatedBy = auth()->user()->username;

        $data->save();
        $this->flash('success','Jam Kerja Berhasil di Ubah.');
        return redirect()->route('atd.working');
    }

    public function add()
    {
        $this->validate();

        $data = new ModelsWorkingTime();
        $data->shift_name = $this->nama;
        $data->jam_masuk = $this->jam_masuk;
        $data->jam_keluar = $this->jam_keluar;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();
        
        $this->flash('success','Jam Kerja Berhasil di tambahkan.');
        return redirect()->route('atd.working');

    }

    public function render()
    {
        $workingTimes = ModelsWorkingTime::query()->where('shift_name', 'like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.attendance.working-time',[
            'workingTimes' => $workingTimes,
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
