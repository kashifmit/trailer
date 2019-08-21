@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Create User') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.user', 'class' => 'form', 'files'=>true)) !!}
                @include('users.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
