<?php

namespace App\Http\Controllers\Api;

use App\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('priority', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'todos' => $todos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->get('input');
        $todo = new Todo();
        $todo->title = $input['title'];
        $todo->description = $input['description'];
        $todo->priority = $input['priority'];
        $todo->save();

        return response()->json([
            'todo' => $todo,
        ]);
    }

    public function complete(int $id)
    {
        $todo = Todo::find($id);
        logger($todo);
        if ($todo->completed_at) {
            $todo->completed_at = null;
        } else {
            $todo->completed_at = Carbon::now();
        }
        $todo->save();

        return response()->json([
            'todo' => $todo,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
