@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Add State') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.state', 'class' => 'form', 'files'=>true)) !!}
                @include('states.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
