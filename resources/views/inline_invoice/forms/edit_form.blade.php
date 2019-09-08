
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

<h4 class="mb-4">Input Trailer Invoice Line Detail</h4>

<div class="titles-masthead mb-4">
  <ul class="list-title-masthead">
    <li>
      <label>Invoice Number</label>
      <span>
        {!! Form::select('InvoiceNo', ['' => 'Select Invoice Number']+$invoices, isset($data) ? $data->InvoiceNo : null, array('class'=>'form-control form-control-radius invoices', 'id'=>'InvoiceNo', 'disabled' => isset($data) )) !!}
      </span>
    </li>
    <li>
      <label>Invoice Date</label>
      <span>
        {!! Form::text('Invoice_Date',isset($data) ? date('m/d/Y', strtotime($data->InvoiceDate)) : null,array('class'=>'form-control form-control-radius date-picker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date', 'disabled' => isset($data) )) !!}
        {!! Form::hidden('InvoiceDate', date('Y-m-d', strtotime($data->InvoiceDate)))!!}
      </span>
    </li>
  </ul>
</div>


<div class="form-body">

  <div class="table-responsive">
    <table class="table text-sm table-striped table-hover">
      <tbody>
        <tr>
          <td></td>
          <td>Dollar Amount</td>
          <td>Unit Price</td>
          <td>Labor Hours / Unit Used</td>
          <td>Dollar Amount</td>
          <td>Fault Description</td>
          <td>Resolution Description</td>
          <td>Ata Area code</td>
        </tr>
      </tbody>    
    </table>
  </div>

  @foreach($arrayData as $key => $value)
    @if($value != "TotalPrice")
    <div id="{{$value}}_div">
      @if(count($ItemArray[$value]) > 0)
      @foreach($ItemArray[$value] as $key1 => $value1)
        @if ($key1 == 0)
      <div class="row {{$value}}_row">
        {!! Form::hidden('LineType[]', $value) !!}
        {!! Form::hidden('InvoiceLine[]', $value1['InvoiceLine']) !!}
    <div class="col-md-2"><strong>{{$key}}</strong></div>
    <div class="col-md-1">
      {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius calculate', 'id'=>$value, 'placeholder'=>$key )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::button('Add Line', array('class'=>'btn btn-large btn-primary clone-class', 'type'=>'button', 'id' => $value.'_btn' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('UnitPrice[]', $value1['UnitPrice'], array('class'=>$value.' form-control form-control-radius', 'id'=>'UnitPrice', 'placeholder'=> 'Unit price' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('LaborHoursQty[]', $value1['LaborHoursQty'], array('class'=>$value.' form-control form-control-radius', 'id'=>'LaborHoursQty', 'placeholder'=> 'Labor Hour Quantity' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, $value1['FaultReasonCode'], array('class'=>'form-control form-control-radius invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, $value1['ResolutionCodeId'], array('class'=>'form-control form-control-radius invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, $value1['ATACodeId'], array('class'=>'form-control form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
    </div>
    </div>
    <div class="row">&nbsp;</div>
      @else
  <div class="row {{$value}}_row">
      {!! Form::hidden('LineType[]', $value) !!}
      {!! Form::hidden('InvoiceLine[]', $value1['InvoiceLine']) !!}
    <div class="col-md-2">&nbsp;</div>
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-1">
      {!! Form::text('UnitPrice[]', $value1['UnitPrice'], array('class'=>$value.' form-control form-control-radius', 'id'=>'UnitPrice', 'placeholder'=> 'Unit price' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('LaborHoursQty[]', $value1['LaborHoursQty'], array('class'=>$value.' form-control form-control-radius', 'id'=>'LaborHoursQty', 'placeholder'=> 'Labor Hour Quantity' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, $value1['FaultReasonCode'], array('class'=>'form-control form-control-radius invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, $value1['ResolutionCodeId'], array('class'=>'form-control form-control-radius invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, $value1['ATACodeId'], array('class'=>'form-control form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
    </div>
    </div>
    <div class="row">&nbsp;</div>

        
        @endif
      @endforeach

      @else 
    <div class="row {{$value}}_row">
      {!! Form::hidden('InvoiceLine[]', '') !!}
      {!! Form::hidden('LineType[]', $value) !!}
    <div class="col-md-2"><strong>{{$key}}</strong></div>
    <div class="col-md-1">
      {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius calculate', 'id'=>$value, 'placeholder'=>$key )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::button('Add Line', array('class'=>'btn btn-large btn-primary clone-class', 'type'=>'button', 'id' => $value.'_btn' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('UnitPrice[]', null, array('class'=>$value.' form-control form-control-radius', 'id'=>'UnitPrice', 'placeholder'=> 'Unit price' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('LaborHoursQty[]', null, array('class'=>$value.' form-control form-control-radius', 'id'=>'LaborHoursQty', 'placeholder'=> 'Labor Hour Quantity' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, null, array('class'=>'form-control form-control-radius invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, null, array('class'=>'form-control form-control-radius invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, null, array('class'=>'form-control form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
    </div>
    </div>
    <div class="row">&nbsp;</div>
      @endif
    </div>
    @else
      <div class="row">
        <div class="col-md-12"><hr></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-2"><strong>Total Invoice Amount</strong></div>
          <div class="col-md-2">
            {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius', 'id'=>$value, 'placeholder'=>$key, 'readonly' => true )) !!}
          </div>
        </div>
      </div>
    @endif
  @endforeach
  
</div>