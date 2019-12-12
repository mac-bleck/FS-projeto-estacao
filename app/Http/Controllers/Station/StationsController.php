<?php

namespace App\Http\Controllers\Station;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stations;
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
    public function index()
    {
        //
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
        /*try {
            
            $stations = $this->stations->with('sensors')->findOrFail($id);

            return response()->json([
                'data' => $stations
            ], 200);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }*/
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
        /*$data = $request->all();

        try {

            $stations = $this->stations->findOrFail($id);
            $stations->update($data);
            
            $sensors = ($request->has('sensors') && $request->get('sensors')[0]) ? $request->get('sensors') : [];

            $news->photo_gallery()->createMany($info_photos);

            return response()->json([
                'data' => [
                    'msg' => 'Noticia atualizada com sucesso'
                ]
            ], 202);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
