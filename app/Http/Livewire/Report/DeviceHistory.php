<?php

namespace App\Http\Livewire\Report;

use App\Models\HistoryDeviceLog;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DeviceHistory extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public function render()
    {
        $history = HistoryDeviceLog::where('created_at', ">", Carbon::now()->subMonth(3))->orWhere('keterangan','LIKE','%'.$this->searchTerms.'%')->orWhereRelation('karyawan','nama', 'like', '%'.$this->searchTerms.'%')->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.report.device-history',[
            'history' => $history,
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
