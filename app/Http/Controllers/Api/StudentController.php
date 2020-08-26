<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
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
        return response()->json(['status' => true, 'data' => Student::all()]);
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
        $Student = [
            'name' => $request->get('name'),
            'age' => $request->get('age'),
            'city' => $request->get('city'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $store = Student::create($Student);

        if ($store) {
            return response()->json(['status' => true, 'message' => 'Student successfully created.', 'data' => $store], 201);
        }

        return response()->json(['status' => false, 'message' => 'Failed to store Student. Please try again.'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Student::find($id)]);
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
    public function update(StoreStudentRequest $request, $id)
    {
        $data = array(
            'name' => $request->get('name'),
            'age' => $request->get('age'),
            'city' => $request->get('city'),
            );
        $update = Student::where('id', $id)->update($data);
        
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Profile successfully updated.', 'data' => Student::find($id)], 200);
        }
        
        return response()->json(['status' => false, 'message' => 'Failed to update profile. Please try again.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Student::find($id);
        $delete = $person->delete();

        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Profile successfully deleted.', 'data' => 'Datas are not available'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Failed to delete profile. Please try again.'], 500);

    }

}
