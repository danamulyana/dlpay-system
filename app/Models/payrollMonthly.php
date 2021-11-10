<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class payrollMonthly extends Model
{
    use HasFactory;

    protected $table = 'payroll_monthlies';

    protected $fillable = [
        'Transaction_id',
        'user_id',
        'salary_deductions',
        'salary_increase',
        'overtime',
        'salary_payment',
        'basic_payment',
        'total_payment',
        'Approve',
        'month',
    ];

    public function karyawan() : HasMany
    {
        return $this->hasMany(memployee::class);
    }
}