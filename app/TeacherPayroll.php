<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPayroll extends Model
{
    use HasFactory;
    protected $table = 'teacher_payrolls';

    protected $fillable = [
        'reference_no',
        'teacher_ic',
        'net_salary',
        'no_of_student',
        'rate_per_student',
        'payroll_month',
        'issued_by',
        'status'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('reference_no', 'like', '%' . $search . '%')
            ->orWhere('teacher_ic', 'like', '%' . $search . '%');
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'ic', 'teacher_ic');
    }
}
