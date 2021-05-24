<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Student;
use Illuminate\Http\Request;
use Spatie\Geocoder\Geocoder;
use Illuminate\Support\Facades\Hash;

class ManageTeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ManageTeacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBank');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        $banks = json_decode($result);
        return view('ManageTeacher.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));

        $request->validate([
            'name' => 'required',
            'ic' => 'required|unique:teachers,ic|size:12',
            'phonenumber' => 'required',
            'email' => 'required',
            'houseNo' => 'required',
            'streetName' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required'
        ]);

        $address = $request->houseNo . ', ' . $request->streetName . ', ' . $request->zipcode . ' ' . $request->city . ' ' . $request->state;

        $latlng = $geocoder->getCoordinatesForAddress($address);

        $lat = $latlng['lat'];
        $lng = $latlng['lng'];

        Teacher::create([
            'name' => $request->name,
            'ic' => $request->ic,
            'pword' => Hash::make('teacher123'),
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'houseNo' => $request->houseNo,
            'streetName' => $request->streetName,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'latitude' => $lat,
            'longitude' => $lng,
            'bank_name' => $request->bank_name,
            'bank_acc_no' => $request->bank_acc_no,
            'image' => 'default.jpg'
        ]);

        return redirect('/teacher')->with('status', 'Teacher added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $student = Student::where('teacher', $teacher->ic)->get();
        return view('ManageTeacher.show', compact('teacher', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBank');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        $banks = json_decode($result);
        return view('ManageTeacher.edit', compact('teacher', 'banks'));
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
            'state' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required'
        ]);

        Teacher::where('id', $teacher->id)->update([
            'name' => $request->name,
            'ic' => $request->ic,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'houseNo' => $request->houseNo,
            'streetName' => $request->streetName,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'bank_name' => $request->bank_name,
            'bank_acc_no' => $request->bank_acc_no
        ]);

        return redirect("/teacher/$teacher->id")->with('status', 'Details updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect('/teacher')->with('status', 'Teacher deleted!');
    }
}
