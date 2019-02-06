<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StudentCollection(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(Request::all(),[ 
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'joined_year' => 'required|date_format:Y',
            'gender' => 'required|max:1',
            'teacher_id' => 'required|max:3',
            'class_room_id' => 'required|max:3'
        ]);

        if($validation->fails()){
            $errors = $validation->errors();

            return response()
            ->json(['errors'=>$errors]);
        } else {
            $student = Student::create($request->all());

            return (new StudentResource($student))
                ->response()
                ->setStatusCode(201);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validation = Validator::make(Request::all(),[ 
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'joined_year' => 'required|date_format:Y',
            'gender' => 'required|max:1',
            'teacher_id' => 'required|max:3',
            'class_room_id' => 'required|max:3'
        ]);

        if($validation->fails()){
            $errors = $validation->errors();

            return response()
            ->json(['errors'=>$errors]);
        } else {
            $student->update($request->all());

            return (new StudentResource($student))
                ->response()
                ->setStatusCode(201);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
