@extends('layouts.app')

@section('content')
<div class="page">
    <div class="card-body">

        <div class="row">
            <div class="col-md-7">
                <div class="heading">
                    <h3 class="title">
                        Reporting Locations
                    </h3>
                </div>

                <div class="form-block mb-5">
                    {!! Form::open(array('method' => 'GET', 'route' => 'home', 'class' => 'form', 'files'=>true, 'id' => 'dashboard-form')) !!}
                                        
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                {!! Form::select('business_financial', ['' => 'Select Business']+$business, \Request::get('business_financial') ? \Request::get('business_financial') : null, array('class'=>'form-control form-control-radius form-submit', 'id'=>'business_financial')) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::select('SiteId_financial', ['' => 'Select Location']+$locations, \Request::get('SiteId_financial') ? \Request::get('SiteId_financial') : null, array('class'=>'form-control form-control-radius form-submit', 'id'=>'SiteId_financial')) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>

                <div class="map-block">
                    {!! Mapper::render() !!}
                </div>

            </div>

            <div class="col-md-5">
                <div class="heading">
                    <h3 class="title">
                        Trailer Details
                    </h3>
                </div>
                <div class="detail-block mb-5">
                    <ul class="list-home-detail">
                        <li>
                            Total Trailers: <small>(All Locations)</small>
                            <mark>{{ $allData['totalTrailers'] ? $allData['totalTrailers'] : 0 }}</mark>
                        </li>
                        <li>
                            Subtotal Trailers Owned: <small>(All Locations)</small>
                            <mark>{{ $allData['totalTrailers'] ? $allData['totalTrailers'] : 0 }}</mark>
                        </li>
                        <li>
                            Subtotal Trailers Leased: <small>(All Locations)</small>
                            <mark>{{ $allData['leasedTrailer'] ? $allData['leasedTrailer'] : 0 }}</mark>
                        </li>
                    </ul>
                </div>

                <div class="detail-block">
                    <header class="heading">
                        <h3 class="title">Trailer Financials</h3>
                    </header>
                    
                    <ul class="list-home-detail">
                        <li>
                            Total Lease Expense <small>(All Locations)</small>
                            <mark>{{ $allData['leaseExpense'] ? $allData['leaseExpense'] : 0 }}</mark>
                        </li>
                        <li>
                            Total Maintenance Expense <small>(All Locations)</small>
                            <mark>{{ $allData['totalPrice'] ? $allData['totalPrice'] : 0 }}</mark>
                        </li>
                    </ul>

                </div>

            </div>
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
