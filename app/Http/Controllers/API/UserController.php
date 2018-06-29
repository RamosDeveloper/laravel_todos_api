<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use \App\User;
use \App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);        

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );

        if( $user->save() ) {
            return response()->json(["response" => true,"User" => $user]);
        }
        return response()->json(["response" => false,"User" => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
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
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]); 

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if( $user->save() ) {
            return response()->json(["response" => true,"User" => $user]);
        }
        return response()->json(["response" => false,"User" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if( $user->delete() ) {
            return response()->json(["response" => true,"User" => $user]);
        }
        return response()->json(["response" => false,"User" => $user]);
    }
}
