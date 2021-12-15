<?php

namespace App\Http\Livewire\Superadmin;

use Livewire\Component;
use Spatie\Permission\Models\Permission as PermisionsDB;
use Livewire\WithPagination;

class Permisions extends Component
{
    use WithPagination;

    public $perPage = '10';
    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function render()
    {
        $permissions = PermisionsDB::query()->where('name', 'like', '%'.$this->searchTerms.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.superadmin.permisions',[
            'permissions' => $permissions,
        ]
        );
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
