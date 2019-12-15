<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            
            $stations = auth()->user()->stations;
            
            return view('home', compact('stations'));
            
        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }
}
