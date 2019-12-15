<?php

namespace App\Http\Controllers\Api;

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

            $type = ($request->has('type') && $request->get('type')) ? [['type', 'like', $request->get('type').'%']] : [];
            $pag = ($request->has('paginate') && $request->get('paginate')) ? $request->get('paginate') : '10';

            $sensors = $this->sensors->where($type)
                                     ->paginate($pag);
                                     
            return response()->json($sensors, 200); //registro criado

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
    public function store(SensorsRequest $request)
    {
        try {

            $station = Stations::findOrFail($request->get('stations_id'));

            $station->sensors()->firstOrCreate([
                    'type' => $request->get('type'),
                    'partnumber' => $request->get('partnumber'),	
                    'description' => $request->get('description')
                    ]);
            
            return response()->json([
                'data' => [
                    'msg' => 'Sensor criado com sucesso'
                ]
            ], 201); //registro criado

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
        //
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

            $sensors = $this->sensors->findOrFail($id);

            if ($request->has('stations_id') && $request->get('stations_id')){
                $station = Stations::findOrFail($request->get('stations_id'));
                
                $sensors->stations_id = $station->id;
                $sensors->save();

                unset($data['stations_id']);
            }

            $sensors->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Sensor atualizado com sucesso'
                ]
            ], 202);

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
    public function destroy($id)
    {
        try {

            $sensors = $this->sensors->findOrFail($id);
            $sensors->data()->delete();
            $sensors->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Sensor deletado com sucesso'
                ]
            ], 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
