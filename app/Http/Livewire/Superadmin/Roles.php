<?php

namespace App\Http\Livewire\Superadmin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission as PermisionsDB;

class Roles extends Component
{
    use WithPagination;

    public $perPage = '10';
    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public $confirmingAddModal = false;
    public $confirmingViewModal = false;
    public $confirmingDeleteModal = false;

    public $permisionsAdd = [], $name;
    public $permisionEdit = [], $nameEdit, $viewid;

    protected $rules = [
        'name' => 'required|unique:roles',
        'permisionsAdd' => 'required',
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

        $data = Role::find($this->id_del);
        $data->delete();
        // $data->Doorlock()->detach();

        $this->flash('success','Role Berhasil di Hapus.');
        return redirect()->route('admin.role');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();
        
        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        //assign permission to role
        $role->syncPermissions($this->permisionsAdd);

        if($role){
            //redirect dengan pesan sukses
            $this->flash('success','Role Berhasil di Tambahkan.');
            return redirect()->route('admin.role');
        }else{
            //redirect dengan pesan error
            $this->flash('success','Role Gagal di Tambahkan.');
            return redirect()->route('admin.role');
        }
    }

    public function showmodalView($id)
    {
        $this->confirmingViewModal = true;
        $data = Role::find($id);
        $permision = [];
        $this->nameEdit = $data->name;
        $this->viewid = $data->id;
        foreach ($data->permissions as $value) {
            $permision[] = $value->name;
        }
        $this->permisionEdit = $permision;
        $this->emit('select2permision');
    }
    public function edit()
    {
        $this->validate([
            'nameEdit' => 'required|unique:roles,name',
            'permisionEdit' => 'required',
        ]);

        $role = Role::find($this->viewid);
        $role->name = $this->nameEdit;
        $role->save();
        //assign permission to role
        $role->syncPermissions($this->permisionEdit);

        if($role){
            //redirect dengan pesan sukses
            $this->flash('success','Role Berhasil di Ubah.');
            return redirect()->route('admin.role');
        }else{
            //redirect dengan pesan error
            $this->flash('success','Role Gagal di Ubah.');
            return redirect()->route('admin.role');
        }
    }

    public function render()
    {
        $roles = Role::query()->where('name', 'like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        $Permisions = PermisionsDB::all();
        return view('livewire.superadmin.roles',[
            'roles' => $roles,
            'Permisions' => $Permisions,
        ]);
    }
}
