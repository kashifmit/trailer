@extends('layouts.app')

@section('content')
<div class="page">

    <div class="row">
        <div class="col-md-6">
            <div class="heading">
                <h3 class="title">
                    Reporting Locations
                </h3>
            </div>

            <div class="form-block mb-5">
                {!! Form::open(array('method' => 'GET', 'route' => 'home', 'class' => 'form', 'files'=>true, 'id' => 'dashboard-form')) !!}
                                    
                <div class="form-group">
                    {!! Form::select('business_financial', ['' => 'ALL Business']+$business, \Request::get('business_financial') ? \Request::get('business_financial') : null, array('class'=>'form-control form-control-radius selectable-box form-submit', 'id'=>'business_financial')) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('SiteId_financial', ['' => 'ALL Location']+$locations, \Request::get('SiteId_financial') ? \Request::get('SiteId_financial') : null, array('class'=>'form-control form-control-radius selectable-box form-submit', 'id'=>'SiteId_financial')) !!}
                </div>

                {!! Form::close() !!}
            </div>

            <div class="map-block">
                {!! Mapper::render() !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="heading heading-detail-sp">
                <h3 class="title text-right">
                    Trailer Details
                </h3>
            </div>
            <div class="detail-block mb-5">
                <ul class="list-detail list-sp">
                    <li>
                        <span>Total Trailers (All Locations)</span>
                        <mark>{{ $allData['totalTrailers'] ? number_format((float)$allData['totalTrailers']+ (float)$allData['leasedTrailer'], 1) : 0 }}</mark>
                    </li>
                    <li>
                        <span>Subtotal Trailers Owned (All Locations)</span>
                        <mark>{{ $allData['totalTrailers'] ? number_format((float)$allData['totalTrailers'], 1) : 0 }}</mark>
                    </li>
                    <li>
                        <span>Subtotal Trailers Leased (All Locations)</span>
                        <mark>{{ $allData['leasedTrailer'] ? number_format((float)$allData['leasedTrailer'], 1) : 0 }}</mark>
                    </li>
                </ul>
            </div>

            <div class="detail-block">
                <header class="heading heading-detail-sp">
                    <h3 class="title text-right">Trailer Financials</h3>
                </header>
                <ul class="list-detail list-sp">
                    <li>
                        <span>Total Lease Expense (All Locations)</span>
                        <mark>{{ $allData['leaseExpense'] ? '$ '.number_format((float)$allData['leaseExpense'], 2) : 0 }}</mark>
                    </li>
                    <li>
                        <span>Total Maintenance Expense (All Locations)</span>
                        <mark>{{ $allData['totalPrice'] ? '$ '.number_format((float)$allData['totalPrice'], 2) : 0 }}</mark>
                    </li>
                </ul>

            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document.body).on('change', '.form-submit', function () {
            $("#dashboard-form").submit();
        });
    });
</script>
@endsection
