
{!! APFrmErrHelp::showErrorsNotice($errors) !!}

<div class="form-body">
  <header class="heading">
    <h4>Input Trailer Invoice Line Detail</h4>
  </header>

  <div class="row">
    <div class="col-md-8 col-xl-6">
    
      <div class="trailer-block trail-block-md">
        <div class="form-group">
          <label>Invoice Number</label>
          {!! Form::select('InvoiceNo', ['' => 'Select Invoice Number']+$invoices, isset($data) ? $data->InvoiceNo : null, array('class'=>'form-control form-control-radius lg selectable-box invoices', 'id'=>'InvoiceNo', 'disabled' => isset($data) )) !!}
        </div>
      
        <div class="form-group">
          <label>Invoice Date</label>
          <div class="form-control-wrap date-picker">
            {!! Form::text('InvoiceDate',isset($data) ? date('m/d/Y', strtotime($data->InvoiceDate)) : null,array('class'=>'form-control form-control-radius md datepicker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date')) !!}
            <label class="picker-icon" for="InvoiceDate"><i class="far fa-calendar-alt"></i></label>
          </div>
        </div>
        
        <div class="form-group mt-5 mb-4">
          <label></label>
          <div class="control-wrap">
            <h5>Dollar Amount</h5>
          </div>
        </div>
        
        <div class="form-group">
          <label>Labor Total</label>
          <div class="control-wrap">
            {!! Form::text('LaborTotal', isset($data) ? number_format((float)$data->LaborTotal,2 ) : 0, array('class'=>'form-control form-control-radius calculate', 'id'=>'LaborTotal', 'placeholder'=>'Labor Total')) !!}
            <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <div class="form-group">
          <label>Parts Total</label>
          <div class="control-wrap">
          {!! Form::text('PartsTotal', isset($data) ? number_format((float)$data->PartsTotal, 2) : 0, array('class'=>'form-control form-control-radius calculate', 'id'=>'PartsTotal', 'placeholder'=>'Labor Parts' )) !!}
          <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <div class="form-group">
          <label>Accessories Total</label>
          <div class="control-wrap">
          {!! Form::text('AccessoriesTotal',isset($data) ? number_format((float)$data->AccessoriesTotal, 2) : 0,  array('class'=>'form-control form-control-radius calculate', 'id'=>'AccessoriesTotal', 'placeholder'=>'Accessories Total')) !!}
          <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <div class="form-group">
          <label>Annual Inspection Total</label>
          <div class="control-wrap">
          {!! Form::text('AnnualInspectionTotal',isset($data) ? number_format((float)$data->AnnualInspectionTotal, 2) : 0, array('class'=>'form-control form-control-radius calculate', 'id'=>'AnnualInspectionTotal', 'placeholder'=>'Accessories Total')) !!}
          <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <div class="form-group">
          <label>Registration Total</label>
          <div class="control-wrap">
            {!! Form::text('RegistrationTotal',isset($data) ? number_format((float)$data->RegistrationTotal, 2) : 0, array('class'=>'form-control form-control-radius calculate', 'id'=>'RegistrationTotal', 'placeholder'=>'Registration Total')) !!}
            <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <div class="form-group">
          <label>Tax Total</label>
          <div class="control-wrap">
            {!! Form::text('SalesTax',isset($data) ? number_format((float)$data->SalesTax, 2) : 0, array('class'=>'form-control form-control-radius calculate', 'id'=>'SalesTax', 'placeholder'=>'Tax Total')) !!}
            <a href="{{route('edit.invoice.line', $data->InvoiceNo)}}" class="btn btn-sm btn-primary">Add Line Items</a>
          </div>
        </div>
        
        <hr class="hr-dark mt-4 mb-4">

        <div class="form-group">
          <label>Total Invoice Amount</label>
          <div class="control-wrap">
            {!! Form::text('TotalPrice', isset($data) ? number_format((float)$data->TotalPrice, 2) : 0, array('class'=>'form-control form-control-radius', 'id'=>'TotalPrice','readonly'=>true, 'placeholder'=>'Total Invoice Amount')) !!}
          </div>
        </div>


      </div>

    </div>
  </div>
  
</div>