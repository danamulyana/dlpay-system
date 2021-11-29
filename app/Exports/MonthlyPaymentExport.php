<?php

namespace App\Exports;

use App\Models\payrollMonthly;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithProperties;

class MonthlyPaymentExport implements WithProperties, WithColumnWidths, FromQuery,WithMapping, WithColumnFormatting, WithHeadings,WithEvents, ShouldAutoSize
{
    use Exportable;

    public $Month;
    private $rows = 0;

    public function __construct($month)
    {
        $this->Month = $month;
    }

    public function properties(): array
    {
        return [
            'creator'        => env('APP_SYSTEM','Door Lock Access & Payroll Systems'). env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'lastModifiedBy' => env('APP_SYSTEM','Door Lock Access & Payroll Systems') . env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'title'          => 'Payroll Report : ' . $this->Month,
            'description'    => 'Latest Payroll at Payroll Systems' . env('APP_NAME','PT Cahaya Sukses Plastindo'),
            'subject'        => 'payroll',
            'keywords'       => 'payroll,export,spreadsheet',
            'category'       => 'payroll',
            'company'        => env('APP_NAME','PT Cahaya Sukses Plastindo'),
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Transaction ID',
            'Transfer Type',
            'Beneficiary ID',
            'Credited Account',
            'Receiver Name',
            'Amount',
            'NIP',
            'Remark',
            'Beneficiary email address',
            'Receiver Swift Code',
            'Receiver Cust Type',
            'Receiver Cust Residence',
        ];
    }
    public function query()
    {
        Carbon::parse($this->Month);
        $payroll = payrollMonthly::query()->whereDate('created_at', $this->Month)->where('Approve',1);
        return $payroll;
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 9,            
            'B' => 19,            
            'C' => 13,
            'E' => 81,
            'G' => 29,
            'J' => 83,
            'K' => 19,            
            'L' => 18,            
            'M' => 23,            

        ];
    }

    public function map($payroll): array
    {
        return [
            ++$this->rows,
            $payroll->Transaction_id,
            $payroll->karyawan->transfer_type == 1 ? 'CASH' : $payroll->karyawan->bank->nama_bank,
            '',
            $payroll->karyawan->credited_accont,
            $payroll->karyawan->bank_name,
            currencyNumericToIDRCostume($payroll->total_payment),
            $payroll->karyawan->nip,
            '',

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:M1')
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

                $event->sheet->getDelegate()->getStyle('A1:M1')->applyFromArray($styles);
                // $event->sheet->getDelegate()
                //                 ->getColumnDimension('E')
                //                 ->setAutoSize(false)
                //                 ->setWidth(80);
                $event->sheet->getDelegate()->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
