@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit User') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.user', $data->id), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('id', $data->id) !!}
                @include('users.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
