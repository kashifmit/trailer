@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Customers') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('export.customers')}}" class="btn btn-xs btn-success">
                        <i class="fa fa-download"></i>
                        Download CSV
                    </a>
                    <a href="{{route('export.dta')}}" class="btn btn-xs btn-success">
                        <i class="fa fa-download"></i>
                        Download DTA
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            {!! Form::open(array('method' => 'GET', 'route' => 'customer.list', 'class' => 'form', 'files'=>true)) !!}
            <div class="row">
                <div class="col-md-3">
                    {!! Form::select('business', ['' => '--Business--']+$buniness, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control', 'id'=>'business')) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::select('SiteId', ['' => '--Location--']+$sites, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control', 'id'=>'SiteId')) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::select('CustomerID', ['' => '--Customers--']+$customers, \Request::get('CustomerID') ? \Request::get('CustomerID') : null, array('class'=>'form-control', 'id'=>'CustomerID')) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::button('Find <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                </div>
            </div>
            {!! Form::close() !!} 
            <div class="row">&nbsp;</div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Customer Number</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Drop Trailer Agreement</th>
                        <th>Approved Allocation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Alldata as $data)
                        <tr>
                            <td>{{$data->CustomerID}}</td>
                            <td>{{$data->ShipToName}}</td>
                            <td>{{$data->ShipToAddress1}}</td>
                            <td>{{$data->ShipToCity}}</td>
                            <td>{{$data->StateAbbreviation}}</td>
                            <td><input type="checkbox" name="checkbox"></td>
                            <td>3</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($Alldata)
                <div class="pull-right">{{$Alldata->links()}}</div>
            @endif
        </div>
    </div>

@endsection

    

