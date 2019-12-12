<?php

namespace App\Http\Controllers\Station;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stations;
use App\Sensors;
use App\Data;
use App\User;
use App\Api\ApiMessages;
use App\Http\Requests\Station\StationsRequest;

class StationsController extends Controller
{

    private $stations;

    public function __construct(Stations $stations)
    {
        $this->stations = $stations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
            $name = ($request->has('name') && $request->get('name')) ? [['name', 'like', $request->get('name').'%']] : [];
            $pag = ($request->has('paginate') && $request->get('paginate')) ? $request->get('paginate') : '10';

            $stations = $this->stations->with('sensors')
                                       ->where($name)
                                       ->paginate($pag);
            
            return response()->json($stations, 200);

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
    public function store(StationsRequest $request)
    {
        $data = $request->all();

        try {
            $user = User::findOrFail($request->get('user_id'));

            $user->stations()->firstOrCreate([
                        'name' => $request->get('name'),
                        'locality' => $request->get('locality')
                    ]);

            return response()->json([
                'data' => [
                    'msg' => 'Estação criada com sucesso'
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
        try {
            
            $stations = $this->stations->with('sensors')->findOrFail($id);

            return response()->json([
                'data' => $stations
            ], 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
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

            $stations = $this->stations->findOrFail($id);

            if ($request->has('user_id') && $request->get('user_id')){
                $user = Stations::findOrFail($request->get('user_id'));
                
                $stations->user_id = $user->id;
                $stations->save();

                unset($data['user_id']);
            }

            $stations->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Estação atualizada com sucesso'
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

            $stations = $this->stations->findOrFail($id);
            $sensors = $stations->sensors;

            foreach ($sensors as $sensor) {
                Data::where('sensors_id', $sensor->id)->delete();
            }

            Sensors::where('stations_id', $stations->id)->delete();

            $stations->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Estação deletado com sucesso'
                ]
            ], 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
