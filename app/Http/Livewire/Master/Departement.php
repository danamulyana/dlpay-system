<?php

namespace App\Http\Livewire\Master;

use App\Models\mdepartement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class Departement extends Component
{
    use WithPagination;

    public $confirmingAddModal = false;
    public $confirmingEditModal = false;
    public $confirmingDeleteModal = false;

    public $nama, $id_Dept, $password;

    protected $rules = [
        'nama' => 'required'
    ];

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->nama = '';
        $this->id_dep = '';
        $this->id_del = '';

        $this->confirmingAddModal = true;
    }
    public function showmodalEdit($id)
    {
        $this->nama = mdepartement::find($id)->nama;
        $this->id_Dept = mdepartement::find($id)->id;
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

        $data = new mdepartement();
        $data->nama = $this->nama;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','Departement Berhasil di Tambahkan.');
        return redirect()->route('master.departement');
    }

    public function edit()
    {
        $this->validate();

        $data = mdepartement::find($this->id_Dept);
        $data->nama = $this->nama;
        $data->updatedBy = auth()->user()->username;
        $data->save();

        $this->flash('success','Departement Berhasil di Ubah.');
        return redirect()->route('master.departement');
    }
    public function delete()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $data = mdepartement::find($this->id_del);
        $data->delete();

        $this->flash('success','Departement Berhasil di Hapus.');
        return redirect()->route('master.departement');
    }

    public function render()
    {
        $departement = mdepartement::paginate(10);
        return view('livewire.master.departement',[
            'departement' => $departement,
        ]);
    }
}
