<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use PDF;

use App\Employee;
use App\Teacher;
use App\Student;
use App\Payroll;
use App\Spform;

class PagesController extends Controller
{
    public function index()
    {

        $teacher = Teacher::whereYear('created_at', date("Y"))
            ->get()
            ->sortBy(function ($item) {
                return $item->created_at->month;
            })
            ->groupBy(function ($item) {
                return $item->created_at->format("F");
            })
            ->map->count();


        $student = Student::whereYear('created_at', date("Y"))
            ->get()
            ->sortBy(function ($item) {
                return $item->created_at->month;
            })
            ->groupBy(function ($item) {
                return $item->created_at->format("F");
            })
            ->map->count();

        $tMonth = [];
        $sMonth = [];

        $month = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        );

        for ($i = 0; $i < 12; $i++) {
            if ($month[$i] == date('F', mktime(0, 0, 0, $i + 1, 1))) {
                if (isset($teacher["$month[$i]"])) {
                    $tMonth[$i] = $teacher["$month[$i]"];
                } else {
                    $tMonth[$i] = 0;
                }

                if (isset($student["$month[$i]"])) {
                    $sMonth[$i] = $student["$month[$i]"];
                } else {
                    $sMonth[$i] = 0;
                }
            }
        }

        $totalStudent = Student::all()->count();
        $totalTeacher = Teacher::all()->count();
        $pendingSPForm = Spform::where('status', 0)->whereMonth('class_date', date("n"))->count();
        $spFormSubmitted = Spform::whereMonth('class_date', date("n"))->count();


        return view('home', compact('tMonth', 'sMonth', 'pendingSPForm', 'totalStudent', 'totalTeacher', 'spFormSubmitted'));
    }

    public function profile()
    {
        $payrolls = Payroll::where('employee_ic', session()->get('ic'))->get();
        $employee = Employee::find(session()->get('id'));
        return view('profile', compact('employee', 'payrolls'));
    }

    public function setting()
    {
        $employee = Employee::where('id', session()->get('id'))->get();
        return view('setting', compact('employee'));
    }

    public function updateProfile(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required'
        ]);

        Employee::where('id', $employee->id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'remarks' => $request->remarks
        ]);
        return redirect("/setting")->with('status', 'Details changed!')->with('status-tab', 'profile');
    }

    public function updatePassword(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required',
            'retypePassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect("/setting")->with('status-error', 'Password not same!')->with('status-tab', 'password')->withErrors($validator);
        }

        $oldpassword = Employee::select('pword')->where('id', $employee->id)->get();

        if (Hash::check($request->currentPassword, $oldpassword[0]['pword'])) {
            Employee::where('id', $employee->id)->update([
                'pword' => Hash::make($request->newPassword),
            ]);
            return redirect("/setting")->with('status', 'Password changed!')->with('status-tab', 'password');
        } else {
            return redirect("/setting")->with('status-error', 'Password incorrect!')->with('status-tab', 'password');
        }
    }

    public function user_payroll($payroll, $employee, $type)
    {
        $payroll = Payroll::find($payroll);
        $employee = Employee::find($employee);
        $pdf = PDF::loadView('print_download_payroll', compact('payroll', 'employee'))->setPaper('a4', 'potrait');

        if ($type == "print") {
            return $pdf->stream('ABATA_PR - ' . $payroll->reference_no . '.pdf', array("Attachment" => false));
            //print
        } elseif ($type == "download") {
            return $pdf->download('ABATA_PR - ' . $payroll->reference_no . '.pdf', array("Attachment" => false));
            //download
        } else {
            return view('user_payroll', compact('payroll', 'employee'));
            //view
        }
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = session()->get('ic') . '.' . $request->image->extension();

        // GET IMAGE NAME FROM DATABASE
        $dbImage = Employee::where('ic', session()->get('ic'))->first();

        // CHECK IF IMAGE IS NOT DEFAULT
        if ($dbImage->image != 'default.jpg') {

            $file = FILE::exists(public_path('images/profile_picture/employee/' . $dbImage->image));

            //IF NOT DEFAULT AND EXISTED, UNLINK FIRST THEN UPLOAD NEW IMAGE
            if ($file) {
                unlink(public_path('images/profile_picture/employee/' . $dbImage->image));
            }
        }


        $request->image->move(public_path('images/profile_picture/employee'), $newImageName);

        Employee::where('id', session()->get('id'))->update([
            'image' => $newImageName
        ]);

        $request->session()->put('image', $newImageName);

        return redirect("/setting")->with('status', 'Profile picture changed!');
    }

    public function removeImage($id, $image)
    {

        Employee::where('id', $id)->update([
            'image' => 'default.jpg'
        ]);

        unlink(public_path('images/profile_picture/employee/' . $image));

        session()->put('image', 'default.jpg');

        return redirect("/setting")->with('status', 'Profile picture changed!');
    }

    public function test()
    {
        return view('test');
    }
}
