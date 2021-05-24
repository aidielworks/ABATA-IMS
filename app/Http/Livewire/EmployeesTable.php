<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Employee;

class EmployeesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';

    public function render()
    {
        return view('livewire.employees-table', [
            'employees' => Employee::search($this->search)->paginate($this->perPage),
        ]);
    }
}
