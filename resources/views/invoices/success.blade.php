@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12 pull-left">{{ __('Invoices') }}</div>
            </div>
        </div>

        <div class="card-body">
            @include('flash::message')
            {!! Form::open(array('method' => 'POST', 'route' => array('add.line.item', $InvoiceNo), 'class' => 'form', 'files'=>true)) !!}
                <div class="form-actions">
                    {!! Form::button('Add Line Item To the Invoice', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                </div>
            {!! Form::close() !!}
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('invoice.list')}}">Review All Invoices</a>
                </div>
            </div>
        </div>
    </div>
@endsection

    

