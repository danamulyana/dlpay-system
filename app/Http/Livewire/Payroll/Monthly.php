<?php

namespace App\Http\Livewire\Payroll;

use App\Models\collectAttendance;
use App\Models\memployee;
use App\Models\payrollMonthly;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Monthly extends Component
{
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingAddModal = false;
    public $confirmingDeleteModal = false;

    public $id_del, $password;

    public function createPayroll()
    {
        $karyawan = memployee::where('payment_mode','monthly')->get();
        foreach ($karyawan as $key => $value) {
            $attandence = collectAttendance::where('user_id', $value->id)->where('keterangan','!=','tidak masuk')->whereDate('created_at', '>=', Carbon::now()->subDays(30))->count();
            $payrollCount = payrollMonthly::all()->count();
            $totalOvertime = 0;
            $salary_payment = $value->basic_salary;
            $basic_payment = $salary_payment / 24 * $attandence;
            payrollMonthly::create([
                'Transaction_id' => Carbon::now()->format('dmY') . '020' .str_pad($payrollCount, 3, '0', STR_PAD_LEFT),
                'user_id' => $value->id,
                'overtime' => $totalOvertime,
                'salary_payment' => $salary_payment,
                'basic_payment' => $basic_payment,
                'total_payment' => $basic_payment + $totalOvertime,
            ]);
        }
    }

    public function showmodal()
    {
        $this->resetErrorBag();

        // $this->confirmingAddModal = true;
        $this->createPayroll();
    }

    public function showmodalDelete(String $id)
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
        $data = payrollMonthly::where('created_at', $this->id_del)->get();

        foreach ($data as $key => $value) {
           payrollMonthly::find($value->id)->delete();
        }

        $this->flash('success','Payroll Berhasil di Hapus.');
        return redirect()->route('payroll.monthly');
    }

    public function render()
    {
        $monthlys = payrollMonthly::select('created_at')->distinct()->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        return view('livewire.payroll.monthly',[
            'monthlys' => $monthlys,
        ]);
    }
}
