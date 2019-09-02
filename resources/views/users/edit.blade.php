@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10">
            
                <header class="heading">
                    <h3 class="title">{{ __('Edit User') }}</h3>
                </header>

                <div class="content">
                    {!! Form::open(array('method' => 'put', 'route' => array('update.user', $data->id), 'class' => 'form', 'files'=>true)) !!}
                    {!! Form::hidden('id', $data->id) !!}
                        @include('users.forms.form')
                    {!! Form::close() !!}
                </div>
            
            </div>
        </div>
    
    </div>
@endsection
