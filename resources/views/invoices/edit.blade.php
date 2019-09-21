@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="page">
        <header class="heading space-between">
          <h3 class="title">{{ __('Edit Invoice') }}</h3>
        </header>

        <div class="content">
            {!! Form::open(array('method' => 'put', 'route' => array('update.invoice', $data->InvoiceNo), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('InvoiceNo', $data->InvoiceNo) !!}
            {{--{!! Form::hidden('InvoiceLine', $data->InvoiceLine) !!}--}}
            {{--{!! Form::hidden('RequestOrderNo', $data->RequestOrderNo) !!}--}}
            {!! Form::hidden('VehicleId_VIN', $data->VehicleId_VIN)!!}
            {!! Form::hidden('TrailerSerial', $data->TrailerSerialNo)!!}
                @include('invoices.forms.form')
                <div class="form-actions mt-4">
                    {!! Form::button('Update', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      window.calculation = {
            'LaborTotal': $('#LaborTotal').val(), 
            'PartsTotal': $('#PartsTotal').val(), 
            'AccessoriesTotal': $('#AccessoriesTotal').val(), 
            'AnnualInspectionTotal': $('#AnnualInspectionTotal').val(), 
            'RegistrationTotal': $('#RegistrationTotal').val(), 
            'SalesTax': $('#SalesTax').val()
        };
      //   console.log(window.calculation);
      // var date_input=$('.date-picker');
      // var date_input=$('.date-picker');
      // var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      // var options={
      //   format: 'mm/dd/yyyy',
      //   container: container,
      //   todayHighlight: true,
      //   autoclose: true,
      // };
      // date_input.datepicker(options);
      
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
    });
</script>    
@endsection
