@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->
<div class="container">
    <div class="row justify-content-center" id="user-info"></div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card backgound">
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <h4>Estações Cadastradas</h4>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nome</th>
                                <th>Localização</th>
                                <th>Sensores</th>
                                <th>Qt. Dados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stations as $station)
                                <tr>
                                    <td rowspan="5">{{ $station->id }}</td>
                                    <td rowspan="5">{{ $station->name }}</td>
                                    <td rowspan="5">{{ $station->locality }}</td>
                                </tr>
                                @foreach ($datas[$station->name] as $data)
                                    <tr>
                                        <td>{{ $data[0] }}</td>
                                        <td>{{ $data[1] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection