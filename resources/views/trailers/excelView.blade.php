@extends('layouts.app')

@section('content')
    @include('flash::message')
    <header class="page">
        
        <div class="content">
            {!! Form::open(array('method' => 'post', 'route' => 'import.Excel', 'class' => 'form', 'files'=>true)) !!}
            <input type="file" name="file">
            <button type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

