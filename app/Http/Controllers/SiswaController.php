<?php

namespace App\Http\Controllers;

use DB;

class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function index() {
        $results = app('db')->select("SELECT * FROM siswa");

        return response()->json($results);
    }
}
