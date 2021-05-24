<?php

namespace App\Http\Controllers;

use App\Spform;
use App\Student;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpformController extends Controller
{

    //ATTENTION!
    //THIS CONTROLLER IS USE BY TEACHER TO MANAGE SP FORMS
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Teacher.SPForm.spformindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        $students = Student::where('teacher', session()->get('ic'))->get();
        return view('Teacher.SPForm.spformcreate', compact('students', 'topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_Spforms = Spform::where('studentIC', $request->studentIC)
            ->where('teacherIC', session()->get('ic'))
            ->whereMonth('class_date', date('n', strtotime($request->datepicker)))
            ->count();

        if ($get_Spforms == 4) {
            return redirect("/teachers/spform/create")->with('status-danger', 'All SP Form already submitted!');
        }

        $request->validate([
            'studentIC' => 'required',
            'datepicker' => 'required',
            'topic' => 'required',
            'review' => 'required'
        ]);

        Spform::create([
            'teacherIC' => session()->get('ic'),
            'studentIC' => $request->studentIC,
            'class_date' => date('Y-m-d', strtotime($request->datepicker)),
            'learning_topic' => implode(",", $request->topic),
            'review' => nl2br($request->review),
            'status' => 0
        ]);

        return redirect("/teachers/spform/create")->with('status', 'SP Form inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spform  $spform
     * @return \Illuminate\Http\Response
     */
    public function show(Spform $spform)
    {

        $topicsinDB = explode(",", $spform->learning_topic);
        $topics = Topic::all();
        return view('Teacher.SPForm.spformShow', compact('spform', 'topics', 'topicsinDB'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spform  $spform
     * @return \Illuminate\Http\Response
     */
    public function edit(Spform $spform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spform  $spform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spform $spform)
    {
        $request->validate([
            'studentIC' => 'required',
            'datepicker' => 'required',
            'learning_topic' => 'required',
            'review' => 'required'
        ]);

        //check if the spform is declined or not
        $spFormDeclined = Spform::where('id', $spform->id)->get();

        if ($spFormDeclined[0]['status'] == 2) {
            //check if the post topic and review is the same thing
            if ($spFormDeclined[0]['learning_topic'] == implode(",", $request->learning_topic) && $spFormDeclined[0]['review'] == $request->review) {

                return redirect("/teachers/spform/$spform->id")->with('status-danger', 'SP Form error! No changes have been made');
            } else {

                Spform::where('id', $spform->id)->update([
                    'class_date' => date('Y-m-d', strtotime($request->datepicker)),
                    'learning_topic' => implode(",", $request->learning_topic),
                    'review' => nl2br($request->review),
                    'status' => 0,
                    'remarks' => null
                ]);
            }
        } else {

            Spform::where('id', $spform->id)->update([
                'class_date' => date('Y-m-d', strtotime($request->datepicker)),
                'learning_topic' => implode(",", $request->learning_topic),
                'review' => nl2br($request->review),
                'remarks' => null
            ]);
        }

        return redirect("/teachers/spform/$spform->id")->with('status', 'SP Form updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spform  $spform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spform $spform)
    {
        //
    }

    public function notification()
    {
        $spform = Spform::where('status', 0)->get();
        return response()->json(sizeof($spform));
    }


    //ATTENTION!
    //THIS CONTROLLER IS USE BY EMPLOYEE TO MANAGE SP FORMS
    public function indexSpForm()
    {
        $spformsPending = DB::table('spforms')
            ->join('students', 'students.ic', '=', 'spforms.studentIC')
            ->join('teachers', 'teachers.ic', '=', 'spforms.teacherIC')
            ->select('teachers.name as teacherName', 'students.name as studentName', 'spforms.*')
            ->where('spforms.status', 0)
            ->get();

        $spforms = DB::table('spforms')
            ->join('students', 'students.ic', '=', 'spforms.studentIC')
            ->join('teachers', 'teachers.ic', '=', 'spforms.teacherIC')
            ->select('teachers.name as teacherName', 'students.name as studentName', 'spforms.*')
            ->where('spforms.status', '<>', 0)
            ->get();

        return view('Spform.spFormIndex', compact('spforms', 'spformsPending'));
    }

    public function showSpForm(Spform $spform)
    {
        $studForm = DB::table('spforms')
            ->join('students', 'students.ic', '=', 'spforms.studentIC')
            ->join('teachers', 'teachers.ic', '=', 'spforms.teacherIC')
            ->select('teachers.name as teacherName', 'students.name as studentName', 'spforms.*')
            ->where('spforms.id', $spform->id)
            ->get();
        return view('Spform.spFormShow', compact('studForm'));
    }

    //Approved or declined SPFORM
    public function updateSpForm(Request $request, Spform $spform)
    {

        if ($request->approve == 1) {
            Spform::where('id', $spform->id)->update([
                'status' => 1
            ]);

            return redirect('/spform')->with('status', 'SP Form Approved!');
        } else {
            $request->validate([
                'remarks' => 'required'
            ]);
            Spform::where('id', $spform->id)->update([
                'status' => 2,
                'remarks' => $request->remarks
            ]);
            return redirect('/spform')->with('status-error', 'SP Form Declined!');
        }
    }
}
