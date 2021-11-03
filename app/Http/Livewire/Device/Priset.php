<?php

namespace App\Http\Livewire\Device;

use App\Models\mpriset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class Priset extends Component
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
    public $name;

    // edit
    public $data;

    protected $rules = [
        'name' => 'required',
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

        $data = mpriset::find($this->id_del);
        $data->delete();

        $this->flash('success','Priset Berhasil di Hapus.');
        return redirect()->route('device.remark');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();

        $data = new mpriset();
        $data->name = $this->name;
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','Priset Berhasil di Tambahkan.');
        return redirect()->route('device.remark');
    }

    public function showmodalEdit($id)
    {
        $this->confirmingEditModal = true;
        $data = mpriset::find($id);
        $this->data = $data->toArray();
    }

    public function edit()
    {
        $this->validate([
            'data.name' => 'required',
        ]);

        $data = mpriset::find($this->data['id']);
        $data->name = $this->data['name'];
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $this->flash('success','Priset Berhasil di Ubah.');
        return redirect()->route('device.remark');
    }

    public function render()
    {
        $prisets = mpriset::query()->where('name', 'like', '%'.$this->searchTerms.'%')
                    ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.device.priset',[
            'prisets' => $prisets,
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
