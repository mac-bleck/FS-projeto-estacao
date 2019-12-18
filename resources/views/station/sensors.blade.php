@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card backgound">
                <div class="card-header form-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                @component('station.form.sensor', [
                    'station_id' => $station['id'],
                    'type' => $type,
                    'partnumber' => $partnumber,
                    'description' => $description,
                    'id' => $id,
                    'edit' => $edit
                ])
                    
                @endcomponent
                    
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Tipo</th>
                                <th>Nº Serie</th>
                                <th>Descrição</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($sensors as $sensor)
                                    <tr>
                                        <td>{{$sensor->id}}</td>
                                        <td>{{$sensor->type}}</td>
                                        <td>{{$sensor->partnumber}}</td>
                                        <td>{{$sensor->description}}</td>
                                        <td>
                                            <a class="btn btn-danger" href="{{route('sensors.delete', ['sensor' => $sensor->id])}}"> 
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('sensors.edit', ['sensor' => $sensor->id])}}"> 
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection