@extends('layouts.app')

@section('content')
    <div class="page">
        <header class="heading">
            <h3>{{ __('Invoices') }}</h3>
        </header>

        <div class="content">
            <div class="button-bar mb-4">
                <a href="{{route('export.headCSV')}}" class="btn btn-xs btn-primary">
                    Download Header CSV
                </a>
                <a href="{{route('export.lineCSV')}}" class="btn btn-xs btn-primary">
                    Download Line Item CSV
                </a>
                <a href="{{route('create.invoice')}}" class="btn btn-xs btn-dark">
                    <div class="fas fa-plus"></div> Add Invoice
                </a>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped text-sm table-hover" id="invoices">
                        <tr>
                            <thead>
                                <th>View Invoice</th>
                                <th>Invoice Number</th>
                                <th>Invoice Date</th>
                                <th>Vendor</th>
                                <th>Labor Total</th>
                                <th>Parts Total</th>
                                <th>Accessories Total</th>
                                <th>Annual Inspection Total</th>
                                <th>Registration</th>
                                <th>Tax</th>
                                <th>Total Invoice</th>
                            </thead>
                        </tr>
                        <tbody>
                            @if(count($data))
                                @foreach($data as $single)
                                    <tr>
                                        <td><a class="text-primary" href="{{route('edit.invoice', ['InvoiceNo' => $single->InvoiceNo])}}">{{$single->InvoiceNo}}</a></td>
                                        <td>{{$single->InvoiceNo}}</td>
                                        <td>{{date('m/d/Y', strtotime($single->InvoiceDate))}}</td>
                                        <td>{{$single->VendorName}}</td>
                                        <td>{{$single->LaborTotal}}</td>
                                        <td>{{$single->PartsTotal}}</td>
                                        <td>{{$single->AccessoriesTotal}}</td>
                                        <td>{{$single->AnnualInspectionTotal}}</td>
                                        <td>{{$single->RegistrationTotal}}</td>
                                        <td>{{$single->SalesTax}}</td>
                                        <td>{{$single->TotalPrice}}</td>
                                    </tr>
                                @endforeach    
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(count($data))
                    <div class="mt-3">{{$data->links()}}</div>
                @endif
            </div>
        </div>
    </div>

@endsection

    

