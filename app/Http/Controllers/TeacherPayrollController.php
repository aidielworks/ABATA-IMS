<?php

namespace App\Http\Controllers;

use App\Spform;
use App\Student;
use App\Teacher;
use App\TeacherPayroll;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherPayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TeacherPayroll.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$unapproved = Spform::where('teacherIC', '970313145057')->where('status', '<>', 1)->first();

        // if ($unapproved == null) {
        //     echo 'all approved';
        // }
        // die;
        return view('TeacherPayroll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacherIC' => 'required',
            'net_salary' => 'required',
            'payroll_month' => 'required'
        ]);

        $db = TeacherPayroll::where('teacher_ic', $request->teacherIC)
            ->where('payroll_month', $request->payroll_month)
            ->first();

        if ($db) {
            return redirect('teacher/payroll')->with('status-danger', 'Payroll existed!');
        }

        $reference_no = substr($request->teacherIC, -4) . '-' . date('YmdHis'); //generate payroll reference number

        TeacherPayroll::create([
            'reference_no' => $reference_no,
            'teacher_ic' => $request->teacherIC,
            'no_of_student' => $request->no_of_student,
            'rate_per_student' => $request->rate_per_student,
            'net_salary' => $request->net_salary,
            'payroll_month' => $request->payroll_month,
            'issued_by' => $request->session()->get('ic'),
            'status' => 'Pending'
        ]);

        return redirect('teacher/payroll')->with('status', 'Payroll created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeacherPayroll  $teacherPayroll
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $teacherPayroll = TeacherPayroll::find($id);
        $student_count = Student::where('teacher', $teacherPayroll->teacher[0]['ic'])->count();
        return view('TeacherPayroll.show', compact('teacherPayroll', 'student_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherPayroll  $teacherPayroll
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherPayroll $teacherPayroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherPayroll  $teacherPayroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacherPayroll)
    {
        TeacherPayroll::where('id', $teacherPayroll)->update([
            'status' => 'Paid'
        ]);
        return redirect('teacher/payroll/' . $teacherPayroll)->with('status', 'Payroll paid!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherPayroll  $teacherPayroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherPayroll $teacherPayroll)
    {
        //
    }

    public function teacherPayroll($id)
    {

        $teacherPayroll = TeacherPayroll::find($id);
        $pdf = PDF::loadView('TeacherPayroll.pdf', compact('teacherPayroll'))->setPaper('a4', 'potrait');
        return $pdf->download('ABATA_TPR - ' . $teacherPayroll->reference_no . '.pdf', array("Attachment" => false));
    }
}
