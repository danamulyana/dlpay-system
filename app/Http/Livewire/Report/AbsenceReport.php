<?php

namespace App\Http\Livewire\Report;

use App\Exports\AbsenceReportExport;
use App\Http\Controllers\Api\device;
use App\Models\collectAttendance;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AbsenceReport extends Component
{
    use WithPagination;

    public $searchTerms;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = '10';

    public $confirmingViewModal = false;

    public $views = [], $viewName = " ",$viewKaryawan = [], $viewPhotoMasuk, $viewPhotoKeluar;

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

        return Excel::download(new AbsenceReportExport($this->startDate,$this->finishDate), 'AbsenceReport-csp-'.Carbon::now().'.xlsx');
    }

    public function showmodalView($id)
    {
        $this->confirmingViewModal = true;
        $data = collectAttendance::find($id);
        $this->views = $data->toArray();
        $this->viewKaryawan = $data->karyawan->toArray();
        $this->viewName = $data->karyawan->nama . ' | ' . $data->created_at->format("d-M-Y");
        $this->viewPhotoMasuk = $data->jam_masuk_photo_path;
        $this->viewPhotoKeluar = $data->jam_Keluar_photo_path;
    }

    public function render()
    {
        $datas = collectAttendance::query()->whereRelation('karyawan','nama', 'like', '%'.$this->searchTerms.'%')->orderBy($this->sortColumnName, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.report.absence-report',[
            'datas' => $datas,
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
