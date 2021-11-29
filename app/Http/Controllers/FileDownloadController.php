<?php

namespace App\Http\Controllers;

use App\Exports\MonthlyPaymentExport;
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
    public function downloadMonthPaymentEXCEL(Request $request) 
    {
        return Excel::download(new MonthlyPaymentExport($request->month), 'Payroll Monthly - '. $request->month . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    public function downloadMonthPaymentCSV(Request $request)
    {
        return Excel::download(new MonthlyPaymentExport($request->month), 'Payroll Monthly - '. $request->month . '.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
