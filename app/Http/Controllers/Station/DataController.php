<?php

namespace App\Http\Controllers\Station;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data;
use App\Sensors;
use App\Api\ApiMessages;
use App\Http\Requests\Station\DataRequest;

class DataController extends Controller
{

    private $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
            if (!$request->has('sensors_id') && !$request->get('sensors_id')) {
                $msg = new ApiMessages("Necessario passar o campo sensors_id com o id do sensor a qual deseja ver os dados");
                return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
            }

            $sensor = Sensors::findOrFail($request->get('sensors_id'));

            $date = ($request->has('date') && $request->get('date')) ? [['created_at', 'like', $request->get('date').'%']] : [];
            $pag = ($request->has('paginate') && $request->get('paginate')) ? $request->get('paginate') : '10';

            $data = $this->data->where('sensors_id', $sensor->id)
                               ->where($date)
                               ->paginate($pag);
            
            return response()->json($data, 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Gerenciador\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {            
        try {
            
            $sensor = Sensors::findOrFail($request->get('sensors_id'));

            $sensor->data()->create([
                    'value' => $request->get('value'),
                    'sensors_id' => $request->get('sensors_id')
                    ]);
            
            return response()->json([
                'data' => [
                    'msg' => 'Dado criado com sucesso'
                ]
            ], 201); //registro criado

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
            
            $data = $this->data->findOrFail($id);
            $data->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Dado deletada com sucesso'
                ]
            ], 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }

}
