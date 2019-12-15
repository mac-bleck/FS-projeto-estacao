@if ($edit)
    <form method="POST" action="{{ route('sensors.update', ['sensor' => $id]) }}" id="form-station">
        @method('PUT')
@else
    <form method="POST" action="{{ route('sensors.store') }}" id="form-station">
@endif

    @csrf
    
    <input type="hidden" name="station_id" value="{{$station_id}}"/>

    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

        <div class="col-md-6">
            <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{$type}}" required autofocus>
            
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="partnumber" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Serie') }}</label>

        <div class="col-md-6">
            <input id="partnumber" type="text" class="form-control @error('partnumber') is-invalid @enderror" name="partnumber" value="{{$partnumber}}" required autofocus>
            
            @error('partnumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$description}}" required>

            @error('description')
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