@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                @component('station.form.station', [
                    'name' => $name,
                    'locality' => $locality,
                    'edit' => $edit,
                    'id' => $id
                ])
                    
                @endcomponent
                    
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nome</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($stations as $station)
                                    <tr>
                                        <td>{{$station->id}}</td>
                                        <td>{{$station->name}}</td>
                                        <td>
                                            <a class="btn btn-danger" href="{{route('stations.delete', ['station' => $station->id])}}"> 
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('stations.edit', ['station' => $station->id])}}"> 
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('sensors.index', ['station' => $station->id])}}"> 
                                                {{ __('Sensores') }}
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