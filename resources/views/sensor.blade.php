@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="column justify-content-center">

                <div class="card sensor-grafic">
                    <div id="grafic-sensor" class="card-body station-center"></div>
                </div>

                <div class="card sensor-filter sensor-grafic backgound">
                    <div class="card-body ">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('sensor.show', ['id' => $sensor->id]) }}" id="form-pesqui">
                                @csrf

                                <div class="form-group form-group-pesqui row">
                                    <label for="date" class="col-md-2 col-form-label text-md-right">{{ __('Data') }}</label>

                                    <div class="col-md-7">
                                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="" required>

                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-color6">
                                            {{ __('Pesquisar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card backgound">
                    <div class="card-body station-center">
                        <div class="col-md-8">
                            <form method="POST" action="{{ route('sensor.download', ['id' => $sensor->id]) }}" id="form-down">
                                @csrf

                                <div class="form-group form-group-pesqui row">
                                    <label for="date" class="col-md-10 col-form-label text-md-right">{{ __('Download de todos os dados deste sensor') }}</label>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-color6">
                                            {{ __('Baixar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card backgound">
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
                    {{$datas->onEachSide(1)->render()}}
                </div>
            </div>
        </div>
    
    </div>
</div>

@endsection