<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data;
use App\Sensors;
use App\Api\ApiMessages;

class DataController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Gerenciador\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {            
        try {

            $datas = $request->get('data');
            $values = [];

            foreach ($datas as $data) {
                
                $sensor = Sensors::findOrFail($data['sensors_id']);

                $data = $sensor->data()->create([
                            'value' => $data['value'],
                            'sensors_id' => $data['sensors_id']
                        ]);

                $label = date("d/m/Y h:i:s", strtotime($data->created_at));
                
                $info = [
                    'sensor_id' => $sensor->id,
                    'type' => $sensor->type,
                    'value' => $data->value
                ];
                
                $values[] = $info;
            }

            $values[] = $label;

            broadcast(new \App\Events\ValueSensor($values));

            return response()->json(['msg' => 'ok'], 201); 
            //return view('data.form'); //registro criado

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
