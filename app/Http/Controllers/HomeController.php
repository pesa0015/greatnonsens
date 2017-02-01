<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function test(Request $request)
    {
        // dd(1);
        // dd($request);
        $data = json_decode($request->data);

    	return response()->json(['success' => true, 'data' => $data]);
    }
}
