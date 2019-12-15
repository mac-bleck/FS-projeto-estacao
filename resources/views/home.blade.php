@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->
{{$stations}}
<div class="container">
    <div class="row justify-content-start">
        
        <div class="col-md-3 station-div" onclick="{window.location.href='{{route('home')}}'}">
            <div class="card">
                <div class="card-body station-center">
                    <i class="fas fa-th-large fa-7x"></i>
                </div>
                <div class="card-header station-center">Nome da estação</div>
            </div>
        </div>

    </div>
</div>

@endsection
