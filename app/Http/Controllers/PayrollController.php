<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Employee;
use App\Payroll;
use App\Allowances;
use App\Deductions;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all()->count();
        $totalSalary = Payroll::where('status', 'Pending')->where('payroll_month', date('n', strtotime('+1 month')))->sum('net_salary');
        $company_income_tax = Payroll::where('status', 'Pending')->where('payroll_month', date('n', strtotime('+1 month')))->sum('company_income_tax');
        return view('Admin.Payroll.index', compact('totalSalary', 'company_income_tax', 'employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.Payroll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $reference_no = substr($request->employee_ic, -4) . '-' . date('YmdHis'); //generate payroll reference number
        $company_income_tax = number_format($request->basic_salary * 0.14, 2, '.', ''); //Income tax for company

        $payroll_existed = Payroll::where('employee_ic', '=', $request->employee_ic)
            ->where('payroll_month', $request->month)
            ->where('status', 'Pending')
            ->first();

        if ($payroll_existed != null) {
            return redirect('admin/payroll/create')->with('status-danger', 'Payroll existed!');
        }

        Payroll::create([
            'reference_no' => $reference_no,
            'employee_ic' => $request->employee_ic,
            'basic_salary' => $request->basic_salary,
            'company_income_tax' => $company_income_tax,
            'net_salary' => $request->net_salary,
            'total_allowances' => $request->total_allowances,
            'total_deductions' => $request->total_deductions,
            'payroll_month' => $request->month,
            'income_tax' => $request->income_tax,
            'issued_by' => $request->session()->get('ic'),
            'status' => 'Pending'
        ]);

        if ($request->allowances[0]['item'] != '') {
            foreach ($request->allowances as $value) {
                Allowances::create([
                    'payroll_reference_no' => $reference_no,
                    'allowance_item' => $value['item'],
                    'allowance_amount' => $value['amount']
                ]);
            }
        }
        if ($request->deductions[0]['item'] != '') {
            foreach ($request->deductions as $value) {
                Deductions::create([
                    'payroll_reference_no' => $reference_no,
                    'deduction_item' => $value['item'],
                    'deduction_amount' => $value['amount']
                ]);
            }
        }

        return redirect('admin/payroll')->with('status', 'Payroll created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($payroll, $employee)
    {
        $payroll = Payroll::find($payroll);
        $employee = Employee::find($employee);
        return view('Admin.Payroll.show', compact('payroll', 'employee'));
    }

    public function emp_payroll_setting($id)
    {
        $employee = Employee::find($id);
        return view('Admin.Payroll.setup', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        return view('Admin.Payroll.edit', compact('payroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
