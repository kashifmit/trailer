@extends('layouts.app')

@section('content')
    <div class="page">

        <div class="row">
            <div class="col-xl-3">

                <header class="heading">
                    <h3 class="title">{{ __('All Customers') }}</h3>
                </header>

                <div class="form-block mb-5">
                    {!! Form::open(array('method' => 'GET', 'route' => 'customer.list', 'class' => 'form', 'files'=>true)) !!}
                        <input type="hidden" name="pressSubmit" value="pressed">
                        <div class="form-group">
                            {!! Form::select('business', ['' => '--Business--']+$buniness, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control selectable-box form-control-radius', 'id'=>'business')) !!}
                        </div>
                        <div class="form-group">Or</div>
                        <div class="form-group">
                            {!! Form::select('SiteId', ['' => '--Location--']+$sites, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control selectable-box form-control-radius', 'id'=>'SiteId')) !!}                        
                        </div>

                        <div class="form-group">
                            {!! Form::select('CustomerID', ['' => '--Customers--']+$customers, \Request::get('CustomerID') ? \Request::get('CustomerID') : null, array('class'=>'form-control selectable-box form-control-radius', 'id'=>'CustomerID')) !!}
                        </div>

                        {!! Form::button('Display Table', array('class'=>'btn btn-primary', 'type'=>'submit')) !!}

                    {!! Form::close() !!}
                </div>
            
            </div>
            <div class="col-xl-9">
                @if($Alldata)
                <header class="heading">
                    <h3 class="title">{{ __('Customer Table') }}</h3>
                </header>
                <div class="button-bar mb-4">
                    <a href="{{route('export.customers')}}" class="btn btn-primary mr-20">
                        Download CSV
                    </a>
                    <a href="{{route('export.dta')}}" class="btn btn-primary">
                        Download DTA
                    </a>
                </div>
                @endif
                <div class="table-responsive">
                    @if(!empty($Alldata))
                    <table class="table text-sm table-striped table-hover">
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
                                    <td>{{$data->SiteName}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                
                @if($Alldata)
                    <div class="mt-2">
                        {{ $Alldata->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection

    

