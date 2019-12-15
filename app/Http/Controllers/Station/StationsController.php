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

            $stations = $this->stations->where('user_id', auth()->user()->id)
                                       ->with('sensors')
                                       ->where($name)
                                       ->paginate($pag);
   
            return view('station.stations', [
                'stations' => $stations,
                'name' => '',
                'locality' => '',
                'edit' => false,
                'id' => ''
            ]);

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {

            auth()->user()->stations()->firstOrCreate([
                        'name' => ucfirst(strtolower($request->get('name'))),
                        'locality' => $request->get('locality')
                    ]);

            return redirect()->route('stations.index');

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
        try {

            $station = auth()->user()->stations()->findOrFail($id);
            $stations = $this->stations->where('user_id', auth()->user()->id)
                                       ->with('sensors')
                                       ->paginate(10);
            
            return view('station.stations', [
                'stations' => $stations,
                'name' => $station->name,
                'locality' => $station->locality,
                'edit' => true,
                'id' => $station->id
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

            $data['name'] = ucfirst(strtolower($data['name']));

            $stations = auth()->user()->stations()->findOrFail($id);

            if ($request->has('user_id') && $request->get('user_id')){
                $user = User::findOrFail($request->get('user_id'));
                
                $stations->user_id = $user->id;
                $stations->save();

                unset($data['user_id']);
            }

            $stations->update($data);

            return redirect()->route('stations.index');

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

            $stations = auth()->user()->stations()->findOrFail($id);
            $sensors = $stations->sensors;

            foreach ($sensors as $sensor) {
                Data::where('sensors_id', $sensor->id)->delete();
            }

            Sensors::where('stations_id', $stations->id)->delete();

            $stations->delete();

            return redirect()->route('stations.index');

        } catch (\Exception $e) {
            $msg = new ApiMessages($e->getMessage());
            return response()->json($msg->getMessage(), 401); //COLOCAR O CODIGO DE RESPOSTA CERTO
        }
    }
}
