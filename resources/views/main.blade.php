@extends('layouts.app')

@section('content')

<div class="container home-container">
    <div class="row justify-content-center">
        @foreach ($sensors as $sensor)
            <div class="col-md-3" onclick="{window.location.href='{{route('sensor.show', ['id' => $sensor->id ])}}'}">
                <div class="card home-sensor">
                    <div class="card-body station-center">
                        <i class="fas fa-th-large fa-7x"></i>
                    </div>
                    <div class="card-header station-center">
                        <i>{{$sensor->type}}</i>
                    </div>                
                </div>
            </div>
        @endforeach      
    </div>
</div>

<div class="container home-container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card"> 
                <div id="grafic-main" class="card-body station-center"></div>               
            </div>
        </div>
    
    </div>
</div>
@endsection
