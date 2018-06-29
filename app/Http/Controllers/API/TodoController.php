<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Todo;
use \App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection(Todo::all());
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
            'task' => 'required',
            'user_id' => 'required'
        ]); 

        $todo = new Todo;

        $todo->task = $request->task;
        $todo->is_done = 0;
        $todo->user_id = $request->user_id;

        if( $todo->save() ) {
            return response()->json(["response" => true,"Todo" => $todo]);
        }
        return response()->json(["response" => false,"Todo" => $todo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TodoResource(Todo::find($id));
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
            'task' => 'required',
            'is_done' => 'required'
        ]);

        $todo = Todo::find($id);

        $todo->task = $request->task;
        $todo->is_done = $request->is_done;

        if( $todo->save() ) {
            return response()->json(["response" => true,"Todo" => $todo]);
        }
        return response()->json(["response" => false,"Todo" => $todo]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if( $todo->delete() ) {
            return response()->json(["response" => true,"Todo" => $todo]);
        }
        return response()->json(["response" => false,"Todo" => $todo]);         
    }
}
