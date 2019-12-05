@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Add Manufacturer') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.manufacturer', 'class' => 'form', 'files'=>true)) !!}
                @include('manufacturer.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
