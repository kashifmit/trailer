@extends('layouts.app')

@section('content')

    @include('flash::message')
    <div class="card">
        <div class="card-header">{{ __('Edit Organization') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.organization', $data->organizationId), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('id', $data->organizationId) !!}
                @include('organizations.forms.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
