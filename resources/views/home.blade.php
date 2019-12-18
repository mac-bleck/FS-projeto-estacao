@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->
<div class="container">
    <div class="row justify-content-start">

        @foreach ($stations as $station)
            <div class="col-md-3 station-div" onclick="{window.location.href='{{route('main', ['station' => $station->id])}}'}">
                <div class="card backgound">
                    <div class="card-body station-center">
                        <i class="fas fa-th-large fa-7x" style="color:rgba(113,179,124,0.9);"></i>
                    </div>
                    <div class="card-header station-center flex-direction-column">
                        <h3 style="margin-bottom: 0; color: #555;" >{{ $station->name }}</h3>
                        <i>{{ $station->locality }}</i>
                    </div>
                </div>
            </div>
        @endforeach
    
    </div>
</div>

@endsection