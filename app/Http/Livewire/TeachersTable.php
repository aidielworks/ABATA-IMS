<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Teacher;

class TeachersTable extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';

    public function render()
    {
        return view('livewire.teachers-table', [
            'teacher' => Teacher::search($this->search)->paginate($this->perPage),
        ]);
    }
}
