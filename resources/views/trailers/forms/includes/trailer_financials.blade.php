<div class="trailer-contents">
	@if(!$requestData)
	{!! Form::open(array('method' => 'GET', 'class' => 'form', 'files'=>true, 'id' => 'financialForm')) !!}
	<div class="row">
		<div class="col-md-6 col-lg-4 mb-2 mb-lg-0">
			{!! Form::select('business_financial', ['' => 'Select Business']+$business, null, array('class'=>'form-control form-submit form-control-radius selectable-box', 'id'=>'business_financial')) !!}
		</div>
		<div class="col-md-6 col-lg-4 mb-2 mb-lg-0">
			{!! Form::select('SiteId_financial', ['' => 'Select Location']+$locations, null, array('class'=>'form-control form-submit form-control-radius selectable-box', 'id'=>'SiteId_financial')) !!}
		</div>
		<div class="col-lg-4">
			{!! Form::select('TrailerSerialNo_financial', ['' => 'Select Trailer Number']+$getTrailers, null, array('class'=>'form-control selectable-box form-submit form-control-radius', 'id'=>'TrailerSerialNo_financial')) !!}
		</div>
	</div>
	{!! Form::close() !!}

	<div id="get_financial_data">
		@include('trailers.forms.includes.financilas_data')
	</div>
	@else
            @if(count($invoices))
            @php
                $totalLabor = 0;
                $totalAnnualInspection = 0;
                $totalParts = 0;
                $totalRegistration = 0;
                $totalAccessories = 0;
                $totalTax = 0;
                $invoiceIds = [];
                foreach ($invoices as $invoice) {
                    $totalLabor += $invoice->LaborTotal;
                    $totalAnnualInspection += $invoice->AnnualInspectionTotal;
                    $totalParts += $invoice->PartsTotal;
                    $totalRegistration += $invoice->RegistrationTotal;
                    $totalAccessories += $invoice->AccessoriesTotal;
                    $totalTax += $invoice->SalesTax;
                    array_push($invoiceIds, $invoice->InvoiceNo);
                }
            @endphp
            <div class="mb-4">

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Labor</div>
                            <div class="col-lg-6 mb-4">{{$totalLabor}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Annual Inspections</div>
                            <div class="col-lg-6 mb-4">{{$totalAnnualInspection}}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Parts</div>
                            <div class="col-lg-6 mb-4">{{$totalParts}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Registrations</div>
                            <div class="col-lg-6 mb-4">{{$totalRegistration}}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Accessories</div>
                            <div class="col-lg-6 mb-4">{{$totalAccessories}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">YTD - Total Tax</div>
                            <div class="col-lg-6">{{$totalTax}}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mb-4 button-bar">
                <a href="{{route('export.headCSV', implode(',',$invoiceIds))}}" class="btn btn-primary">Download Header CSV</a>
                <a href="{{route('export.lineCSV', implode(',',$invoiceIds))}}" class="btn btn-primary">Download Line Item CSV</a>
            </div>
        @endif
		<div class="table-container">
			<div class="table-responsive">
				<table class="table table-striped text-sm table-hover" id="invoices">
					<tr>
                        <thead>
                            <th>View Invoice</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Vendor</th>
                            <th>Labor Total</th>
                            <th>Parts Total</th>
                            <th>Accessories Total</th>
                            <th>Annual Inspection Total</th>
                            <th>Registration</th>
                            <th>Tax</th>
                            <th>Total Invoice</th>
                        </thead>
                    </tr>
                    <tbody>
                    	@if(count($invoices))
                    		@foreach($invoices as $invoice)
                    		<tr>
                    			<td>
                    				<a class="text-primary" href="{{route('edit.invoice', ['InvoiceNo' => $invoice->InvoiceNo])}}">
                    					{{$invoice->InvoiceNo}}
                    				</a>
                    			</td>
                                <td>{{$invoice->InvoiceNo}}</td>
                                <td>{{date('m/d/Y', strtotime($invoice->InvoiceDate))}}</td>
                                <td>{{$invoice->VendorName}}</td>
                                <td>{{$invoice->LaborTotal}}</td>
                                <td>{{$invoice->PartsTotal}}</td>
                                <td>{{$invoice->AccessoriesTotal}}</td>
                                <td>{{$invoice->AnnualInspectionTotal}}</td>
                                <td>{{$invoice->RegistrationTotal}}</td>
                                <td>{{$invoice->SalesTax}}</td>
                                <td>{{$invoice->TotalPrice}}</td>
                    		</tr>
                    		@endforeach
                    		@else
                    		<tr>
                    			<td colspan="100%">No Data Found</td>
                    		</tr>
                    	@endif
                    </tbody>
				</table>
			</div>
		</div>
	@endif
</div>