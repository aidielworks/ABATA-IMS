<?php

namespace App\Http\Controllers;

use App\Spform;
use App\Teacher;
use App\Student;
use App\TeacherPayroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submitted_spform = Spform::where('teacherIC', session()->get('ic'))->whereMonth('class_date', 5)->count();
        $approved_spform = Spform::where('teacherIC', session()->get('ic'))->where('status', 1)->whereMonth('class_date', 5)->count();
        $pending_spform  = Spform::where('teacherIC', session()->get('ic'))->where('status', 0)->whereMonth('class_date', 5)->count();
        $declined_spform = Spform::where('teacherIC', session()->get('ic'))->where('status', 2)->whereMonth('class_date', 5)->count();

        $student = Student::where('teacher', session()->get('ic'))->get();
        return view('Teacher.index', compact('student', 'submitted_spform', 'approved_spform', 'pending_spform', 'declined_spform'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payrollHistoryIndex()
    {
        $payrolls = TeacherPayroll::where('teacher_ic', session()->get('ic'))->get();
        return view('Teacher.payrollHistory', compact('payrolls'));
    }

    public function payrollHistoryShow($id)
    {
        $payrolls = TeacherPayroll::find($id);
        return view('Teacher.payrollHistoryShow', compact('payrolls'));
    }


    public function showProfile()
    {
        $teacher = Teacher::where('ic', session()->get('ic'))->get();
        return view('Teacher.profile', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'ic' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'houseNo' => 'required',
            'streetName' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required'
        ]);

        Teacher::where('id', $teacher->id)->update([
            'name' => $request->name,
            'ic' => $request->ic,
            'pword' => 'teacher123',
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'houseNo' => $request->houseNo,
            'streetName' => $request->streetName,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state
        ]);

        return redirect("/teachers/setting")->with('status', 'Teacher updated!');
    }


    public function setting()
    {
        $teacher = Teacher::where('ic', session()->get('ic'))->get();
        return view('Teacher.setting', compact('teacher'));
    }

    public function updatePassword(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required',
            'retypePassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect("/teachers/setting")->with('status-error', 'Password not same!')->with('status-tab', 'password')->withErrors($validator);
        }

        $oldpassword = Teacher::select('pword')->where('id', $student->id)->get();

        if (Hash::check($request->currentPassword, $oldpassword[0]['pword'])) {
            Student::where('id', $student->id)->update([
                'pword' => Hash::make($request->newPassword),
            ]);
            return redirect("/teachers/setting")->with('status', 'Password changed!')->with('status-tab', 'password');
        } else {
            return redirect("/teachers/setting")->with('status-error', 'Password incorrect!')->with('status-tab', 'password');
        }
    }

    public function notification(Request $request)
    {
        $output = "";

        $spform = Spform::where("teacherIC", $request->ic)
            ->where('status', 2)
            ->get();

        $i = 1;

        foreach ($spform as $key => $form) {
            if (sizeof($spform) < 5) {
                $title = substr($form->learning_topic, 0, 10) . "...";
                $output .= "<a class='dropdown-item waves-effect waves-light' href='/teachers/spform/$form->id'><b>$title</b> - <span>$form->class_date</span><p>$form->review</p></a>";
                while ($key == sizeof($spform)) {
                    $output .= "<div class='dropdown-divider'></div>";
                }
            } else {
                $title = substr($form->learning_topic, 0, 10) . "...";
                $output .= "<a class='dropdown-item waves-effect waves-light' href='/teachers/spform/$form->id'><b>$title</b> - <span>$form->class_date</span><p>$form->review</p></a>";
                while ($key == sizeof($spform)) {
                    $output .= "<div class='dropdown-divider'></div>";
                }
                if ($i++ == 3) break;
            }
        }

        $output .= "<div class='dropdown-divider'></div>";

        $count = sizeof($spform);

        return response()->json(['output' => $output, 'count' => $count]);
    }


    //UPLOAD IMAGE
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = session()->get('ic') . '.' . $request->image->extension();

        // GET IMAGE NAME FROM DATABASE
        $dbImage = Teacher::where('ic', session()->get('ic'))->first();

        // CHECK IF IMAGE IS NOT DEFAULT
        if ($dbImage->image != 'default.jpg') {

            $file = File::exists(public_path('images/profile_picture/teacher/' . $dbImage->image));

            //IF NOT DEFAULT AND EXISTED, UNLINK FIRST THEN UPLOAD NEW IMAGE
            if ($file) {
                unlink(public_path('images/profile_picture/teacher/' . $dbImage->image));
            }
        }

        $request->image->move(public_path('images/profile_picture/teacher/'), $newImageName);

        Teacher::where('id', session()->get('id'))->update([
            'image' => $newImageName
        ]);

        $request->session()->put('image', $newImageName);

        return redirect("teachers/setting")->with('status', 'Profile picture changed!');
    }

    //REMOVE TO DEFAULT
    public function removeImage($id, $image)
    {

        Teacher::where('id', $id)->update([
            'image' => 'default.jpg'
        ]);

        unlink(public_path('images/profile_picture/teacher/' . $image));

        session()->put('image', 'default.jpg');

        return redirect("teachers/setting")->with('status', 'Profile picture changed!');
    }
}
