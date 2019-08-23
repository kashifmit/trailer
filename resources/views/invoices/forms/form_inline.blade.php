
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="row">
  <div class="col-md-12"><h3>Input Trailer Invoice Line Detail</h3></div>
</div>

<div class="form-body">
  <div class="row">
    <div class="col-md-3"><label>Invoice Number</label></div>
    <div class="col-md-3">
      {!! Form::select('InvoiceNo', ['' => 'Select Invoice Number']+$invoices, isset($data) ? $data->InvoiceNo : null, array('class'=>'form-control invoices', 'id'=>'InvoiceNo', 'disabled' => isset($data) )) !!}
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Invoice Date</label></div>
    <div class="col-md-3">
      {!! Form::text('InvoiceDate',isset($data) ? date('m/d/Y', strtotime($data->InvoiceDate)) : null,array('class'=>'form-control date-picker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date')) !!}
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3 text-center">
      <label>Dollar Amount</label>
    </div>
    <div class="col-md-6">&nbsp;</div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Labor Total</label></div>
    <div class="col-md-3">
      {!! Form::text('LaborTotal', isset($data) ? $data->LaborTotal : 0, array('class'=>'form-control calculate', 'id'=>'LaborTotal', 'placeholder'=>'Labor Total')) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Parts Total</label></div>
    <div class="col-md-3">
      {!! Form::text('PartsTotal', isset($data) ? $data->PartsTotal : 0, array('class'=>'form-control calculate', 'id'=>'PartsTotal', 'placeholder'=>'Labor Parts' )) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Accessories Total</label></div>
    <div class="col-md-3">
      {!! Form::text('AccessoriesTotal',isset($data) ? $data->AccessoriesTotal : 0,  array('class'=>'form-control calculate', 'id'=>'AccessoriesTotal', 'placeholder'=>'Accessories Total')) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Annual Inspection Total</label></div>
    <div class="col-md-3">
      {!! Form::text('AnnualInspectionTotal',isset($data) ? $data->AnnualInspectionTotal : 0, array('class'=>'form-control calculate', 'id'=>'AnnualInspectionTotal', 'placeholder'=>'Accessories Total')) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Registration Total</label></div>
    <div class="col-md-3">
      {!! Form::text('RegistrationTotal',isset($data) ? $data->RegistrationTotal : 0, array('class'=>'form-control calculate', 'id'=>'RegistrationTotal', 'placeholder'=>'Registration Total')) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3"><label>Tax Total</label></div>
    <div class="col-md-3">
      {!! Form::text('SalesTax',isset($data) ? $data->SalesTax : 0, array('class'=>'form-control calculate', 'id'=>'SalesTax', 'placeholder'=>'Tax Total')) !!}
    </div>
    <div class="col-md-3">
      <a href="{{route('create.line.item', $data->InvoiceNo)}}" class="btn btn-large btn-primary" target="_blank">Add Line Items</a> 
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-3">
      <span><hr></span>
      <label>Total Invoice Amount</label>
    </div>
    <div class="col-md-3">
      <span><hr></span>
      {!! Form::text('TotalPrice', isset($data) ? $data->TotalPrice : 0, array('class'=>'form-control', 'id'=>'TotalPrice','readonly'=>true, 'placeholder'=>'Total Invoice Amount')) !!}
    </div>
    <div class="col-md-3"></div>
  </div>
</div>