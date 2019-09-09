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
            <div class="form-actions">
                <a href="{{route('edit.invoice.line', $InvoiceNo)}}" class="btn btn-large btn-primary">Add Line Item To the Invoice</a>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('invoice.list')}}">Review All Invoices</a>
                </div>
            </div>
        </div>
    </div>
@endsection

    

