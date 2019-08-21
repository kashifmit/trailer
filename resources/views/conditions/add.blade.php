@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Add Condition') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.condition', 'class' => 'form', 'files'=>true)) !!}
                @include('conditions.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
