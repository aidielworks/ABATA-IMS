<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Student;
use App\Spform;
use App\Teacher;
use App\Receipt;
use App\Receipt_Item;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('ic', session()->get('ic'))->first();
        return view('Student.index', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
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

        Student::where('id', $student->id)->update([
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
        return redirect('/students/setting')->with('status', 'Profile updated!');
    }

    public function books()
    {
        return view('Student.books');
    }

    public function spformIndex()
    {
        $spformsPending = Spform::where('studentIC', session()->get('ic'))
            ->where('status', 0)
            ->orderBy('class_date', 'ASC')
            ->get();
        $spformsApproved = Spform::where('studentIC', session()->get('ic'))
            ->where('status', 1)
            ->orderBy('class_date', 'ASC')
            ->get();
        $spformsDeclined = Spform::where('studentIC', session()->get('ic'))
            ->where('status', 2)
            ->orderBy('class_date', 'ASC')
            ->get();
        return view('Student.spformIndex', compact('spformsPending', 'spformsApproved', 'spformsDeclined'));
    }

    public function receiptIndex()
    {
        $receipts = Receipt::where('receipt_receiver_ic', session()->get('ic'))->get();
        return view('Student.receiptIndex', compact('receipts'));
    }

    public function spfShow(Spform $spform)
    {
        return view('Student.spfShow', compact('spform'));
    }

    public function receipt(Receipt $receipt)
    {
        $receipt_items = Receipt_Item::where('receipt_no', $receipt->receipt_no)->get();
        return view('Student.receiptShow', compact('receipt', 'receipt_items'));
    }

    public function setting()
    {
        $student = Student::where('ic', session()->get('ic'))->get();
        return view('Student.setting', compact('student'));
    }

    public function updatePassword(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required',
            'retypePassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return redirect("/students/setting")->with('status-error', 'Password not same!')->with('status-tab', 'password')->withErrors($validator);
        }

        $oldpassword = Student::select('pword')->where('id', $student->id)->get();

        if (Hash::check($request->currentPassword, $oldpassword[0]['pword'])) {
            Student::where('id', $student->id)->update([
                'pword' => Hash::make($request->newPassword),
            ]);
            return redirect("/students/setting")->with('status', 'Password changed!')->with('status-tab', 'password');
        } else {
            return redirect("/students/setting")->with('status-error', 'Password incorrect!')->with('status-tab', 'password');
        }
    }


    //UPLOAD IMAGE
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = session()->get('ic') . '.' . $request->image->extension();

        // GET IMAGE NAME FROM DATABASE
        $dbImage = Student::where('ic', session()->get('ic'))->first();

        // CHECK IF IMAGE IS NOT DEFAULT
        if ($dbImage->image != 'default.jpg') {

            $file = File::exists(public_path('images/profile_picture/student/' . $dbImage->image));

            //IF NOT DEFAULT AND EXISTED, UNLINK FIRST THEN UPLOAD NEW IMAGE
            if ($file) {
                unlink(public_path('images/profile_picture/student/' . $dbImage->image));
            }
        }

        $request->image->move(public_path('images/profile_picture/student/'), $newImageName);

        Student::where('id', session()->get('id'))->update([
            'image' => $newImageName
        ]);

        $request->session()->put('image', $newImageName);

        return redirect("students/setting")->with('status', 'Profile picture changed!');
    }

    //REMOVE TO DEFAULT
    public function removeImage($id, $image)
    {

        Student::where('id', $id)->update([
            'image' => 'default.jpg'
        ]);

        unlink(public_path('images/profile_picture/student/' . $image));

        session()->put('image', 'default.jpg');

        return redirect("students/setting")->with('status', 'Profile picture changed!');
    }
}
