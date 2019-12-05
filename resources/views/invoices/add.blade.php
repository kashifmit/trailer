@extends('layouts.app')

@section('content')
    @include('flash::message')
    <header class="page">
        
        <div class="content">
            {!! Form::open(array('method' => 'post', 'route' => 'store.invoice', 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('VehicleId_VIN', 0,array('id'=>'VehicleId_VIN')) !!}

            @include('invoices.forms.form')
            <div class="form-actions mt-4">
                {!! Form::button('Load Invoice to Profile', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
      window.calculation = {};
      getVendorName($(".vendor-name").val());
      $(document).on('blur', '.calculate', function (e) {
        var TotalPrice = 0;
        if ($.isNumeric( $(this).val() ) ) {
          window.calculation[$(this).attr('name')] = parseFloat($(this).val());
        } 
        else {
          $(this).val(0);
          window.calculation[$(this).attr('name')] = parseFloat($(this).val(0));
        }
        for (var key in window.calculation) {
            if (window.calculation.hasOwnProperty(key)) {
                TotalPrice += parseFloat(window.calculation[key]);
            }
        }
        $("#TotalPrice").val(TotalPrice.toFixed(2));
      });
      
      $(document).on('change', '.vendor-name', function () {
        getVendorName($(this).val());
        
      });
    });

    function getVendorName(trailerId) {
        if (trailerId != "") {
            $.post("{{ route('trailer.vendor') }}", 
            {
                TrailerSerialNo: trailerId, 
                _method: 'POST', 
                _token: '{{ csrf_token() }}'
            })
            .done(function (response) {
                console.log(response.Owner);
                if (response.success == 1) {
                    $("#VendorName").val(response.Owner);
                    $("#VehicleId_VIN").val(response.VehicleId_VIN);
                    $("#VendorName").attr('disabled', true);
                } else {
                  $("#VendorName").val('');
                  $("#VendorName").attr('disabled', false);
                }
            });
        }
    }
</script>    
@endsection

