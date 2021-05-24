<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\TeacherPayroll;
use Livewire\WithPagination;

class TeacherPayrollTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';
    public $status = 'Pending';

    public function render()
    {
        return view('livewire.teacher-payroll-table', [
            'teacherPayrolls' => TeacherPayroll::search($this->search)
                ->orWhere('status', 'like', $this->status)
                ->orderBy('created_at', 'asc')
                ->paginate($this->perPage),
        ]);
    }
}
