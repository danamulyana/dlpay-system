<?php

namespace App\Http\Livewire\Device;

use App\Models\dataLocation;
use App\Models\doorlockDevices;
use App\Models\mdepartement;
use App\Models\memployee;
use App\Models\mpriset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class Doorlock extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingEditModal = false;
    public $confirmingDeleteModal = false;

    public $datakaryawan;
    //delete
    public $id_del, $password;

    // add
    public $uid, $type, $location, $name,$departement, $withPrivilage, $accesstype, $remarkData, $access_mode = false, $privelage = [];

    // edit
    public $data, $remarkDataEdit;

    protected $rules = [
        'uid' => 'required|unique:App\Models\attendanceDevice,uid|unique:App\Models\doorlockDevices,uid',
        'name' => 'required',
        'location' => 'required',
        'departement' => 'required',
        'accesstype' => 'required',
        'type' => 'required',
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

        $data = doorlockDevices::find($this->id_del);
        $data->delete();
        $data->remarks()->detach();

        $this->flash('success','DoorLock Device Berhasil di Hapus.');
        return redirect()->route('device.doorlock');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();

        $data = new doorlockDevices();
        $data->uid = $this->uid;
        $data->name = $this->name;
        $data->location_id = $this->location;
        $data->departement_id = $this->departement;
        $data->access_type = $this->accesstype;
        $data->access_mode = $this->access_mode;
        $data->type = $this->type;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $data->remarks()->sync($this->remarkData);

        $this->flash('success','DoorLock Device Berhasil di Tambahkan.');
        return redirect()->route('device.doorlock');
    }
    public function showmodalEdit($id)
    {
        $this->emit('select2modal');
        $this->confirmingEditModal = true;
        $data = doorlockDevices::find($id);
        $remark = [];
        foreach ($data->remarks as $value) {
            $remark[] = $value->pivot->priset_id;
        }
        $this->remarkDataEdit = $remark;
        $this->data = $data->toArray();
        $this->dataAccess_mode = $data->access_mode;

    }

    public function edit()
    {
        $this->validate([
            'data.name' => 'required'
        ]);

        $data = doorlockDevices::find($this->data['id']);
        $data->uid = $this->data['uid'];
        $data->name = $this->data['name'];
        $data->location_id = $this->data['location_id'];
        $data->departement_id = $this->data['departement_id'];
        $data->access_type = $this->data['access_type'];
        $data->access_mode = $this->data['access_mode'];
        $data->type = $this->data['type'];
        $data->departement_id = $this->data['departement_id'];
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $data->remarks()->sync($this->remarkDataEdit);

        $this->flash('success','DoorLock Device Berhasil di Ubah.');
        return redirect()->route('device.doorlock');
    }

    public function render()
    {
        $doorlock = doorlockDevices::query()->where('name', 'like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        $locations = dataLocation::all();
        $employes = memployee::all(['id','nama'])->toArray();
        $remarks = mpriset::all();
        $departements = mdepartement::all();
        $this->datakaryawan = $employes;
        // dd($employes);
        return view('livewire.device.doorlock',[
            'doorlock' => $doorlock,
            'locations' => $locations,
            'employes' => $employes,
            'remarks' => $remarks,
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
