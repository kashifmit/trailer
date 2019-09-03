@extends('layouts.app')

@section('content')
    <div class="page">
        <header class="heading space-between mb-2">
            <h3 class="title">
                {{ __('Trailers') }}
            </h3>
            <a href="{{route('create.trailer')}}" class="btn btn-primary">
                Add Trailer
            </a>
        </header>

        <div class="content">
            <ul class="nav nav-tabs">
                <li class="active"><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
            </ul>
            <div class="tab-content">
                <div id="home_details" class="tab-pane fade show in active">
                    @include('trailers.forms.includes.trailer_home')
                </div>
                <div id="trailer_locations" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_locations')
                </div>
                <div id="trailer_financials" class="tab-pane fade">
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

    

