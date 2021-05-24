<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Student;

class StudentsTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';

    public function render()
    {
        return view('livewire.students-table', [
            'students' => Student::search($this->search)->paginate($this->perPage),
        ]);
    }
}
