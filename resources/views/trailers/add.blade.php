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
    <div class="card">
        <div class="card-header">{{ __('Add New Trailer') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'post', 'route' => 'store.trailer', 'class' => 'form', 'files'=>true)) !!}
                @include('trailers.forms.form')
                <div class="form-actions">
        			{!! Form::button('Submit <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
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
                console.log(response.Owner);
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
    });
</script>
  
@endsection

