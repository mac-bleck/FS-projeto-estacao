@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->
<div class="container">
    <div class="row justify-content-start">

        @foreach ($stations as $station)
            <div class="col-md-3 station-div" onclick="{window.location.href='{{route('main', ['station' => $station->id])}}'}">
                <div class="card">
                    <div class="card-body station-center">
                        <i class="fas fa-th-large fa-7x"></i>
                    </div>
                    <div class="card-header station-center flex-direction-column">
                        <h3 style="margin-bottom: 0;" >{{ $station->name }}</h3>
                        <i>{{ $station->locality }}</i>
                    </div>
                </div>
            </div>
        @endforeach
    
    </div>
</div>

@endsection