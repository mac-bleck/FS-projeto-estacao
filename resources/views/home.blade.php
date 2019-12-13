@extends('layouts.app')

@section('content')
<!--<div id="example" >
    
</div>-->

<div class="container">
    <div class="row justify-content-start">
        
        <div class="col-md-3 station-div ">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <i class="fab fa-facebook"></i>
                </div>
                <div class="card-header">Dashboard</div>
            </div>
        </div>

    </div>
</div>

@endsection
