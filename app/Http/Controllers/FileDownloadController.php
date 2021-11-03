<?php

namespace App\Http\Controllers;

use App\Exports\WeeklyPaymentExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileDownloadController extends Controller
{
    public function downloadWeeklyPaymentEXCEL(Request $request) 
    {
        return Excel::download(new WeeklyPaymentExport($request->weeks), 'Payroll Weekly - '. $request->weeks . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function downloadWeeklyPaymentCSV(Request $request)
    {
        return Excel::download(new WeeklyPaymentExport($request->weeks), 'Payroll Weekly - '. $request->weeks . '.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
    // public function downloadWeeklyPaymentPDF(Request $request)
    // {
    //     return (new WeeklyPaymentExport($request->weeks))->download('Payroll Weekly - '. $request->weeks .'.pdf', \Maatwebsite\Excel\Excel::TCPDF);
    // }
}
