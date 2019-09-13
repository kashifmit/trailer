@extends('layouts.app')

@section('content')
    <div class="page">
        <div class="button-bar mb-4 pull-right">
            <a href="{{route('create.trailer')}}" class="btn btn-primary">
                Add Trailer
            </a>
            @if(isset($data) && !empty($data))
            <a href="{{route('edit.trailer', $data->TrailerSerialNo)}}" class="btn btn-primary">
                Edit
            </a>
            <a href="{{route('create.invoice')}}" class="btn btn-primary">
                <div class="fas fa-plus"></div> Add Invoice
            </a>
            @endif
        </div>
        <div class="clearfix"></div>
        <header class="heading space-between mb-2">
            <h3 class="title">
                {{ __('Trailers') }}
            </h3>
        </header>

        <div class="content">
            <ul class="nav nav-tabs">
                <li class="active"><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
                <li>
                <a class="checkClass" data-toggle="tab" href="#trailer_details">
                  Detail
                </a>
              </li>
              <li>
                <a class="checkClass" data-toggle="tab" href="#trailer_documents">
                  Documents
                </a>
              </li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
                <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
            </ul>
            <div class="tab-content">
                <div id="home_details" class="tab-pane fade show in active">
                    @include('trailers.forms.includes.trailer_home')
                </div>
                <div id="trailer_details" class="tab-pane fade">
                   @include('trailers.forms.includes.trailer_view')
                </div>
                <div id="trailer_documents" class="tab-pane fade">
                    @include('trailers.forms.includes.trailer_document_view')
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
    $(document).on('click', '.display-table', function() {
        $("#trailer_locaton_table").html();
        var data = $("#search_trailer_location").serialize();
        $.ajax({
            url:"/trailer-location-table?"+data,
            method:"get",
        }).done(function (response) {
            $("#trailer_locaton_table").html(response);
        });
    })

    $(document).on('click', '.display-map', function() {
        var data = $("#search_trailer_location").serialize();
        $.ajax({
            url:"/search-trailer-location?"+data,
            method:"get",
        }).done(function (response) {
            var data = response.mapData;
            if (response.success) {
                $.each(data, function (index, value) {
                maps[0].map.setCenter({lat: parseFloat(value.Latitude), lng: parseFloat(value.Longitude)});
                });    
            } else {
                maps[0].map.setCenter({lat: parseFloat(0), lng: parseFloat(0)});
            }
        });
    })
</script>    
@endsection

    

