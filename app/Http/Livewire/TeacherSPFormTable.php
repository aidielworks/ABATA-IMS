<?php

namespace App\Http\Livewire;

use App\Spform;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherSPFormTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $spform_status = 0;
    public $current_month = '';
    public $months = [];

    public function mount()
    {
        $this->current_month = date("n");

        for ($m = 1; $m <= 12; ++$m) {
            $this->months[] = [
                'month_no' => $m,
                'month' => date('F', mktime(0, 0, 0, $m, 1))
            ];
        }
    }

    public function changeStatus($status)
    {
        $this->spform_status = $status;
    }

    public function render()
    {


        return view('livewire.teacher-s-p-form-table', [
            'spForms' => Spform::search($this->search)
                ->where('status', $this->spform_status)
                ->where('teacherIC', session()->get('ic'))
                ->whereMonth('class_date', $this->current_month)
                ->orderBy('created_at', 'DESC')
                ->paginate($this->perPage),
            'pending' => Spform::where('status', 0)->count(),
            'approved' => Spform::where('status', 1)->count(),
            'declined' => Spform::where('status', 2)->count()
        ]);
    }
}
