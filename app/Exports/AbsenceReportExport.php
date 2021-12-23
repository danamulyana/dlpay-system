<?php

namespace App\Exports;

use App\Models\collectAttendance;
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
class AbsenceReportExport implements WithProperties, FromQuery,WithMapping, WithHeadings,WithEvents, ShouldAutoSize
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
            'title'          => 'Absence ' . Carbon::now(),
            'description'    => 'Latest Absence in ' . env('APP_NAME','PT Cahaya Sukses Plastindo'),
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
            'NAMA',
            'JAM MASUK',
            'JAM MASUK IMAGE',
            'JAM KELUAR',
            'JAM KELUAR IMAGE',
            'STATUS',
            'DETAIL KETERANGAN',
            'DI BUAT OLEH',
            'DI BUAT',
        ];
    }
    public function query()
    {
        return collectAttendance::query()->whereBetween('created_at', [$this->start." 00:00:00",$this->finish." 23:59:59"]);
    }
    public function map($data): array
    {
        return [
            ++$this->rows,
            $data->karyawan->nama,
            $data->jam_masuk,
            URL::to('/').$data->jam_masuk_photo_path,
            $data->jam_Keluar,
            URL::to('/').$data->jam_Keluar_photo_path,
            $data->keterangan,
            $data->keterangan_detail,
            $data->createdBy,
            $data->created_at,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class  => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:J1')
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

                $event->sheet->getDelegate()->getStyle('A1:J1')->applyFromArray($styles);
                $event->sheet->getDelegate()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('J')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
