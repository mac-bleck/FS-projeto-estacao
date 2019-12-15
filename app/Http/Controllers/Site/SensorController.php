<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sensors;
use App\Data;
use App\Stations;
use App\Api\ApiMessages;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
        
            $type = ($request->has('type') && $request->get('type')) ? [['type', 'like', $request->get('type').'%']] : [];
            $pag = ($request->has('paginate') && $request->get('paginate')) ? $request->get('paginate') : '10';

            $sensors = $this->sensors->where('stations_id', $station->id)
                                     ->where($type)
                                     ->paginate($pag);

            return view('sensor', [
                'sensors' => $sensors,
                'id' => '',
                'type' => '',
                'partnumber' => '',
                'description' => '',
                'edit' => false
            ]);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {

            $date = ($request->has('date') && $request->get('date')) ? [['created_at', 'like', $request->get('date').'%']] : [];

            $sensor = Sensors::findOrFail($id);
            
            $station_nav = Stations::findOrFail($sensor->stations_id);
            $sensor_nav = $sensor->type;

            $datas = Data::where('sensors_id', $sensor->id)->where($date)->paginate(12);

            return view('sensor', compact(
                'datas', 
                'sensor', 
                'station_nav',
                'sensor_nav'
            ));

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
