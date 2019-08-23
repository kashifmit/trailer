
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="row">
  <div class="col-md-12"><h3>Input Trailer Invoice Line Detail</h3></div>
</div>

<div class="form-body">
  <div class="row">
    <div class="col-md-3"><label>Invoice Number</label></div>
    <div class="col-md-3">
      {!! Form::select('InvoiceNo', ['' => 'Select Invoice Number']+$invoices, isset($data) ? $data['InvoiceNo'] : null, array('class'=>'form-control invoices', 'id'=>'InvoiceNo', 'disabled' => isset($data) )) !!}
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Invoice Date</label></div>
    <div class="col-md-3">
      {!! Form::text('InvoiceDate',isset($data) ? date('m/d/Y', strtotime($data['InvoiceDate'])) : null,array('class'=>'form-control date-picker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date', 'disabled' => isset($data) )) !!}
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>
  <div class="row ">
    <div class="col-md-12 text-center">
      <strong>Labor Hours/Unit Used</strong>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-1">Dollar Amount</div>
    <div class="col-md-1"></div>
    <div class="col-md-1">Unit Price</div>
    <div class="col-md-1"></div>
    <div class="col-md-2">Fault Description</div>
    <div class="col-md-2">Resolution Description</div>
    <div class="col-md-2">Ata Area code</div>
  </div>
  @foreach($arrayData as $key => $value)
    @if($value != "TotalPrice")
    <div id="{{$value}}_div">
    <div class="row {{$value}}_row">
      {!! Form::hidden('LineType[]', $value) !!}
    <div class="col-md-2"><strong>{{$key}}</strong></div>
    <div class="col-md-1">
      {!! Form::text($value, $data[$value], array('class'=>'form-control calculate', 'id'=>$value, 'placeholder'=>$key )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::button('Add Line', array('class'=>'btn btn-large btn-primary clone-class', 'type'=>'button', 'id' => $value.'_btn' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('UnitPrice[]', null, array('class'=>'form-control', 'id'=>'UnitPrice', 'placeholder'=> 'Unit price' )) !!}
    </div>
    <div class="col-md-1">
      {!! Form::text('LaborHoursQty[]', null, array('class'=>'form-control', 'id'=>'LaborHoursQty', 'placeholder'=> 'Labor Hour Quantity' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, null, array('class'=>'form-control invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, null, array('class'=>'form-control invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
    </div>
    <div class="col-md-2">
      {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, null, array('class'=>'form-control invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
    </div>
    </div>
    <div class="row">&nbsp;</div>
    </div>
    @else
      <div class="row">
        <div class="col-md-12"><hr></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-2"><strong>Total Invoice Amount</strong></div>
          <div class="col-md-2">
            {!! Form::text($value, $data[$value], array('class'=>'form-control', 'id'=>$value, 'placeholder'=>$key, 'readonly' => true )) !!}
          </div>
        </div>
      </div>
    @endif
  @endforeach
  
</div>