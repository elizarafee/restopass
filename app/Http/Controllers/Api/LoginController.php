<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginRequest;
use App\Login;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Login::all();
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
    public function store(StoreLoginRequest $request)
    {
        $login = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $store = Login::create($login);

        if (!$store) {
            return response()->json(['status' => false, 'message' => 'Failed to login. Please try again.'], 500);
        }

        // Creating a token without scopes...
        $token = $store->createToken('Token Name')->accessToken;

        return response()->json(['status' => true, 'message' => 'Successfully logged in and generated an access token.', 'user' => $store, 'access_token' => $token], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['status' => true, 'data' => Login::find($id)]);
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
        $data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            );
        $update = Login::where('id', $id)->update($data);
        
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Loggin in details successfully updated.', 'data' => Login::find($id)], 200);
        }
        
        return response()->json(['status' => false, 'message' => 'Failed to update loggin in details. Please try again.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Login::find($id);
        $delete = $person->delete();

        if ($delete) {
            return response()->json(['status' => true, 'message' => 'This profile is deleted.', 'data' => 'Datas are not available'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Failed to delete profile. Please try again.'], 500);
    }
}
