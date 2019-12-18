@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card" id="realtime">
                <div class="card-body">
                </div>
            </div>

            <hr />
            <!--
            <div class="card">

                <div class="card-body">
                    
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Valor</th>
                                <th>Sensor</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->value}}</td>
                                        <td>{{$data->sensors_id}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="station-center">
                        {{$datas->links()}}
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
@endsection