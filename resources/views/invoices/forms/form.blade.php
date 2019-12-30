
{!! APFrmErrHelp::showErrorsNotice($errors) !!}


<div class="form-body">

  <div class="row">
    <div class="col-md-6">
      <header class="heading">
        <h4>Input Trailer Expense Invoice</h4>
      </header>
      <div class="text mb-5 mb-md-0">
        <div class="trailer-block trail-block-md">
        
          <div class="form-group">
            {!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}
            {!! Form::select('TrailerSerialNo', ['' => 'Select Trailer Number']+$trailers, isset($data) ? $data->TrailerSerialNo : $invoiceId, array('class'=>'form-control form-control-radius selectable-box lg vendor-name', 'id'=>'TrailerSerialNo', 'disabled' => isset($data) )) !!}
          </div>
          <div class="form-group">
            {!! Form::label('VendorName', 'Vendor Name', ['class' => 'bold']) !!}
            {!! Form::select('VendorName', ['' => 'Select Vendor Name']+$vendors, isset($data) ? $data->Owner : null, array('class'=>'form-control form-control-radius lg', 'id'=>'VendorName', 'disabled' => isset($data) )) !!}
          </div>
          <div class="form-group">
            {!! Form::label('InvoiceNo', 'Invoice Number', ['class' => 'bold']) !!} 
            {!! Form::text('InvoiceNo', isset($data) ? $data->InvoiceNo : null, array('class'=>'form-control form-control-radius lg', 'id'=>'InvoiceNo', 'placeholder'=>'Invoice Number', 'disabled' => isset($data) )) !!}
          </div>
          <div class="form-group">
            {!! Form::label('InvoiceDate', 'Invoice Date', ['class' => 'bold']) !!}
            <div class="form-control-wrap date-picker">
              {!! Form::text('InvoiceDate',isset($data) ? date('m/d/Y', strtotime($data->InvoiceDate)) : null,array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'InvoiceDate', 'placeholder'=>'Invoice Date')) !!}
            <label class="picker-icon" for="InvoiceDate"><i class="far fa-calendar-alt"></i></label>
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('MaintenanceOrderNo', 'Maintenance / PO Number', ['class' => 'bold']) !!}
            {!! Form::text('MaintenanceOrderNo',isset($data) ? $data->MaintenanceOrderNo : null, array('class'=>'form-control form-control-radius lg', 'id'=>'MaintenanceOrderNo', 'placeholder'=>'Maintenance / PO Number', 'disabled' => isset($data) )) !!}

          </div>
          <div class="form-group">
            {!! Form::file('FileName', null, array('id'=>'invoice_document')) !!}
          </div>
            @if(isset($data) && !empty($data->FileName)
              && file_exists(public_path('docs/'.$data->FileName))
            )
            <div class="mt-4">
              <a class="text-primary" href="{{route('download.invoice.file',$data->Id)}}">Download Invoice</a>
              {!! Form::hidden('Id', $data->Id) !!}
            </div>
          @endif

        </div>
      </div>
    </div>

    <div class="col-md-6">
      <header class="heading text-md-right">
        <h4>Input Trailer Invoice Detail</h4>
      </header>
      <div class="text">
        
        <div class="trailer-block">

          <div class="row justify-content-end">
            <div class="col-lg-8">
            
              <h6 class="text-right mb-3">Dollar Amount</h6>

              <div class="form-group">
                {!! Form::label('LaborTotal', 'Labor Total', ['class' => 'bold']) !!}
                {!! Form::text('LaborTotal', isset($data) ? number_format((float)$data->LaborTotal, 2) : 0, array('class'=>'form-control form-control-radius sm calculate', 'id'=>'LaborTotal', 'placeholder'=>'Labor Total')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('PartsTotal', 'Labor Parts', ['class' => 'bold']) !!}
                {!! Form::text('PartsTotal', isset($data) ? number_format((float)$data->PartsTotal, 2) : 0, array('class'=>'form-control form-control-radius sm calculate', 'id'=>'PartsTotal', 'placeholder'=>'Labor Parts' )) !!}
              </div>
              <div class="form-group">
                {!! Form::label('AccessoriesTotal', 'Accessories Total', ['class' => 'bold']) !!}
                {!! Form::text('AccessoriesTotal',isset($data) ? number_format((float)$data->AccessoriesTotal, 2) : 0,  array('class'=>'form-control form-control-radius sm calculate', 'id'=>'AccessoriesTotal', 'placeholder'=>'Accessories Total')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('AnnualInspectionTotal', 'Annual Inspection Total', ['class' => 'bold']) !!}
                {!! Form::text('AnnualInspectionTotal',isset($data) ? number_format((float)$data->AnnualInspectionTotal, 2) : 0, array('class'=>'form-control form-control-radius sm calculate', 'id'=>'AnnualInspectionTotal', 'placeholder'=>'Accessories Total')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('RegistrationTotal', 'Registration Total', ['class' => 'bold']) !!}
                {!! Form::text('RegistrationTotal',isset($data) ? number_format((float)$data->RegistrationTotal, 2) : 0, array('class'=>'form-control form-control-radius sm calculate', 'id'=>'RegistrationTotal', 'placeholder'=>'Registration Total')) !!}
              </div>
              <div class="form-group">
                {!! Form::label('SalesTax', 'Tax Total', ['class' => 'bold']) !!}
                {!! Form::text('SalesTax',isset($data) ? number_format((float)$data->SalesTax, 2) : 0, array('class'=>'form-control form-control-radius sm calculate', 'id'=>'SalesTax', 'placeholder'=>'Tax Total')) !!}
              </div>
              <span><hr></span>
              <div class="form-group">
                {!! Form::label('TotalPrice', 'Total Invoice Amount', ['class' => 'bold']) !!}
                {!! Form::text('TotalPrice', isset($data) ? number_format((float)$data->TotalPrice, 2) : 0, array('class'=>'form-control form-control-radius sm', 'id'=>'TotalPrice','readonly'=>true, 'placeholder'=>'Total Invoice Amount')) !!}
              </div>

            </div>
          </div>
          

        </div>

      </div>
    </div>

  </div>
    
</div>