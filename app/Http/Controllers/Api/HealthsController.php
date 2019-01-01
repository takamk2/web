<?php

namespace App\Http\Controllers\Api;

use App\Health;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healths = Health::where('user_id', 1)->orderBy('assay_date', 'desc')->get();
        return response()->json([
            'healths' => $healths,
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
        $health = Health::where('assay_date', $input['assay_date'])->first() ?? new Health();
        $health->user_id = $input['user_id'];
        $health->assay_date = $input['assay_date'];
        $health->weight = $input['weight'];
        $health->body_fat = $input['body_fat'];
        $health->bmi = $input['bmi'];
        $health->save();

        return response()->json([
            'health' => $health,
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
