<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\ApiMessages;
use App\Stations;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendDataSensor(Request $request)
    {
        try {
            $station = Stations::find($request->get('station'));
            $sensors = $station->sensors;
            $data_sensor = [];

            foreach ($sensors as $sensor) {

                $data = $sensor->data()->orderBy('id','desc')->take(1)->get();
                
                $data = [
                    'sensor_id' => $sensor->id,
                    'type' => $sensor->type,
                    'value' => $data[0]->value
                ]; 
                
                $data_sensor[] = $data;
            }

            return response()->json($data_sensor, 200);
            
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
    public function sendDataGrafic(Request $request)
    {
        try {
            $station_nav = Stations::find($request->get('station'));
            $sensors = $station_nav->sensors;
            $grafic = [];

            foreach ($sensors as $sensor) {

                $dataInver = $sensor->data()->orderBy('id','desc')->take(20)->get();
 
                $datas = [];
                for ($i = count($dataInver) - 1; $i >= 0; $i--) { 
                    $datas[] = $dataInver[$i];
                }

                $values = [];
                $labels = [];

                foreach ($datas as $key => $data) {
                    $labels[] = date("d/m/Y h:i:s", strtotime($data->created_at));
                    $values[] =  $data->value;
                }

                $data = [
                    'label' => $sensor->type,
                    'data' => $values,
                    'labels' => $labels
                ]; 
                
                $grafic[] = $data;
            }

            return response()->json($grafic, 200);
            
        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401);
        }
    }
        
}
