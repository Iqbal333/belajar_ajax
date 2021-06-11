<?php

namespace App\Http\Controllers;

use App\cr;
use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Success Fetch User',
            'results' => $student
        ], 200);
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
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'email' => 'required|unique:students,email'
        ]);

        try {

            $student = new Student;

            $student->namej = $request->name;
            $student->phone_number = $request->phone_number;
            $student->email = $request->email;

            $student->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => 'Failed Add Data'
            ], 500);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Success Add Data',
            'results' => $student
        ], 200);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
