@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="column justify-content-center">

                <div class="card sensor-grafic">
                    <!--<div class="card-header station-center flex-direction-column">
                        <i>Grafico</i>
                    </div>-->
                    <div id="grafic-sensor" class="card-body station-center"></div>
                </div>

                <div class="card sensor-filter">
                    <div class="card-body station-center">
                        
                    <!---->
                    <div class="col-md-8">
                        <form method="GET" action="{{ route('sensor.show', ['id' => $sensor->id]) }}" id="form-station">
                            @csrf

                            <!--<div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>
                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>-->

                            <div class="form-group row">
                                <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Data') }}</label>

                                <div class="col-md-8">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="" required>

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Pesquisar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>    
                    <!---->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->value}}</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="station-center">
                    {{$datas->render()}}
                </div>
            </div>
        </div>
    
    </div>
</div>

@endsection