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
      var date_input=$('.date-picker');
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);

      $(document).on('change', '#SiteId', function() {
        $.post("{{ route('trailer.owners') }}", 
          {
              SiteId: $(this).val(), 
              _method: 'POST', 
              _token: '{{ csrf_token() }}'
          })
          .done(function (response) {
              // console.log(response.Owner);
              if (response.success == 1) {
                $("#Owner").val(response.Owner);
                $("#business").val(response.business);
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
          if ( $(this).attr('href') === "#trailer_financials") {
            $(".form-actions").hide();
          } else {
            $(".form-actions").show();
          }
      });
      $(document).on('click', '.submit-class', function() {
        $("#add_trailer").submit();
      });
    });
</script>
  
@endsection

