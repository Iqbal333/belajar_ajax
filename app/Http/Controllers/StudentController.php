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

            $student->nim = $request->nim;
            $student->name = $request->name;
            $student->date_of_birth = $request->date_of_birth;
            $student->prodi = $request->prodi;
            $student->faculty = $request->faculty;
            $student->phone_number = $request->phone_number;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->email = $request->email;

            $student->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => 'Failed Add Data',
                 $e->getMessage()
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
    public function show($id)
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Success Fetch Spesific Data',
            'result' => $student
        ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Success Fetch Edit Data',
            'result' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|max:30'
        ]);

        try {
            $student->nim = $request->nim;
            $student->name = $request->name;
            $student->date_of_birth = $request->date_of_birth;
            $student->prodi = $request->prodi;
            $student->prodi = $request->prodi;
            $student->faculty = $request->faculty;
            $student->phone_number = $request->phone_number;
            $student->religion = $request->religion;
            $student->gender = $request->gender;
            $student->address = $request->address;
            $student->email = $request->email;

            $student->update();

        } catch(\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Failed Update Data',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Success Update Data',
            'result' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        try {
            $student->delete();
        } catch(\Exception $e) {

            return response()->json([
            'status'  => true,
            'message' => 'Failed delete Data',
            'error' => $e->getMessage()
            ], 500);
        }


        return response()->json([
            'status' => true,
            'message' => 'Success Delete Data',
            'result' => $student
        ], 200);
    }
}
