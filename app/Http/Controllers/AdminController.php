<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use App\Authentication;
use App\JobType;
use App\Student;
use App\Teacher;

class AdminController extends Controller
{
    public function accessTimestamp()
    {
        $auth = Authentication::all();
        return view('Admin.loginlogout', compact('auth'));
    }

    public function assign(Employee $employee)
    {
        Employee::where('id', $employee->id)->update([
            'role' => 1
        ]);

        return redirect("/admin/assignAccess")->with('status', 'Access granted!');
    }

    public function withhold(Employee $employee)
    {
        Employee::where('id', $employee->id)->update([
            'role' => 0
        ]);

        return redirect("/admin/assignAccess")->with('status', 'Access withhold!');
    }

    public function assignAccess()
    {
        $employees = Employee::all();
        return view('Admin.assignAccess', compact('employees'));
    }


    // JOB TYPE
    public function job_types()
    {
        $jobs = JobType::all();
        return view('Admin.JobType.index', compact('jobs'));
    }

    public function create_job_types()
    {
        return view('Admin.JobType.create');
    }

    public function store_job_types(Request $request)
    {
        $request->validate([
            'job_position' => 'required|unique:job_types',
            'basic_salary' => 'required'
        ]);

        JobType::create([
            'job_position' => $request->job_position,
            'basic_salary' => $request->basic_salary
        ]);

        return redirect('/admin/job_types')->with('status', 'Position added!');
    }

    public function edit_job_types(JobType $job)
    {
        return view('Admin.JobType.edit', compact('job'));
    }

    public function update_job_types(Request $request, JobType $job)
    {
        $request->validate([
            'job_position' => 'required',
            'basic_salary' => 'required'
        ]);

        JobType::where('id', $job->id)->update([
            'job_position' => $request->job_position,
            'basic_salary' => $request->basic_salary
        ]);

        return redirect('/admin/job_types')->with('status', 'Position updated!');
    }

    public function destroy_job_types(JobType $job)
    {
        JobType::destroy($job->id);
        return redirect('/admin/job_types')->with('status-danger', 'Position deleted!');
    }

    public function archiveUser()
    {
        $archiveEmployee = Employee::onlyTrashed()->get();
        $archiveTeacher = Teacher::onlyTrashed()->get();
        $archiveStudent = Student::onlyTrashed()->get();
        return view('Admin.archiveUser', compact('archiveEmployee', 'archiveTeacher', 'archiveStudent'));
    }

    public function restoreUser($type, $id)
    {
        if ($type == 'employee') {

            Employee::withTrashed()->find($id)->restore();
            return redirect('/admin/archive_user')->with('status', 'Employee restore!');
        } elseif ($type == 'teacher') {

            Teacher::withTrashed()->find($id)->restore();
            return redirect('/admin/archive_user')->with('status', 'Teacher restore!');
        } else {

            Student::withTrashed()->find($id)->restore();
            return redirect('/admin/archive_user')->with('status', 'Student restore!');
        }
    }
}
