@if ($edit)
    <form method="POST" action="{{ route('stations.update', ['station' => $id]) }}" id="form-station">
        @method('PUT')
@else
    <form method="POST" action="{{ route('stations.store') }}" id="form-station">
@endif

    @csrf
    
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$name}}" required autofocus>
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="locality" class="col-md-4 col-form-label text-md-right">{{ __('Localização') }}</label>

        <div class="col-md-6">
            <input id="locality" type="text" class="form-control @error('locality') is-invalid @enderror" name="locality" value="{{$locality}}" required>

            @error('locality')
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