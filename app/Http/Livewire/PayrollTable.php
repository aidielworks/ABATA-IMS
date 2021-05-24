<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Payroll;

class PayrollTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    public $search = '';
    public $status = 'Pending';

    public function render()
    {

        return view('livewire.payroll-table', [
            'payrolls' => Payroll::search($this->search)
                ->orWhere('status', 'like', $this->status)
                ->orderBy('status', 'asc')
                ->paginate($this->perPage),
        ]);
    }
}
