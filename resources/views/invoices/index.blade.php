@extends('layouts.app')

@section('content')
    <div class="page">
        
        <header class="heading">
            <h3>{{ __('Search For a Trailer Repair History') }}</h3>
        </header>
        @if(count($data) == 0)
        <div class="mb-5">
            {!! Form::open(array('method' => 'GET', 'route' => 'invoice.list', 'class' => 'form', 'files'=>true)) !!}
            <div class="form-group row mb-0">
                <label for="TrailerSerialNo" class="col-xl-3 col-form-label text-xl-right">{{ __('Enter Trailer Number') }}</label>
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="form-control-wrap search">
                        <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number" value="{{\Request::get('TrailerSerialNo')}}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-3">
                    {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <div class="mt-4 mb-4">Or</div>
            {!! Form::open(array('method' => 'GET', 'route' => 'invoice.list', 'class' => 'form', 'files'=>true)) !!}
            <div class="form-group row mb-0">
                <label for="VehicleId_VIN" class="col-xl-3 col-form-label text-xl-right">{{ __('Enter VIN Number') }}</label>
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="form-control-wrap search">
                        <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number" value="{{\Request::get('VehicleId_VIN')}}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-3">
                {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <div class="mt-4 mb-4">Or</div>
            {!! Form::open(array('method' => 'GET', 'route' => 'invoice.list', 'class' => 'form', 'files'=>true)) !!}
            <div class="form-group row mb-0">
                <label for="TrackingId" class="col-xl-3 col-form-label text-xl-right">{{ __('Enter TrailerTracking Number') }}</label>
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="form-control-wrap search">
                        <input type="text" class="form-control form-control-radius mb-2 mb-md-0" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-3">
                {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @else
            @php
                $totalLabor = 0;
                $totalAnnualInspection = 0;
                $totalParts = 0;
                $totalRegistration = 0;
                $totalAccessories = 0;
                $totalTax = 0;
                $invoiceIds = [];
                foreach ($data as $single) {
                    $totalLabor += $single->LaborTotal;
                    $totalAnnualInspection += $single->AnnualInspectionTotal;
                    $totalParts += $single->PartsTotal;
                    $totalRegistration += $single->RegistrationTotal;
                    $totalAccessories += $single->AccessoriesTotal;
                    $totalTax += $single->SalesTax;
                    array_push($invoiceIds, $single->InvoiceNo);
                }
            @endphp

            <div class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Labor</div>
                            <div class="col-lg-6 mb-4">{{number_format((float)$totalLabor, 2)}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Annual Inspections</div>
                            <div class="col-lg-6 mb-4">{{number_format((float)$totalAnnualInspection, 2)}}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Parts</div>
                            <div class="col-lg-6 mb-4">{{number_format((float)$totalParts, 2)}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Registrations</div>
                            <div class="col-lg-6 mb-4">{{number_format((float)$totalRegistration, 2)}}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Accessories</div>
                            <div class="col-lg-6 mb-4">{{number_format((float)$totalAccessories, 2)}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Tax</div>
                            <div class="col-lg-6">{{number_format((float)$totalTax, 2)}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4 button-bar">
                <a href="{{route('export.headCSV', implode(',',$invoiceIds))}}" class="btn btn-primary">Download Header CSV</a>
                <a href="{{route('export.lineCSV', implode(',',$invoiceIds))}}" class="btn btn-primary">Download Line Item CSV</a>
            </div>
        @endif
        <div class="content">
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
                                        <td>{{number_format((float)$single->LaborTotal, 2)}}</td>
                                        <td>{{number_format((float)$single->PartsTotal, 2)}}</td>
                                        <td>{{number_format((float)$single->AccessoriesTotal, 2)}}</td>
                                        <td>{{number_format((float)$single->AnnualInspectionTotal, 2)}}</td>
                                        <td>{{number_format((float)$single->RegistrationTotal, 2)}}</td>
                                        <td>{{number_format((float)$single->SalesTax, 2)}}</td>
                                        <td>{{number_format((float)$single->TotalPrice, 2)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%">No Invoice found</td>
                                </tr>
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

    

