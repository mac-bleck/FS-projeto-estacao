<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Api\ApiMessages;
class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $user_id = auth()->user()->id;

            $stations = auth()->user()->stations;
            $datas = [];

            foreach ($stations as $station) {
                $data = [];
                foreach ($station->sensors as $sensor) {
                   $data[] = [$sensor->type, $sensor->data->count()];
                }

                $datas[$station->name] = $data;
            }

            return view('config', compact('stations', 'datas', 'user_id'));

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendUserInfo($id)
    {
        try {

            $user = User::findOrFail($id);

            return response()->json($user, 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }
}
