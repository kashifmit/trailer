@extends('layouts.app')

@section('content')
<style>
.image-button {
    color: white;
    background-color: green;
    font-weight: bold;
}
</style>
    @include('flash::message')
    <div class="page">
      <!-- <div class="button-bar mb-4 pull-right">
        <a href="{{route('create.trailer')}}" class="btn btn-primary">
            Add Trailer
        </a>
        <a href="{{route('create.invoice')}}" class="btn btn-primary">
            <div class="fas fa-plus"></div> Add Invoice
        </a>
      </div>
      <div class="clearfix"></div>
      <header class="heading space-between mb-2">
            <h3 class="title">
                {{ __('Edit Trailer') }}
            </h3>
        </header> -->
      <div class="content">
          {!! Form::open(array('method' => 'put', 'route' => array('update.trailer', $data->TrailerSerialNo), 'class' => 'form', 'files'=>true, 'id' => 'edit_trailer')) !!}
            {!! Form::hidden('TrailerSerialNo', $data->TrailerSerialNo) !!}
              @include('trailers.forms.form')
                
          {!! Form::close() !!}        
      </div>

    </div>
<script type="text/javascript">
    $(document).ready(function(){
      $(document.body).on('change', '#SiteId', function() {
        $.post("{{ route('trailer.owners') }}", 
            {
                SiteId: $(this).val(), 
                _method: 'POST', 
                _token: '{{ csrf_token() }}'
            })
            .done(function (response) {
                console.log(response.Owner);
                if (response.success == 1) {
                    $("#Owner").val(response.Owner);
                    $("#business_detail").val(response.business);
                } else {
                    console.log("not found");
                }
            });
      });
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
            });
      });
      $(document).on('click', '.checkClass', function () {
          if ($(this).attr('href') === "#trailer_financials" || $(this).attr('href') === "#trailer_locations" || $(this).attr('href') === "#home_details") {
            $(".form-actions").hide();
          } else {
            $(".form-actions").show();
          }
      });
      $(document).on('click', '.edit-class', function() {
        $("#edit_trailer").submit();
      });
      $(document).on('click', '.submit-btn', function () {
        var urlString = 'TrailerSerialNo='+$("#TrailerSerialNo").val()+'&VehicleId_VIN='+$("#VehicleId_VIN").val()+'&TrackingId='+$("#TrackingId").val()+'&business='+$("#business").val()+'&SiteId='+$("#SiteId").val()+'&search=search';
            $.ajax({
                url: "/trailer-data?"+urlString,
                method: "GET",
            }).done(function(response) {
                $("#home_data_table").html(response);
            });
      });
    });
</script>    
@endsection
