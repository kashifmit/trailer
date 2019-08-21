@extends('layouts.app')

@section('content')

    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Add Model') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.model', 'class' => 'form', 'files'=>true)) !!}
                @include('model_year.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
