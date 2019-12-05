@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit State') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.state', $data->StateAbbreviation), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('StateAbbreviation', $data->StateAbbreviation) !!}
                @include('states.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
