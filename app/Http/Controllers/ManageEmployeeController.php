<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Employee;
use App\Spform;
use App\JobType;

class ManageEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Employee.index');
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
        $jobs = JobType::all();
        return view('Employee.create', compact('jobs', 'banks'));
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
            'name' => 'required',
            'ic' => 'required|unique:employees,ic|size:12',
            'position' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required'
        ]);

        Employee::create([
            'name' => $request->name,
            'ic' => $request->ic,
            'pword' => Hash::make('admin123'),
            'role' => 0,
            'position' => $request->position,
            'phonenumber' => $request->phonenumber,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'state' => $request->state,
            'bank_name' => $request->bank_name,
            'bank_acc_no' => $request->bank_acc_no,
            'image' => 'default.jpg'
        ]);


        return redirect('/employee')->with('status', 'Employee added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('Employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBank');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        $banks = json_decode($result);
        return view('Employee.edit', compact('employee', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'state' => 'required',
            'bank_name' => 'required',
            'bank_acc_no' => 'required'
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
            'bank_name' => $request->bank_name,
            'bank_acc_no' => $request->bank_acc_no
        ]);

        return redirect("/employee/$employee->id")->with('status', 'Employee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/employee')->with('status', 'Employee deleted!');
    }
}
