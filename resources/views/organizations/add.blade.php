@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Add New Organization') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.organization', 'class' => 'form', 'files'=>true)) !!}
                @include('organizations.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
