<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_no',
        'employee_ic',
        'basic_salary',
        'company_income_tax',
        'net_salary',
        'total_allowances',
        'total_deductions',
        'income_tax',
        'payroll_month',
        'issued_by',
        'status'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('reference_no', 'like', '%' . $search . '%')
            ->orWhere('employee_ic', 'like', '%' . $search . '%');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'ic', 'employee_ic');
    }

    public function allowances()
    {
        return $this->hasMany(Allowances::class, 'payroll_reference_no', 'reference_no');
    }

    public function deductions()
    {
        return $this->hasMany(Deductions::class, 'payroll_reference_no', 'reference_no');
    }
}
