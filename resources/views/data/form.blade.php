@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <!--            
            <div class="card" id="realtimes">
                <div class="card-body">
                </div>
            </div>

            <hr />
        -->    
            <div class="card">

                <div class="card-body">
                    
                    <form method="POST" action="{{ url('/api/data') }}" id="form-station">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Valor') }}</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="" required autofocus>
                                
                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sensors_id" class="col-md-4 col-form-label text-md-right">{{ __('Sensor') }}</label>

                            <div class="col-md-6">
                                <input id="sensors_id" type="text" class="form-control @error('sensors_id') is-invalid @enderror" name="sensors_id" value="" required>

                                @error('sensors_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection