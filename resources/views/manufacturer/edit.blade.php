@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit Manufacturer') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.manufacturer', $data->MakeId), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('model_year', $data->MakeId) !!}
                @include('manufacturer.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
