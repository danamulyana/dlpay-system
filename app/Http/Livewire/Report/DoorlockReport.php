<?php

namespace App\Http\Livewire\Report;

use App\Exports\DoorlockReportExport;
use App\Models\DoorlockReport as ModelsDoorlockReport;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DoorlockReport extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingViewModal = false;
    public $viewName = ' ',$karyawanAccess,$viewPhotoDoorlock;

    public $confirmingExportModal = false;
    public $startDate, $finishDate;

    public function showmodalExport()
    {
        $this->startDate = '';
        $this->finishDate = '';
        
        $this->confirmingExportModal = true;
    }
    public function export()
    {
        $this->validate([
            'startDate'=> 'required',
            'finishDate'=> 'required|after:startDate',
        ],['finishDate.after' => 'Tanggal Finish Harus Lebih dari Tanggal Start.',]);

        $this->confirmingExportModal = false;

        return Excel::download(new DoorlockReportExport($this->startDate,$this->finishDate), 'DoorlockReport-csp-'.Carbon::now().'.xlsx');
    }

    public function showmodalView($id)
    {
        $this->confirmingViewModal = true;
        $data = ModelsDoorlockReport::find($id);
        $this->views = $data->toArray();
        $this->viewName = $data->device->name;
        $this->karyawanAccess = $data->karyawan->nama;
        $this->viewPhotoDoorlock = $data->doorlock_photo_path;
    }

    public function render()
    {
        return view('livewire.report.doorlock-report',[
            'doorlock' => ModelsDoorlockReport::query()->whereRelation('device','name', 'like', '%'.$this->searchTerms.'%')->orWhereRelation('karyawan','nama', 'like', '%'.$this->searchTerms.'%')->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage),
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
