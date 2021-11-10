<?php

namespace App\Http\Livewire\Master;

use App\Models\doorlockDevices;
use App\Models\mbank;
use App\Models\mdepartement;
use App\Models\memployee;
use App\Models\msubdepartement;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;

class Employees extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingViewModal = false;
    public $confirmingDeleteModal = false;

    public $subdepdropdown = null;
    public $sub_selection = null;
    public $paymentselect = null;
    public $paymentselecttrue = null;

    public $data , $fingerprint, $bank_name, $bank_account, $credited_accont, $doorView = [], $deviceData = [];

    public $view = [];
    public $subview, $depview, $viewtransfer;

    public $user;

    public $photo, $profile_photo_path;

    public $id_del, $password;

    protected $rules = [
        'data.nip' => 'required|unique:App\Models\memployee,nip',
        'data.rfid' => 'required',
        'data.attendance_type' => 'required',
        'fingerprint' => 'nullable',
        'data.nama' => 'required|max:220',
        'data.job' => 'required|max:220',
        'subdepdropdown' => 'required',
        'data.subdep' => 'required',
        'data.alamat' => 'max:220',
        'data.nohp' => 'numeric',
        'data.email' => 'max:220',
        'data.payment_mode' => 'required',
        'data.basic_salary' => 'required',
        'paymentselect' => 'required',
        'bank_name' => 'max:220',
        'bank_account' => 'max:100',
        'credited_accont' => 'numeric|nullable',
        'data.pph_type' => 'nullable',
        'data.pph_pemerintahan' => 'nullable',
        'data.pph_perusahaan' => 'nullable',
    ];

    protected $queryString = ['searchTerms' => ['except' => '']];

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

        $data = memployee::find($this->id_del);
        $data->delete();
        $data->Doorlock()->detach();

        $this->flash('success','Karyawan Berhasil di Hapus.');
        return redirect()->route('master.employees');
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function add()
    {
        $this->validate();
        
        $data = new memployee();
        $data->nip = $this->data['nip'];
        $data->rfid_number = $this->data['rfid'];
        $data->fingerprint = $this->fingerprint;
        $data->attendance_type = $this->data['attendance_type'];
        $data->nama = $this->data['nama'];
        $data->job_title = $this->data['job'];
        $data->alamat = $this->data['alamat'];
        $data->noHandphone = $this->data['nohp'];
        $data->email = $this->data['email'];
        $data->payment_mode = $this->data['payment_mode'];
        $data->basic_salary = curremcyIDRToNumeric($this->data['basic_salary']);
        $data->transfer_type = $this->paymentselect;
        $data->bank_name = $this->bank_name;
        $data->bank_account = $this->bank_account;
        $data->credited_accont = $this->credited_accont;
        $data->departement_id = $this->subdepdropdown;
        $data->subdepartement_id = $this->data['subdep'];
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        $data->save();

        $data->Doorlock()->sync($this->deviceData);

        $this->flash('success','Karyawan Berhasil di Tambahkan.');
        return redirect()->route('master.employees');
    }

    public function updatedSubDepDropdown($id)
    {
        $this->sub_selection = msubdepartement::where('departement_id',$id)->get();
    }

    public function updatedDepview($id)
    {
        $this->subview = msubdepartement::where('departement_id',$id)->get();
    }

    public function updatedPaymentSelect($type)
    {
        if ($type === "1") {
            $this->paymentselecttrue = true;
        }else{
            $this->paymentselecttrue = null;
        }
    }

    public function showmodalView($id)
    {
        $this->emit('select2modal');
        $this->confirmingViewModal = true;
        $data = memployee::find($id);
        $door = [];
        foreach ($data->Doorlock as $value) {
            $door[] = $value->pivot->doorlock_id;
        }
        $this->dataView = $data;
        $this->view = $data->toArray();
        $this->doorView = $door;
        $this->depview = $data->departement_id;
        $this->subview = msubdepartement::where('departement_id',$id)->get();
        $this->viewtransfer = $data->transfer_type;
        $this->profile_photo_path = $data->profile_photo_path;
    }

    public function edit()
    {
        $this->validate([
            'photo' => 'image|max:3024|nullable', // 3MB Max
        ]);

        $data = memployee::find($this->view['id']);
        $data->nip = $this->view['nip'];
        $data->rfid_number = $this->view['rfid_number'];
        $data->fingerprint = $this->view['fingerprint'];
        $data->attendance_type = $this->view['attendance_type'];
        $data->nama = $this->view['nama'];
        $data->job_title = $this->view['job_title'];
        $data->alamat = $this->view['alamat'];
        $data->noHandphone = $this->view['noHandphone'];
        $data->email = $this->view['email'];
        $data->payment_mode = $this->view['payment_mode'];
        $data->basic_salary = curremcyIDRToNumeric($this->view['basic_salary']);
        $data->transfer_type = $this->viewtransfer;
        $data->bank_name = $this->view['bank_name'];
        $data->bank_account = $this->view['bank_account'];
        $data->credited_accont = $this->view['credited_accont'];
        $data->departement_id = $this->depview;
        $data->subdepartement_id = $this->view['subdepartement_id'];
        $data->createdBy = auth()->user()->username;
        $data->updatedBy = auth()->user()->username;

        if ($this->photo) {
            $filename = Carbon::now()->timestamp. '-' . auth()->user()->id. '-' . rand(0,9999) . '.' . $this->photo->getClientOriginalExtension();
            // $this->photo->storeAs('public/files/', $filename);
            $this->photo->storeAs('public/files/' . Carbon::now()->format('Y').'/'.Carbon::now()->format('m'), $filename);
            $data->profile_photo_path = 'storage/files/'. Carbon::now()->format('Y').'/'.Carbon::now()->format('m') . '/' .$filename;
        }

        $data->save();

        $data->Doorlock()->sync($this->doorView);


        $this->flash('success','Karyawan Berhasil di Ubah.');
        return redirect()->route('master.employees');
    }


    public function render()
    {
        $employees = memployee::query()->where('nama', 'like', '%'.$this->searchTerms.'%')
        ->orWhere('nip','like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        $departement = mdepartement::all();
        $banks = mbank::all();
        $devices = doorlockDevices::all(); 
        return view('livewire.master.employees',[
            'employees' => $employees,
            'departement' => $departement,
            'banks' => $banks,
            'devices' => $devices,
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
