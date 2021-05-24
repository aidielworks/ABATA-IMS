<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Employee;

class PayrollEmployeeTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';
    public function render()
    {
        return view('livewire.payroll-employee-table', [
            'employees' => Employee::search($this->search)->paginate($this->perPage),
        ]);
    }
}
