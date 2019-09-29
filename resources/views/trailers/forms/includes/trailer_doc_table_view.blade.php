@foreach($docData as $key => $value)
	@if($key != "invoice")
		<div class="row doc-row">
			<div class="col-md-4">
				{{$key =="fhwa" ? strtoupper($key) : ucwords(str_replace("_", " ",$key))}}
			</div>
			@if ($value)
				<div class="col-md-6 col-xl-4">
					@if ($value->mimetype == "pdf" || $value->mimetype == "txt" || $value->mimetype == "jpg" || $value->mimetype == "png" || $value->mimetype == "jpeg")
					<a href="javascript:" class="get-file-view text-primary text-underline" file-name="{{url('docs/'. $value->FileName)}}">view</a>
					@else
						{{$value->FileName}}
					@endif				
				</div>
			@else
				<div class="col-md-6 col-xl-4">
					<span><a href="javascript:">view</a></span>
				</div>
			@endif
			<div class="col-md-4">
				@if ($value)
					<a class="btn btn-primary btn-sm" href="{{route('download.file',$value->Id)}}">Download</a>
				@else
					<span>Document Unavailable</span>
				@endif
			</div>
		</div>
	@endif
@endforeach	

<header class="heading mt-5">
	<h4 class="title">Equipment Invoices</h4>
	<h5>Click the Invioce Number to View the Invoice</h5>
</header>

<div class="row">
	<div class="col-lg-9">
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