
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
<div class="row">
  <div class="col-md-6"><h3>Input Trailer Expense Invoice</h3></div>
  <div class="col-md-6"><h3>Input Trailer Invoice Detail</h3></div>
</div>

<div class="form-body">
  <div class="row">
    <div class="col-md-6 form-group">
      {!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}
      {!! Form::select('TrailerSerialNo', ['' => 'Select Trailer Number']+$trailers, isset($data) ? $data->TrailerSerialNo : null, array('class'=>'form-control vendor-name', 'id'=>'TrailerSerialNo', 'disabled' => isset($data) )) !!}
    </div>
    <div class="col-md-6 form-group"><h3>Dollar Amount</h3></div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">
      {!! Form::label('VendorName', 'Vendor Name', ['class' => 'bold']) !!}
      {!! Form::select('VendorName', ['' => 'Select Trailer Number']+$vendors, isset($data) ? $data->Owner : null, array('class'=>'form-control vendor-name', 'id'=>'VendorName', 'disabled' => isset($data) )) !!}
    </div>
    <div class="col-md-6 form-group">
      {!! Form::label('LaborTotal', 'Labor Total', ['class' => 'bold']) !!}
      {!! Form::text('LaborTotal', isset($data) ? $data->LaborTotal : 0, array('class'=>'form-control calculate', 'id'=>'LaborTotal', 'placeholder'=>'Labor Total')) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">
      {!! Form::label('InvoiceNo', 'Invoice Number', ['class' => 'bold']) !!} 
      {!! Form::text('InvoiceNo', isset($data) ? $data->InvoiceNo : null, array('class'=>'form-control', 'id'=>'InvoiceNo', 'placeholder'=>'Invoice Number', 'disabled' => isset($data) )) !!}
    </div>
    <div class="col-md-6 form-group">
      {!! Form::label('PartsTotal', 'Labor Parts', ['class' => 'bold']) !!}
      {!! Form::text('PartsTotal', isset($data) ? $data->PartsTotal : 0, array('class'=>'form-control calculate', 'id'=>'PartsTotal', 'placeholder'=>'Labor Parts' )) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">
      {!! Form::label('InvoiceDate', 'Invoice Date', ['class' => 'bold']) !!}
      {!! Form::text('InvoiceDate',isset($data) ? date('m/d/Y', strtotime($data->InvoiceDate)) : null,array('class'=>'form-control date-picker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date')) !!}
    </div>
    <div class="col-md-6 form-group">
      {!! Form::label('AccessoriesTotal', 'Accessories Total', ['class' => 'bold']) !!}
      {!! Form::text('AccessoriesTotal',isset($data) ? $data->AccessoriesTotal : 0,  array('class'=>'form-control calculate', 'id'=>'AccessoriesTotal', 'placeholder'=>'Accessories Total')) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">
      {!! Form::label('MaintenanceOrderNo', 'Maintenance / PO Number', ['class' => 'bold']) !!}
      {!! Form::text('MaintenanceOrderNo',isset($data) ? $data->MaintenanceOrderNo : null, array('class'=>'form-control', 'id'=>'MaintenanceOrderNo', 'placeholder'=>'Maintenance / PO Number', 'disabled' => isset($data) )) !!}
    </div>
    <div class="col-md-6 form-group">
      {!! Form::label('AnnualInspectionTotal', 'Annual Inspection Total', ['class' => 'bold']) !!}
      {!! Form::text('AnnualInspectionTotal',isset($data) ? $data->AnnualInspectionTotal : 0, array('class'=>'form-control calculate', 'id'=>'AnnualInspectionTotal', 'placeholder'=>'Accessories Total')) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">&nbsp;</div>
    <div class="col-md-6 form-group">
      {!! Form::label('RegistrationTotal', 'Registration Total', ['class' => 'bold']) !!}
      {!! Form::text('RegistrationTotal',isset($data) ? $data->RegistrationTotal : 0, array('class'=>'form-control calculate', 'id'=>'RegistrationTotal', 'placeholder'=>'Registration Total')) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 form-group">      
      <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="{{ asset('/') }}no-image.png" alt="" />
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
          <div>
            <span class="btn default btn-file image-button">
              <span class="fileinput-new">
                Load Invoice Document
              </span> 
            <span class="fileinput-exists"> Change </span>
            {!! Form::file('FileName', null, array('id'=>'invoice_document')) !!}
            </span> 
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
      </div>
    </div>
    <div class="col-md-6 form-group">
      {!! Form::label('SalesTax', 'Tax Total', ['class' => 'bold']) !!}
      {!! Form::text('SalesTax',isset($data) ? $data->SalesTax : 0, array('class'=>'form-control calculate', 'id'=>'SalesTax', 'placeholder'=>'Tax Total')) !!}
    </div>
  </div>
  @if(isset($data) && !empty($data->Id))
      <div class="row">
        <div class="col-md-6 form-group">
          <a href="{{route('download.file',$data->Id)}}">DownLoad {{$data->FileName}}</a>
            {!! Form::hidden('Id', $data->Id) !!}

        </div>
        <div class="col-md-6 form-group">&nbsp;</div>
      </div>
    @endif
  <div class="row">
    <div class="col-md-6 form-group">&nbsp;</div>
    <div class="col-md-6 form-group">
      <span><hr></span>
      {!! Form::label('TotalPrice', 'Total Invoice Amount', ['class' => 'bold']) !!}
      {!! Form::text('TotalPrice', isset($data) ? $data->TotalPrice : 0, array('class'=>'form-control', 'id'=>'TotalPrice','readonly'=>true, 'placeholder'=>'Total Invoice Amount')) !!}
    </div>
  </div>
    
</div>