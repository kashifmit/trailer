@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><b>{{ Auth::user()->name }}</b></div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <label for="name"><b>Name:</b></label> 
            </div>
            <div class="col-md-2">{{Auth::user()->name}}</div>
            <div class="col-md-2">
                <label for="email"><b>Email Address:</b></label> 
            </div>
            <div class="col-md-3">{{Auth::user()->email}}</div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>
@endsection

    

