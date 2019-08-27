@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Dashboard
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-4"><h3>Reporting Locations</h3></div>
            <div class="col-md-6"><h3>Trailer Details</h3></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
            {!! Form::open(array('method' => 'GET', 'route' => 'home', 'class' => 'form', 'files'=>true, 'id' => 'dashboard-form')) !!}        
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::select('business_financial', ['' => 'Select Business']+$business, \Request::get('business_financial') ? \Request::get('business_financial') : null, array('class'=>'form-control form-submit', 'id'=>'business_financial')) !!}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::select('SiteId_financial', ['' => 'Select Location']+$locations, \Request::get('SiteId_financial') ? \Request::get('SiteId_financial') : null, array('class'=>'form-control form-submit', 'id'=>'SiteId_financial')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">Total Trailers: (All Locations)</div>
                    <div class="col-md-3">
                        {!! Form::text('TrailerTotal', $allData['totalTrailers'], array('class'=>'form-control', 'id'=>'TrailerTotal', 'placeholder'=>'Total Trailers', 'readonly' => true)) !!}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-7">Subtotal Trailers Owned: (All Locations)</div>
                    <div class="col-md-3">
                        {!! Form::text('SubTotalTrailerOwned', $allData['totalTrailers'], array('class'=>'form-control', 'id'=>'SubTotalTrailerOwned', 'placeholder'=>'Subtotal Trailers Leased', 'readonly' => true)) !!}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-7">Subtotal Trailers Leased: (All Locations)</div>
                    <div class="col-md-3">
                        {!! Form::text('SubTotalTrailerLeased', $allData['leasedTrailer'], array('class'=>'form-control', 'id'=>'SubTotalTrailerLeased', 'placeholder'=>'Subtotal Trailers Leased', 'readonly' => true)) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-6"><h3>Trailer Financials</h3></div>
            <div class="col-md-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-4" style="width: 500px; height: 250px;">
                {!! Mapper::render() !!}
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">Total Lease Expense (All Locations)</div>
                    <div class="col-md-3">
                        {!! Form::text('TotalLeaseExpense', $allData['leaseExpense'], array('class'=>'form-control', 'id'=>'TotalLeaseExpense', 'placeholder'=>'Total Lease Expense', 'readonly' => true)) !!}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-md-7">Total Maintenance Expense (All Locations)</div>
                    <div class="col-md-3">
                        {!! Form::text('TotalMaintenanceExpense', $allData['totalPrice'], array('class'=>'form-control', 'id'=>'TotalMaintenanceExpense', 'placeholder'=>'Total Maintenance Expense', 'readonly' => true)) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '.form-submit', function () {
            $("#dashboard-form").submit();
        });
    });
</script>
@endsection
