@extends('layouts.app')

@section('content')
    <div class="page">
        
        <div class="content">
            <div class="nav-tabs-wrap sticky">
                <ul class="nav nav-tabs">
                    <li class="active"><a class="checkClass" data-toggle="tab" href="#home_details">Home</a></li>
                    <li>
                </li>
                <li>
                    <a class="checkClass trailer_documents" data-toggle="tab" href="#trailer_documents">
                    Documents
                    </a>
                </li>
                    <li><a class="checkClass" data-toggle="tab" href="#trailer_locations">Locations</a></li>
                    <li><a class="checkClass" data-toggle="tab" href="#trailer_financials">Financials</a></li>
                </ul>
            </div>

            <div class="tab-content">
                <div id="home_details" class="tab-pane fade show in active">
                    @include('trailers.forms.includes.trailer_home')
                </div>
                <div id="trailer_documents" class="tab-pane fade">
                    @include('trailers.forms.includes.search_documents')
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
    $(document).ready(function(){
        $(".highcharts-exporting-group").hide();
        $(document.body).on('change', '.form-submit', function () {
            var business = $("#business_financial").val();
            var SiteId = $("#SiteId_financial").val();
            var TrailerSerialNo = $("#TrailerSerialNo_financial").val();
            var urlString = 'business_financial='+business+'&SiteId_financial='+SiteId+'&TrailerSerialNo_financial='+TrailerSerialNo;
            $.ajax({
                url: "/trailer-financials?"+urlString,
                method: "GET",
            }).done(function(response) {
                $("#get_financial_data").html(response);
                $(".highcharts-exporting-group").hide();
            });
        });

        $('.display-table').on('click', this, function() {
            var tableContent = $("#trailer_locaton_table").html();
            // if ( !tableContent ) {
                $("#trailer_locaton_table").html();
                var data = $("#search_trailer_location").serialize();
                $.ajax({
                    url:"/trailer-location-table?"+data,
                    method:"get",
                }).done(function (response) {
                    $("#trailer_locaton_table").html(response);
                });
            // }
            // else {
            //     $("#trailer_locaton_table").fadeIn();
            // }

            // $('#map-block').hide();

        });

        $('.display-map').on('click', this, function() {

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
                } 
                else {
                    maps[0].map.setCenter({lat: parseFloat(0), lng: parseFloat(0)});
                }
            });
            $("#map-block").fadeIn();
            // $("#trailer_locaton_table").hide();
        });
    });
</script>    
@endsection

    

