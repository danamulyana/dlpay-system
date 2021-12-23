<?php

namespace App\Exports;

use App\Models\DoorlockReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithProperties;

class DoorlockReportExport implements WithProperties, FromQuery,WithMapping, WithHeadings,WithEvents, ShouldAutoSize
{
    use Exportable;

    public $start;
    public $finish;
    public $rows = 0;

    public function __construct($startDate, $finishDate)
    {
        $this->start = $startDate;
        $this->finish = $finishDate;
    }

    public function properties(): array
    {
        return [
            'creator'        => env('APP_SYSTEM','Door Lock Access & Payroll Systems'). env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'lastModifiedBy' => env('APP_SYSTEM','Door Lock Access & Payroll Systems') . env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'title'          => 'Doorlock Report' . Carbon::now(),
            'description'    => 'Latest Doorlock Report in ' . env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'subject'        => 'history',
            'keywords'       => 'history,export,spreadsheet',
            'category'       => 'history',
            'company'        => env('APP_NAME','PT Cahaya Sukses Plastindo'),
        ];
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'UID | NAMA DEVICE',
            'KETERANGAN',
            'REMARK LOG',
            'COUNT ACCESS',
            'FOTO DOORLOCK ACCESS',
            'DI BUAT OLEH',
            'DI BUAT',
        ];
    }
    public function query()
    {
        return DoorlockReport::query()->whereBetween('created_at', [$this->start." 00:00:00",$this->finish." 23:59:59"]);
    }
    public function map($data): array
    {
        return [
            ++$this->rows,
            $data->karyawan->nama,
            $data->uid.'|'.$data->device->name,
            $data->keterangan,
            $data->remark_log,
            $data->count_access,
            URL::to('/').$data->doorlock_photo_path,
            $data->createdBy,
            $data->created_at,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:I1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('000000');

                $styles = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],                        
                    'font' => [
                            'name' => 'Calibri',
                            'size' => 11,
                            'bold' => false,
                            'color' => ['argb' => 'FFFFFF'],
                    ]
                    ];

                $event->sheet->getDelegate()->getStyle('A1:I1')->applyFromArray($styles);
                $event->sheet->getDelegate()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
