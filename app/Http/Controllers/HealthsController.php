<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthsController extends Controller
{

    public function index()
    {
        return view('healths.index');
    }
}
