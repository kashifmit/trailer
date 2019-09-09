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
            <form method="get" action="{{route('add.line.item', $InvoiceNo)}}">
                <!-- {{ csrf_field() }} -->
            <div class="form-actions">
                {!! Form::button('Add Line Item To the Invoice', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
            </div>
        </form>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('invoice.list')}}">Review All Invoices</a>
                </div>
            </div>
        </div>
    </div>
@endsection

    

