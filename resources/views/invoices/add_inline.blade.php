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
        <div class="card-header">{{ __('Invoice Line Detail') }}</div>
        <div class="card-body">
            {!! Form::open(array('method' => 'put', 'route' => array('update.invoice', $data->InvoiceNo), 'class' => 'form', 'files'=>true)) !!}
            {!! Form::hidden('VehicleId_VIN', 0,array('id'=>'VehicleId_VIN')) !!}
                @include('invoices.forms.form_inline')
                <div class="form-actions">
                    {!! Form::button('Update Invoice Detail <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      window.calculation = {};
      var date_input=$('.date-picker');
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
      
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

