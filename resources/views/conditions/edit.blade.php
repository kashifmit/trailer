@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit Condition Type') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.condition', $data->ConditionStatusId), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('ConditionStatusId', $data->ConditionStatusId) !!}
                @include('conditions.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
