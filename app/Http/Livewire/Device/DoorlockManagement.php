<?php

namespace App\Http\Livewire\Device;

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

    public $datakaryawan;
    //delete
    public $id_del, $password;

    public function showmodal()
    {
        $this->resetErrorBag();

        $this->confirmingAddModal = true;
    }

    public function render()
    {
        return view('livewire.device.doorlock-management',[
            'data' => [],
        ]);
    }
}
