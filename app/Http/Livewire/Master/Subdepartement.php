<?php

namespace App\Http\Livewire\Master;

use App\Models\mdepartement;
use App\Models\msubdepartement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Subdepartement extends Component
{
    public $confirmingAddModal = false;
    public $confirmingEditModal = false;
    public $confirmingDeleteModal = false;

    public $departement, $nama, $sub_id;

    public $id_del, $password;

    protected $rules = [
        'nama' => 'required',
        'departement' => 'required',
    ];

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->nama = '';
        $this->departement = '';

        $this->confirmingAddModal = true;
    }
    public function showmodalEdit($id)
    {
        $this->resetErrorBag();

        $data = msubdepartement::find($id);
        $this->sub_id = $data->id;
        $this->nama = $data->nama;
        $this->departement = $data->departement_id;

        $this->confirmingEditModal = true;
    }
    public function showmodalDelete($id)
    {
        $this->resetErrorBag();

        $this->password = '';
        $this->id_del = $id;

        $this->dispatchBrowserEvent('confirming-modal-delete');

        $this->confirmingDeleteModal = true;
    }

    public function add()
    {
        $this->validate();


        $data = new msubdepartement();
        $data->nama = $this->nama;
        $data->departement_id = $this->departement;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','SubDepartement Berhasil di Tambahkan.');
        return redirect()->route('master.subdepartement');
    }

    public function edit()
    {
        $this->validate();

        $data = msubdepartement::find($this->sub_id);
        $data->nama = $this->nama;
        $data->departement_id = $this->departement;
        $data->updatedBy = auth()->user()->username;
        $data->save();

        $this->flash('success','SubDepartement Berhasil di Edit.');
        return redirect()->route('master.subdepartement');
    }

    public function delete()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $data = msubdepartement::find($this->id_del);
        $data->delete();

        $this->flash('success','SubDepartement Berhasil di Hapus.');
        return redirect()->route('master.subdepartement');
    }

    public function render()
    {
        $dept_data = mdepartement::all();
        $datas = msubdepartement::paginate(10);
        return view('livewire.master.subdepartement',[
            'dept_data' => $dept_data,
            'datas' => $datas,
        ]);
    }
}
