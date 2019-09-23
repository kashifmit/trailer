<div class="row">
	<div class="col-lg-8">
		@foreach($docData as $key => $value)
		@if($key != "invoice")
		<div class="row">
			<div class="col-md-4">{{ucwords(str_replace("_", " ",$key))}}</div>
			<div class="col-md-4">
				@if ($value)
					<a class="btn btn-primary" href="{{route('download.file',$value->Id)}}">Download</a>
				@else
					Document Unavailable
				@endif
			</div>
		</div>
		@endif
		@endforeach	
	</div>
</div>

<header class="heading">
	<h4 class="title">
		Equipment Invoices
	</h4>
	<h5>
		Click the Invioce Number to View the Invoice
	</h5>
</header>

<div class="row">
	<div class="col-lg-8">
		<div class="table-responsive">
			<table class="table table-striped text-sm table-hover">
				<thead>
					<tr>
						<th>DownLoad Invoice</th>
						<th>Invoice Number</th>
						<th>Invoice Date</th>
						<th>Vendor</th>
						<th>Total Invoice</th>
					</tr>
					<tbody>
						@php
							$i = 0;
						@endphp
						@foreach($data->filesData as $fileData)
							@if($fileData->DocType =="invoice" && isset($data->TrailerInvoices[$i]))
							@php	
								$disabled = file_exists(public_path('docs/'.$fileData->FileName)) ? '' : 'disabled="disabled"'
							@endphp
							<tr>
								<td>
									<input type="checkbox" value="{{$fileData->Id}}" {{$disabled}} name="Ids[]">
								</td>
								<td>
									<a href="{{route('edit.invoice', ['InvoiceNo' => $data->TrailerInvoices[$i]->InvoiceNo])}}">
										{{$data->TrailerInvoices[$i]->InvoiceNo}}
									</a>	
								</td>
								<td>{{date('m/d/Y', strtotime($data->TrailerInvoices[$i]->InvoiceDate))}}</td>
								<td>{{((isset($data) && !empty($data)) && isset($data->registrationData)) ? App\Helpers\DataArrayHelper::getOrganizationName($data->registrationData[0]->Owner) : null}}</td>
								<td>${{ number_format($data->TrailerInvoices[$i]->TotalPrice) }}</td>
							</tr>
								@php
									$i++;
								@endphp
							@endif
						@endforeach
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>