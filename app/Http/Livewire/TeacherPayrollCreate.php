<?php

namespace App\Http\Livewire;

use App\Teacher;
use App\Spform;
use App\Student;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherPayrollCreate extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $selectedTeacher = '';
    public $current_month = '';

    public function mount()
    {
        $this->current_month = date("n");
    }

    public function render()
    {
        $submitted_spforms = 0;


        $get_Spforms =  Spform::select(DB::raw('studentIC'), DB::raw('count(studentIC) as `count_spform`'))
            ->groupby('studentIC')
            ->where('teacherIC', $this->selectedTeacher)
            ->whereMonth('class_date', $this->current_month)
            ->get();

        foreach ($get_Spforms as $Spform) {
            $submitted_spforms += $Spform->count_spform;
        }

        $months = [];

        for ($m = 1; $m <= 12; ++$m) {
            $months[] = [
                'month_no' => $m,
                'month' => date('F', mktime(0, 0, 0, $m, 1))
            ];
        }

        return view('livewire.teacher-payroll-create', [
            'teachers' => Teacher::all(),
            'Spforms' =>  Spform::select(DB::raw('studentIC'), DB::raw('count(studentIC) as `count_spform`'))
                ->groupby('studentIC')
                ->where('teacherIC', $this->selectedTeacher)
                ->whereMonth('class_date', $this->current_month)
                ->paginate($this->perPage),
            'no_of_student' => Student::where('teacher', $this->selectedTeacher)->count(),
            'submitted_spforms' => $submitted_spforms,
            'months' => $months,
            'unapprovedSpForm' => Spform::where('teacherIC', $this->selectedTeacher)->where('status', '<>', 1)->first()
        ]);
    }
}
