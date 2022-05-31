<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Student\Student;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;





class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(4);
        return (request()->expectsJson()) ? response()->json($students, 200) : response()->json($students, 200) ;
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

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        $student = new Student();
        $student->regno = $request->regno;
        $student->accessno = $request->accessno;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->dob = $request->dob;
        $student->photo = ($request->hasFile('photo')) ? 'storage/'.request()->photo->store(config('pagman.media_dir', 'media'), 'public') : null;
        $student->sex = $request->sex;
        $student->religion = $request->religion;
        $student->marital_status = $request->marital_status;
        $student->nationality = $request->nationality;
        $student->diceased = ($request->has('diceased')) ? $request->deceased : '0';
        $student->phone_one = $request->phone_one;
        $student->phone_two = $request->phone_two;
        $student->email = $request->email;
        $student->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'Student added successfully', 'student' => $student], 200) : 'view';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::where('id', $id)->firstOrFail();
        return  (request()->expectsJson()) ? response()->json($student, 200) : 'view';
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
            'regno' => 'required', Rule::unique('students')->ignore($id),
            'accessno' => 'nullable',  Rule::unique('students')->ignore($id),
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'other_name' => 'nullable|min:3',
            'dob' => 'required|date',
            'photo' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'sex' => 'required',
            'religion' => 'nullable',
            'marital_status' => 'nullable',
            'nationlity' => 'nullable',
            'email' => 'nullable|email'
        ]);

        $student = Student::findOrFail($id);

        $student->regno = $request->regno;
        $student->accessno = $request->accessno;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->other_name = $request->other_name;
        $student->dob = $request->dob;
        $student->photo = ($request->hasFile('photo')) ? 'storage/'.request()->photo->store(config('pagman.media_dir', 'media'), 'public') : null;
        $student->sex = $request->sex;
        $student->religion = $request->religion;
        $student->marital_status = $request->marital_status;
        $student->nationality = $request->nationality;
        $student->diceased = ($request->has('diceased')) ? $request->deceased : '0';
        $student->phone_one = $request->phone_one;
        $student->phone_two = $request->phone_two;
        $student->email = $request->email;

        $student->save();

        return ($request->expectsJson()) ? response()->json(['message' => 'Student updated successfully', 'student' => $student], 200) : 'view';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::destroy($id);
        return (request()->expectsJson()) ? response()->json(['message' => 'Student deleted successfully'], 200) : 'view';
    }

}
