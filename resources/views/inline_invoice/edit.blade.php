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
        
        <header class="heading">
          <h3 class="title">{{ __('Edit Invoice Line Detail') }}</h3>
        </header>
        <div class="content">
          {!! Form::open(array('method' => 'put', 'route' => array('update.invoice.line', $data->InvoiceNo), 'class' => 'form', 'files'=>true)) !!}
              @include('inline_invoice.forms.edit_form')
              <div class="form-actions">
                  {!! Form::button('Update Invoice Detail', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
              </div>
          {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
      var count = 0;
      window.calculation = {
            'LaborTotal': $('#LaborTotal').val(), 
            'PartsTotal': $('#PartsTotal').val(), 
            'AccessoriesTotal': $('#AccessoriesTotal').val(), 
            'AnnualInspectionTotal': $('#AnnualInspectionTotal').val(), 
            'RegistrationTotal': $('#RegistrationTotal').val(), 
            'SalesTax': $('#SalesTax').val()
        };
      
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
      $(document).on('click', '.clone-class', function() {
        var num_item = $('.calculate-item').length;
        num_item = num_item+1;
        console.log(num_item);
        var id = $(this).attr('id').split("_");
        var html = '<tr>'+
        '<input type="hidden" name="LineType[]" value="'+id[0]+'" >'+
        '<input type="hidden" name="InvoiceLine[]" value="" >'+
        '<td>&nbsp;</td>'+
        '<td>&nbsp;</td>'+
        '<td></td>'+
        '<td>'+
        '<input class="'+id[0]+' form-control form-control-radius calculate-item" id="'+id[0]+'_UnitPrice_'+num_item+'" placeholder="Unit price" name="UnitPrice[]" type="text">'+
        '</td>'+
        '<td><input class="'+id[0]+' form-control form-control-radius calculate-item" id="'+id[0]+'_LaborHoursQty_'+num_item+'" placeholder="Labor Hour Quantity" name="LaborHoursQty[]" type="text"></td>'+
        '<td class="faultreason'+count+'"></td>'+
        '<td class="resolutioncode'+count+'"></td>'+
        '<td class=" partslabor'+count+'"></td>'+
        '</td>';
        $(html).insertAfter("#"+id[0]+"_div");
        $('.FaultReasonCode').first().clone().appendTo(".faultreason"+count).last().val('');
        $('.ResolutionCodeId').first().clone().appendTo(".resolutioncode"+count).last().val('');
        $('.PartsLaborId').first().clone().appendTo(".partslabor"+count).last().val('');
        count++;
      });
    });
    $(document).on('blur', '.calculate-item', function () {
        var getAttrId = $(this).attr('id').split("_");
        var totalamount = getAttrId[0];
        var item = getAttrId[2];
        var UnitPrice = $("#"+totalamount+"_UnitPrice_"+item).val();
        var LaborHoursQty = $("#"+totalamount+"_LaborHoursQty_"+item).val();
        if (UnitPrice != "" && LaborHoursQty != "") {
          var result = parseFloat(UnitPrice) * parseFloat(LaborHoursQty);
          var total = parseFloat($("#"+totalamount).val()) + parseFloat(result);
          $("#"+totalamount).val(total);
          $("#"+totalamount).blur();
        }
      });
</script>    
@endsection

