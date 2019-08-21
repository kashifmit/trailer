@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">{{ __('Update Profile') }}</div>
    <div class="card-body">
        {!! Form::open(array('method' => 'put', 'route' => array('update.profile'), 'class' => 'form', 'files'=>true)) !!}
        {!! Form::hidden('id', Auth::user()->id) !!}
            <div class="form-body">
    <div class="form-group row">
            {!! Form::label('name', 'Name', ['class' => 'bold']) !!}                    
            {!! Form::text('name', Auth::user()->name, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!}
        </div>
        <div class="form-group row">
            {!! Form::label('password', 'New Password', ['class' => 'bold']) !!}                    
            <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
        </div>
        <div class="form-group row">
            {!! Form::label('c_password', 'Confirm Password', ['class' => 'bold']) !!}                    
            <input type="password" name="c_password" id="c_password" class="form-control" placeholder="Confirm Password">
        </div>
        <div class="form-actions">
            {!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
        </div>
    </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

    

