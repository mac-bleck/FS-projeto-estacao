<?php

namespace App\Http\Controllers\Station;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sensors;
use App\Stations;
use App\Api\ApiMessages;
use App\Http\Requests\Station\SensorsRequest;

class SensorsController extends Controller
{

    private $sensors;

    public function __construct(Sensors $sensors)
    {
        $this->sensors = $sensors;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $station = auth()->user()->stations()->findOrFail($request->get('station'));
        
            $type = ($request->has('type') && $request->get('type')) ? [['type', 'like', $request->get('type').'%']] : [];
            $pag = ($request->has('paginate') && $request->get('paginate')) ? $request->get('paginate') : '10';

            $sensors = $this->sensors->where('stations_id', $station->id)
                                     ->where($type)
                                     ->paginate($pag);

            return view('station.sensors', [
                'station' => [
                    'id' => $station->id,
                    'name' => $station->name,
                    'locality' => $station->locality,
                ],
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $station = Stations::findOrFail($request->get('station_id'));

            $station->sensors()->firstOrCreate([
                    'type' => ucfirst(strtolower($request->get('type'))),
                    'partnumber' => $request->get('partnumber'),	
                    'description' => $request->get('description')
                    ]);
            
            return redirect()->route('sensors.index', ['station' => $station->id]);

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $sensor = $this->sensors->findOrFail($id);
            $station = Stations::findOrFail($sensor->stations_id);

            return view('station.sensors', [
                'station' => [
                    'id' => $station->id,
                    'name' => $station->name,
                    'locality' => $station->locality,
                ],
                'sensors' => $station->sensors,
                'id' => $sensor->id,
                'type' => $sensor->type,
                'partnumber' => $sensor->partnumber,
                'description' => $sensor->description,
                'edit' => true
            ]);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
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
        $data = $request->all();

        try {
            $data['type'] = ucfirst(strtolower($data['type']));
            
            $sensor = $this->sensors->findOrFail($id);

            if ($request->has('station_id') && $request->get('station_id')){
                $station = Stations::findOrFail($request->get('station_id'));
                        
                $sensor->stations_id = $station->id;
                $sensor->save();

                unset($data['station_id']);
            }

            $sensor->update($data);

            return redirect()->route('sensors.index', ['station' => $request->get('station_id')]);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {

            $sensors = $this->sensors->findOrFail($id);
            $station = $sensors->stations_id;

            $sensors->data()->delete();
            $sensors->delete();

            return redirect()->route('sensors.index', ['station' => $station]);
        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
