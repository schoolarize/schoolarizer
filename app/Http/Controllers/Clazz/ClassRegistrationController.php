<?php

namespace App\Http\Controllers\Clazz;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Clazz\ClassRegistration;



class ClassRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Clazz::get();
        return (request()->expectsJson()) ? response()->json($classes, 200) : 'view';
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
       $data = $request->validate([
           'student_id'=> 'required|exists:students,id',
           'session_id'=> 'required|exists:school_sessions,id',
           'class_id'=> 'required|exists:classes,id',
           'registration_date' => 'nullable|date'
       ]);

       $check = ClassRegistration::where('session_id', $request->session_id)->where('student_id', $request->student_id)->first();
       if($check){
           abort(422, 'This student is already registered for this class and session');
       }
       

        $registration = new ClassRegistration();
        $registration->student_id = $request->student_id;
        $registration->session_id = $request->session_id;
        $registration->class_id = $request->class_id;
        $registration->registration_date = ($request->registration_date) ? $request->registration_date : toDay();
        $registration->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'Registration Permformed successfully', 'registration' => $registration], 200) : 'view';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clazz = Clazz::findOrFail($id);
        return  (request()->expectsJson()) ? response()->json($clazz, 200) : 'view';
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
        $data = $request->validate([
            'name' => 'required|min:3|max:20', Rule::unique('classes')->ignore($id),
        ]);
        $clazz = Clazz::findOrFail($id);

        $clazz->name = $request->name;
        $clazz->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'clazz updated successfully', 'clazz' => $clazz], 200) : 'view';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clazz = Clazz::destroy($id);
        return (request()->expectsJson()) ? response()->json(['message' => 'Class deleted successfully'], 200) : 'view';
    }

}
