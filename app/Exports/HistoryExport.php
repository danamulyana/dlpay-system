<?php

namespace App\Exports;

use App\Models\HistoryDeviceLog;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithProperties;

class HistoryExport implements  WithProperties, FromQuery,WithMapping, WithHeadings,WithEvents, ShouldAutoSize
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
            'title'          => 'History Device ' . Carbon::now(),
            'description'    => 'Latest History Device in ' . env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'subject'        => 'history',
            'keywords'       => 'history,export,spreadsheet',
            'category'       => 'history',
            'company'        => env('APP_NAME','PT Cahaya Sukses Plastindo'),
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'UID DEVICE',
            'USER',
            'KETERANGAN',
            'DI BUAT OLEH',
            'DI BUAT',
        ];
    }

    public function query()
    {
        $history = HistoryDeviceLog::query()->whereBetween('created_at', [$this->start." 00:00:00",$this->finish." 23:59:59"]);
        // $history =  HistoryDeviceLog::all();
        return $history;
    }

    public function map($history): array
    {
        return [
            ++$this->rows,
            $history->uid,
            $history->karyawan->nama,
            $history->keterangan,
            $history->createdBy,
            $history->created_at,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:F1')
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

                $event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray($styles);
                $event->sheet->getDelegate()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

}
