<?php

namespace App\Http\Livewire\Device;

use App\Models\doorlockDevices;
use App\Models\memployee;
use App\Models\Schadule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class DoorlockManagement extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingEditModal = false;
    public $confirmingDeleteModal = false;

    public $name, $tanggalawal, $tanggalakhir, $deviceData, $karyawanData, $dataEdit, $doorlockDataEdit,$karyawanDataEdit;
    //delete
    public $id_del, $password;

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
            'tanggalawal' => 'required',
            'tanggalakhir' => 'required',
            'deviceData' => 'required',
            'karyawanData' => 'required'
        ],[],[
            'name' => 'Schadule',
            'tanggalawal' => 'Tanggal Awal',
            'tanggalakhir' => 'Tanggal Akhir',
        ]);

        $data = new Schadule();
        $data->nama = $this->name;
        $data->tanggal_awal = $this->tanggalawal;
        $data->tanggal_akhir = $this->tanggalakhir;
        $data->save();

        $data->doorlock()->sync($this->deviceData);
        $data->karyawan()->sync($this->karyawanData);

        $this->flash('success','Schadule Berhasil di Tambahkan.');
        return redirect()->route('device.management');
    }

    public function showmodalEdit($id)
    {
        $this->emit('select2modal');
        $this->confirmingEditModal = true;
        $data = Schadule::find($id);
        $doorlock = [];
        $karyawan = [];
        foreach ($data->doorlock as $value) {
            $doorlock[] = $value->pivot->doorlock_id;
        }
        foreach ($data->karyawan as $value) {
            $karyawan[] = $value->pivot->memployes_id;
        }
        $this->doorlockDataEdit = $doorlock;
        $this->karyawanDataEdit = $karyawan;
        $this->dataEdit = $data->toArray();
    }

    public function edit(){
        $this->validate([
            'dataEdit.nama' => 'required',
            'dataEdit.tanggal_awal' => 'required',
            'dataEdit.tanggal_akhir' => 'required',
            'doorlockDataEdit' => 'required',
            'karyawanDataEdit' => 'required'
        ],[],[
            'dataEdit.nama' => 'Schadule',
            'dataEdit.tanggal_awal' => 'Tanggal Awal',
            'dataEdit.tanggal_akhir' => 'Tanggal Akhir',
        ]);

        $data = Schadule::find($this->dataEdit['id']);
        $data->nama = $this->dataEdit['nama'];
        $data->tanggal_awal = $this->dataEdit['tanggal_awal'];
        $data->tanggal_akhir = $this->dataEdit['tanggal_akhir'];
        $data->save();

        $data->doorlock()->sync($this->doorlockDataEdit);
        $data->karyawan()->sync($this->karyawanDataEdit);

        $this->flash('success','Schadule Berhasil di Ubah.');
        return redirect()->route('device.management');
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

        $data = Schadule::find($this->id_del);
        $data->delete();
        $data->doorlock()->detach();
        $data->karyawan()->detach();

        $this->flash('success','Schadule Berhasil di Hapus.');
        return redirect()->route('device.management');
    }

    public function render()
    {
        return view('livewire.device.doorlock-management',[
            'data' => Schadule::query()->where('nama', 'like', '%'.$this->searchTerms.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage),
            'devices' => doorlockDevices::all(),
            'karyawan' => memployee::all(),
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
