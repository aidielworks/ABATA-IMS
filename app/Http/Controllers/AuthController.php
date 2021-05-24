<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Teacher;
use App\Student;
use App\Authentication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            'radio' =>  'required',
            'ic' => 'required|size:12',
            'password' => 'required'
        ]);

        if ($request['radio'] == 1) {

            $user = Employee::where('ic', $request['ic'])->first();
            if ($user) {
                if (Hash::check($request->password, $user['pword'])) {
                    $request->session()->put('name', $user['name']);
                    $request->session()->put('ic', $user['ic']);
                    $request->session()->put('id', $user['id']);
                    $request->session()->put('role', $user['role']);
                    $request->session()->put('image', $user['image']);
                    $request->session()->put('userType', 'employee');
                    $lastLoginID = Authentication::create([
                        'name' => $user['name'],
                        'ic' => $user['ic'],
                        'type' => 'admin',
                        'login' => date('Y-m-d H:i:s')
                    ]);

                    $lastInsertedID = $lastLoginID->id;
                    $request->session()->put('lastID', $lastInsertedID);

                    return redirect('/home')->with('login', 'Welcome, ' . session('name'));
                } else {
                    return redirect("/")->with('status', 'Password incorrect!');
                }
            } else {
                return redirect("/")->with('status', 'Employee not found!');
            }
        } else if ($request['radio'] == 2) {

            //TEACHER----------------------------
            $user = Teacher::where('ic', $request['ic'])->first();
            if ($user) {
                if (Hash::check($request->password, $user['pword'])) {
                    $request->session()->put('name', $user['name']);
                    $request->session()->put('ic', $user['ic']);
                    $request->session()->put('id', $user['id']);
                    $request->session()->put('image', $user['image']);
                    $request->session()->put('userType', 'teacher');
                    $request->session()->put('registered', date_format($user['created_at'], "d-M-Y"));

                    $lastLoginID = Authentication::create([
                        'name' => $user['name'],
                        'ic' => $user['ic'],
                        'type' => 'teacher',
                        'login' => date('Y-m-d H:i:s')
                    ]);

                    $lastInsertedID = $lastLoginID->id;
                    $request->session()->put('lastID', $lastInsertedID);

                    return redirect('/teachers')->with('status-login', 'Welcome, ' . session('name'));
                } else {
                    return redirect("/")->with('status', 'Password incorrect!');
                }
            } else {
                return redirect("/")->with('status', 'Teacher not found!');
            }
        } else {
            //STUDENT----------------------------
            $user = Student::where('ic', $request['ic'])->first();
            if ($user) {
                if (Hash::check($request->password, $user['pword'])) {
                    $request->session()->put('name', $user['name']);
                    $request->session()->put('ic', $user['ic']);
                    $request->session()->put('id', $user['id']);
                    $request->session()->put('image', $user['image']);
                    $request->session()->put('userType', 'student');
                    $request->session()->put('registered', date_format($user['created_at'], "d-M-Y"));

                    $lastLoginID = Authentication::create([
                        'name' => $user['name'],
                        'ic' => $user['ic'],
                        'type' => 'student',
                        'login' => date('Y-m-d H:i:s')
                    ]);

                    $lastInsertedID = $lastLoginID->id;
                    $request->session()->put('lastID', $lastInsertedID);

                    return redirect('/students')->with('status-login', 'Welcome, ' . session('name'));
                } else {
                    return redirect("/")->with('status', 'Password incorrect!');
                }
            } else {
                return redirect("/")->with('status', 'Student not found!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy(Request $request)
    {
        Authentication::where('id', session()->get('lastID'))->update([
            'logout' => date('Y-m-d H:i:s')
        ]);

        Session::flush();
        $request->session()->flush();

        return redirect("/");
    }
}
