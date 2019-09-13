@extends('layouts.app')

@section('content')

    @include('flash::message')
    <div class="page">

      <header class="heading">
        <h3 class="title">
          {{ __('Add New Trailer') }}
        </h3>
      </header>
      <div class="content">
          {!! Form::open(array('method' => 'post', 'route' => 'store.trailer', 'class' => 'form', 'files'=>true, 'id' => 'add_trailer')) !!}
              @include('trailers.forms.form')
        <div class="form-actions">
            {!! Form::button('Save', array('class'=>'btn btn-min-md btn-primary submit-class', 'type'=>'submit')) !!}
        </div>
          {!! Form::close() !!}        
      </div>

    </div>

<script type="text/javascript">
    $(document).ready(function(){
      $(document).on('change', '#SiteId', function() {
        $.post("{{ route('trailer.owners') }}", 
          {
              SiteId: $(this).val(), 
              _method: 'POST', 
              _token: '{{ csrf_token() }}'
          })
          .done(function (response) {
              if (response.success == 1) {
                $("#business_detail").val(response.business);
                $("#Owner").val(response.Owner);
              } else {
                console.log("not found");
              }
          });
      });
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
      $(document).on('click', '.checkClass', function () {
          if ( $(this).attr('href') === "#trailer_financials" || $(this).attr('href') === "#trailer_locations" || $(this).attr('href') === "#home_details") {
            $(".form-actions").hide();
          } else {
            $(".form-actions").show();
          }
      });
      $(document).on('click', '.submit-class', function() {
        $("#add_trailer").submit();
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

