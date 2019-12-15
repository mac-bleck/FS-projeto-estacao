<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiMessages;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $station_nav = auth()->user()->stations->find($request->get('station'));
            $sensors = $station_nav->sensors;

            return view('main', compact('sensors', 'station_nav'));
            
        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }
}
