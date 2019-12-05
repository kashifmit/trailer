@extends('layouts.app')

@section('content')
@include('flash::message')
<div class="page">
    <div class="content">
        {!! Form::open(array('method' => 'put', 'route' => array('update.invoice', $data->InvoiceNo), 'class' => 'form', 'files'=>true)) !!}
        {!! Form::hidden('VehicleId_VIN', 0,array('id'=>'VehicleId_VIN')) !!}
            @include('invoices.forms.form_inline')
            <div class="form-actions">
                {!! Form::button('Update Invoice Detail', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      window.calculation = {};      
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

