<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PayrollEmployeeSetup extends Component
{
    public $employee;
    public $basic_salary = 0;
    public $allowances = [];
    public $deductions = [];
    public $total_allowances = 0;
    public $total_deductions = 0;
    public $income_tax = 0;
    public $net_salary = 0;
    public $months = [];

    protected $messages = [
        'allowances.*.item.required' => 'This allowances item field is required!',
        'allowances.*.amount.required' => 'Please specify amount!'
    ];

    public function mount($employee)
    {
        $this->employee = $employee;
        $this->basic_salary = $employee->job->basic_salary;
        $this->allowances = [
            [
                'item' => '',
                'amount' => '0'
            ]
        ];
        $this->deductions = [
            [
                'item' => '',
                'amount' => '0'
            ]
        ];

        for ($m = 1; $m <= 12; ++$m) {
            $this->months[] = [
                'month_no' => $m,
                'month' => date('F', mktime(0, 0, 0, $m, 1))
            ];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly(
            $propertyName,
            [
                'allowances.*.item' => 'required',
                'allowances.*.amount' => 'required',
                'deductions.*.item' => 'required',
                'deductions.*.amount' => 'required'
            ]
        );
    }

    public function removeAllowances($index)
    {
        unset($this->allowances[$index]);
        $this->allowances = array_values($this->allowances);
    }

    public function removeDeductions($index)
    {
        unset($this->deductions[$index]);
        $this->deductions = array_values($this->deductions);
    }


    public function addAllowances()
    {
        $this->allowances[] = [
            'item' => '',
            'amount' => '0'
        ];
    }

    public function addDeductions()
    {
        $this->deductions[] = [
            'item' => '',
            'amount' => '0'
        ];
    }

    public function render()
    {

        $atotal = 0;
        $dtotal = 0;

        foreach ($this->allowances as $allowance) {
            if ($allowance['amount'] != '') {
                $atotal += $allowance['amount'];
            }
        }
        foreach ($this->deductions as $deduction) {
            if ($deduction['amount'] != '') {
                $dtotal += $deduction['amount'];
            }
        }

        $this->total_allowances = number_format($atotal, 2, '.', '');
        $this->total_deductions = number_format($dtotal, 2, '.', '');
        $this->income_tax = number_format($this->basic_salary * 0.095, 2, '.', '');
        $this->net_salary = number_format($this->basic_salary + $atotal - $dtotal - $this->income_tax, 2, '.', '');

        return view('livewire.payroll-employee-setup', [
            'total_allowances' => $this->total_allowances,
            'total_deductions' => $this->total_deductions,
            'net_salary' => $this->net_salary,
            'income_tax' => $this->income_tax
        ]);
    }
}
