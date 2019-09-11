<div class="trailer-contents">
	@if(!count($invoices))
	{!! Form::open(array('method' => 'GET', 'class' => 'form', 'files'=>true, 'id' => 'financialForm')) !!}
	<div class="row">
		<div class="col-md-4">
			{!! Form::select('business_financial', ['' => 'Select Business']+$business, null, array('class'=>'form-control form-submit form-control-radius', 'id'=>'business_financial')) !!}
		</div>
		<div class="col-md-4">
			{!! Form::select('SiteId_financial', ['' => 'Select Location']+$locations, null, array('class'=>'form-control form-submit form-control-radius', 'id'=>'SiteId_financial')) !!}
		</div>
		<div class="col-md-4">
			{!! Form::select('TrailerSerialNo_financial', ['' => 'Select Trailer Number']+$getTrailers, null, array('class'=>'form-control form-submit form-control-radius', 'id'=>'TrailerSerialNo_financial')) !!}
		</div>
	</div>
	{!! Form::close() !!}
	<div class="row">&nbsp;</div>
	<div id="get_financial_data">
		@include('trailers.forms.includes.financilas_data')
	</div>
	@else
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