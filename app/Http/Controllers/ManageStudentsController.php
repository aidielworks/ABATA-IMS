<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Geocoder\Geocoder;
use Illuminate\Support\Facades\Hash;

class ManageStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('ManageStudent.index');
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

        return view('ManageStudent.create', compact('banks'));
    }


    /**
     * Mix and match student and nearby teacher within ?KM radius
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if (!isset($request->teacher)) {
        //     echo 'teacher not define';
        // }
        // die;
        $request->validate([
            'name' => 'required',
            'ic' => 'required|unique:students,ic|size:12',
            'phonenumber' => 'required',
            'email' => 'required',
            'houseNo' => 'required',
            'streetName' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required',
            'lat' => 'required'
        ]);


        if ($request->teacher != null) {
            Student::create([
                'name' => $request->name,
                'ic' => $request->ic,
                'pword' => Hash::make('12345'),
                'phonenumber' => $request->phonenumber,
                'email' => $request->email,
                'houseNo' => $request->houseNo,
                'streetName' => $request->streetName,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'teacher' => $request->teacher,
                'bank_name' => $request->bank_name,
                'bank_acc_no' => $request->bank_acc_no,
                'image' => 'default.jpg'
            ]);
        } else {
            Student::create([
                'name' => $request->name,
                'ic' => $request->ic,
                'pword' => Hash::make('12345'),
                'phonenumber' => $request->phonenumber,
                'email' => $request->email,
                'houseNo' => $request->houseNo,
                'streetName' => $request->streetName,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'bank_name' => $request->bank_name,
                'bank_acc_no' => $request->bank_acc_no,
                'image' => 'default.jpg'
            ]);
        }



        return redirect('/student')->with('status', 'Student added!');
    }

    public function findTeacher(Request $request)
    {
        $output = "";

        //COnvert address to coordinate
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));

        $address = $request->houseNo . ', ' . $request->streetName . ', ' . $request->zipcode . ' ' . $request->city . ' ' . $request->state;

        $latlng = $geocoder->getCoordinatesForAddress($address);

        $lat = $latlng['lat'];
        $lng = $latlng['lng'];
        //COnvert address to coordinate

        $teacher = Teacher::select("*", DB::raw("6371 * acos(cos(radians(" . $lat . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $lng . "))
                                + sin(radians(" . $lat . ")) * sin(radians(latitude))) AS distance"))
            ->having('distance', '<', 10)
            ->orderBy('distance', 'asc')
            ->get();


        if ($teacher != "") {
            foreach ($teacher as $teach) {
                $distance = round($teach->distance * 6371, 2);
                $output .= "
                    <div class='row align-items-center'>
                        <div class='col'>
                            <b>$teach->name</b>
                            <br>$teach->houseNo, $teach->streetName, $teach->city, $teach->zipcode, $teach->state
                            </br>
                            Distance: $distance KM
                        </div>
                        <div class='col-2 text-right'>
                            <input type='radio' name='teacher' value='$teach->ic'>
                        </div>
                    </div>
                    <hr>
                ";
            }
        } else {
            $output .= "
                <div class='row align-items-center'>
                    <div class='alert alert-danger' role='alert'>
                    Not teacher nearby
                    </div>
                </div>
            ";
        }

        return response()->json(['success' => $output, 'lat' => $lat, 'lng' => $lng]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $teacher = Teacher::where('ic', $student->teacher)->get();

        return view('ManageStudent.show', compact('student', 'teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBank');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        $banks = json_decode($result);
        return view('ManageStudent.edit', compact('student', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if ($request->has('assign_teacher')) {
            $request->validate([
                'teacher' => 'required'
            ]);

            Student::where('id', $student->id)->update([
                'teacher' => $request->teacher
            ]);

            return redirect("/student/$student->id")->with('status', 'Teacher assigned');
        } else {
            $request->validate([
                'name' => 'required',
                'ic' => 'required|size:12',
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

            Student::where('id', $student->id)->update([
                'name' => $request->name,
                'ic' => $request->ic,
                'pword' => Hash::make('12345'),
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

            return redirect("/student/$student->id")->with('status', 'Student updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('/student')->with('status', 'Student deleted!');
    }
}
