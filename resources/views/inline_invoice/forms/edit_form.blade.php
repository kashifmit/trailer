
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
    <table class="table text-sm">
        <thead>
          <tr>
            <td></td>
            <td>Dollar Amount</td>
            <td></td>
            <td>Unit Price</td>
            <td>Labor Hours / Unit Used</td>
            <td>Fault Description</td>
            <td>Resolution Description</td>
            <td>Ata Area code</td>
          </tr>  
        </thead>
        <tbody>
          @foreach($arrayData as $key => $value)
            @if($value != "TotalPrice")
            @if(count($ItemArray[$value]) > 0)
              @foreach($ItemArray[$value] as $key1 => $value1)
                @if ($key1 == 0)
          <tr id="{{$value}}_div">
              {!! Form::hidden('LineType[]', $value) !!}
              {!! Form::hidden('InvoiceLine[]', $value1['InvoiceLine']) !!}
              <td><strong>{{$key}}</strong></td>
              <td>
                {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius calculate', 'id'=>$value, 'placeholder'=>$key )) !!}
              </td>
              <td>
                {!! Form::button('Add Line', array('class'=>'btn btn-large btn-primary clone-class', 'type'=>'button', 'id' => $value.'_btn' )) !!}
              </td>
              <td>
                {!! Form::text('UnitPrice[]', $value1['UnitPrice'], array('class'=>$value.' form-control form-control-radius calculate-item', 'id'=>$value.'_UnitPrice_0', 'placeholder'=> 'Unit price' )) !!}
              </td>
              <td>
                {!! Form::text('LaborHoursQty[]', $value1['LaborHoursQty'], array('class'=>' form-control form-control-radius calculate-item', 'id'=>$value.'_LaborHoursQty_0', 'placeholder'=> 'Labor Hour Quantity' )) !!}
              </td>
              <td>
                {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, $value1['FaultReasonCode'], array('class'=>'form-control selectable-box form-control-radius invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
              </td>
              <td>
                {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, $value1['ResolutionCodeId'], array('class'=>'form-control form-control-radius selectable-box invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
              </td>
              <td>
                {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, $value1['ATACodeId'], array('class'=>'form-control selectable-box form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
              </td>
          </tr>
          @else
            <tr>
              {!! Form::hidden('LineType[]', $value) !!}
              {!! Form::hidden('InvoiceLine[]', $value1['InvoiceLine']) !!}
              <td></td>
              <td></td>
              <td></td>
              <td>
                {!! Form::text('UnitPrice[]', $value1['UnitPrice'], array('class'=>$value.' form-control form-control-radius calculate-item', 'id'=>$value.'_UnitPrice_'.$key1, 'placeholder'=> 'Unit price' )) !!}
              </td>
              <td>
                {!! Form::text('LaborHoursQty[]', $value1['LaborHoursQty'], array('class'=>' form-control form-control-radius calculate-item', 'id'=>$value.'_LaborHoursQty_'.$key1, 'placeholder'=> 'Labor Hour Quantity' )) !!}
              </td>
              <td>
                {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, $value1['FaultReasonCode'], array('class'=>'form-control selectable-box form-control-radius invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
              </td>
              <td>
                {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, $value1['ResolutionCodeId'], array('class'=>'form-control form-control-radius selectable-box invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
              </td>
              <td>
                {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, $value1['ATACodeId'], array('class'=>'form-control selectable-box form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
              </td>
            </tr>
          @endif
        @endforeach
          <!-- If there is no record in db -->
            @else
              <tr id="{{$value}}_div">
              {!! Form::hidden('LineType[]', $value) !!}
              {!! Form::hidden('InvoiceLine[]', '') !!}
              <td><strong>{{$key}}</strong></td>
              <td>
                {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius calculate', 'id'=>$value, 'placeholder'=>$key )) !!}
              </td>
              <td>
                {!! Form::button('Add Line', array('class'=>'btn btn-large btn-primary clone-class calculate-class', 'type'=>'button', 'id' => $value.'_btn' )) !!}
              </td>
              <td>
                {!! Form::text('UnitPrice[]', null, array('class'=>$value.' form-control form-control-radius calculate-item', 'id'=> $value.'_UnitPrice_0', 'placeholder'=> 'Unit price' )) !!}
              </td>
              <td>
                {!! Form::text('LaborHoursQty[]', null, array('class'=>'form-control form-control-radius calculate-item', 'id'=> $value.'_LaborHoursQty_0', 'placeholder'=> 'Labor Hour Quantity' )) !!}
              </td>
              <td>
                {!! Form::select('FaultReasonCode[]', ['' => 'Select Fault']+$getFaultCode, null, array('class'=>'form-control form-control-radius selectable-box invoices FaultReasonCode', 'id'=>'FaultReasonCode' )) !!}
              </td>
              <td>
                {!! Form::select('ResolutionCodeId[]', ['' => 'Select Resolution']+$getResolutionCode, null, array('class'=>'form-control form-control-radius selectable-box invoices ResolutionCodeId', 'id'=>'ResolutionCodeId' )) !!}
              </td>
              <td>
                {!! Form::select('ATACodeId[]', ['' => 'Select Ata']+$getAtaCode, null, array('class'=>'form-control selectable-box form-control-radius invoices PartsLaborId', 'id'=>'PartsLaborId' )) !!}
              </td>
          </tr>
            @endif
            <!-- only to print total price -->
            @else
              <tr>
                <td><strong>Total Invoice Amount</strong></td>
                <td>
                  {!! Form::text($value, $data[$value], array('class'=>'form-control form-control-radius', 'id'=>$value, 'placeholder'=>$key, 'readonly' => true )) !!}
                </td>
                <td colspan="7"></td>
              </tr>
            @endif
          @endforeach
        </tbody>
    </table>
  </div>