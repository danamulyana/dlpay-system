<?php

namespace App\Http\Livewire\Superadmin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ManagementUsers extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingviewConfirmModal = false;
    public $confirmingViewModal = false;
    public $confirmingDeleteModal = false;

    public $data;
    public $id_view, $view = [], $viewRole;
    public $id_del, $password;

    protected $rules = [
        'data.username' => 'required|string|max:255|unique:users,username',
        'data.name' => 'required|string|max:255',
        'data.email' => 'required|string|email|max:255|unique:users,email',
        'data.password' => 'required|string|confirmed',
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

        $data = User::find($this->id_del);
        $data->delete();
        // $data->Doorlock()->detach();

        $this->flash('success','User Berhasil di Hapus.');
        return redirect()->route('admin.managementusers');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->data['name'];
        $user->username = $this->data['username'];
        $user->email = $this->data['email'];
        $user->password = Hash::make($this->data['password']);
        $user->save();

        $user->assignRole($this->data['role']);
        if($user){
            //redirect dengan pesan sukses
            $this->flash('success','User Berhasil di Tambahkan.');
            return redirect()->route('admin.managementusers');
        }else{
            //redirect dengan pesan error
            $this->flash('error','User Gagal di Tambahkan.');
            return redirect()->route('admin.managementusers');
        }
    }

    public function showmodalView($id)
    {
        $this->resetErrorBag();

        $this->password = '';
        $this->id_view = $id;

        $this->dispatchBrowserEvent('confirming-modal-view');

        $this->confirmingviewConfirmModal = true;
    }
    public function checkView()
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }
        $this->confirmingviewConfirmModal = false;
        $this->modalView($this->id_view);
    }
    public function modalView($id)
    {
        $this->confirmingViewModal = true;
        $data = User::find($id);
        $this->view = $data->toArray();
        $this->view['password'] = '';
        $roles = [];
        foreach ($data->roles as $value) {
            $roles[] = $value->name;
        }
        $this->viewRole = $roles;
    }
    public function edit()
    {
        $this->validate([
            'view.username' => 'required|string|max:255',
            'view.name' => 'required|string|max:255',
            'view.email' => 'required|string|email|max:255|',
            'view.password' => 'nullable|string|confirmed',
        ],[
            'view.email.required' => 'The :attribute cannot be empty.',
            'view.email.email' => 'The :attribute format is not valid.',
            'view.username.required' => 'The :attribute format is not valid.',
        ],[
            'view.email' => 'email',
            'view.name' => 'name',
            'view.username' => 'username',
            'view.password' => 'password',
            'view.password_confirmation' => 'password Confirmation',
        ]);

        $user = User::find($this->id_view);
        $user->name = $this->view['name'];
        $user->username = $this->view['username'];
        $user->email = $this->view['email'];
        if ($this->view['password']) {
            $user->password = Hash::make($this->view['password']);
        }
        $user->save();

        $user->syncRoles($this->viewRole);
        if($user){
            //redirect dengan pesan sukses
            $this->flash('success','User Berhasil di Ubah.');
            return redirect()->route('admin.managementusers');
        }else{
            //redirect dengan pesan error
            $this->flash('error','User Gagal di Ubah.');
            return redirect()->route('admin.managementusers');
        }
    }

    public function render()
    {
        $users = User::query()->where('name', 'like', '%'.$this->searchTerms.'%')
        ->orWhere('username','like', '%'.$this->searchTerms.'%')
        ->orWhere('email','like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        $roles = Role::all();
        return view('livewire.superadmin.management-users',[
            'users' => $users,
            'roles' => $roles,
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
