@extends('layouts.app')

@section('content')

    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit Model') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.model', $data->ModelYear), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('model_year', $data->ModelYear) !!}
                @include('model_year.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
