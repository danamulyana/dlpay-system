<?php

namespace App\Http\Livewire\Device;

use App\Models\attendanceDevice;
use App\Models\dataLocation;
use App\Models\mdepartement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class Attendance extends Component
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
    public $location, $name, $uid, $departement;

    // edit
    public $data;

    protected $rules = [
        'uid' => 'required|unique:App\Models\attendanceDevice,uid|unique:App\Models\doorlockDevices,uid',
        'name' => 'required',
        'location' => 'required',
        'departement' => 'required',
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

        $data = attendanceDevice::find($this->id_del);
        $data->delete();

        $this->flash('success','Device Attendance Berhasil Di Hapus.');
        return redirect()->route('device.attendance');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();

        $data = new attendanceDevice();
        $data->uid = $this->uid;
        $data->name = $this->name;
        $data->location_id = $this->location;
        $data->departement_id = $this->departement;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','Device Attendance Berhasil Di Tambahkan.');

        return redirect()->route('device.attendance');
    }

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = attendanceDevice::find($id);
        $this->data = $data->toArray();
    }

    public function edit()
    {
        $this->validate([
            'data.name' => 'required'
        ]);

        $data = attendanceDevice::find($this->data['id']);
        $data->uid = $this->data['uid'];
        $data->name = $this->data['name'];
        $data->location_id = $this->data['location_id'];
        $data->departement_id = $this->data['departement_id'];
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','Device Attendance Berhasil di Ubah.');
        return redirect()->route('device.attendance');
    }

    public function render()
    {
        $device = attendanceDevice::query()->where('name', 'like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        $locations = dataLocation::all();
        $departements = mdepartement::all();
        return view('livewire.device.attendance',[
            'device' => $device,
            'locations' => $locations,
            'departements' => $departements,
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
