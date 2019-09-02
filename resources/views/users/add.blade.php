@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <header class="heading">
                    <h2 class="title">{{ __('Create User') }}</h2>
                </header>
        
                <div class="content">
                    {!! Form::open(array('method' => 'post', 'route' => 'store.user', 'class' => 'form', 'files'=>true)) !!}
                        @include('users.forms.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
@endsection
