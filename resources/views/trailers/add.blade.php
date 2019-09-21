@extends('layouts.app')

@section('content')

    @include('flash::message')
    <div class="page">
      <div class="content">
        @include('trailers.forms.form')
      </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
      $(document.body).on('change', '#SiteId', function() {
      $.post("/trailer-owners", 
          {
              SiteId: $(this).val(), 
              _method: 'POST', 
              _token: '{{ csrf_token() }}'
          })
          .done(function (response) {
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
      $(document).on('click', '.submit-class', function() {
        $("#add_trailer").submit();
      });
      $(document).on('click', '.search-by-trailer-number', function () {
        var formData = $("#search-by-trailer-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-vin-number', function () {
        var formData = $("#search-by-vin-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-tracking-id', function () {
        var formData = $("#search-by-tracking-id").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-business-location', function () {
        var formData = $("#search-by-business-location").serialize();
        searchTrailer(formData);
      });
    });
</script>
  
@endsection

