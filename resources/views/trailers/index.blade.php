@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Trailers') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('create.trailer')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add Trailer
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="active"><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
            </ul>
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>
            <div class="tab-content">
            <div id="home_details" class="tab-pane in active">
                @include('trailers.forms.includes.trailer_home')
            </div>
            <div id="trailer_locations" class="tab-pane">
                @include('trailers.forms.includes.trailer_locations')
            </div>
            <div id="trailer_financials" class="tab-pane">
                @include('trailers.forms.includes.trailer_financials')
            </div>
          </div>
        </div>
    </div>
<script type="text/javascript">
    
    $(document).on('change', '.form-submit', function () {
        var business = $("#business_financial").val();
        var SiteId = $("#SiteId_financial").val();
        var TrailerSerialNo = $("#TrailerSerialNo_financial").val();
        var urlString = 'business_financial='+business+'&SiteId_financial='+SiteId+'&TrailerSerialNo_financial='+TrailerSerialNo;
            $.ajax({
                url: "/trailer-financials?"+urlString,
                method: "GET",
            }).done(function(response) {
                $("#get_financial_data").html(response);
            });
      });
</script>    
@endsection

    

