
@if(count($data))
<div class="row">
	<div class="col-md-8">&nbsp;</div>
	<div class="col-md-2">
		<button class="btn btn-primary upload-documents" type="button">Upload Document</button>
	</div>
	<div class="col-md-2">
	{!! Form::open(array('method' => 'get', 'route' => 'download.all.docs', 'class' => 'form', 'id' => 'all_docs_form')) !!}
	<input type="button" value="Download All documents" class="download-all-documents btn btn-min-md btn-primary">
	<input type="hidden" name="TrailerSerialNo" value="{{$data[0]->TrailerSerialNo}}">
	{!! Form::close() !!}
	</div>
</div>
<div class="row">Equipment Documents</div>
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-md-6">Trailer Number</div>
			<div class="col-md-6">{{count($data) ? $data[0]->TrailerSerialNo : ''}}</div>
		</div>
		<div class="row">
			<div class="col-md-6">VIN #</div>
			<div class="col-md-6">{{count($data) ? $data[0]->VehicleId_VIN : ''}}</div>
		</div>
		<div class="row">
			<div class="col-md-6">Licence #</div>
			<div class="col-md-6">{{count($data) ? $data[0]->PlateNo : ''}}</div>
		</div>
	</div>
</div>
@if(count($data))
@foreach($data as $singleData)
	@if($singleData->DocType != 'invoice')
<div class="row">
	<div class="col-md-4">{{str_replace("_", " ",$singleData->DocType)}}</div>
	<div class="col-md-4">
		@if ($singleData->mimetype)
		<a href="{{public_path('docs/'.$singleData->FileName)}}" target="_blank">View</a>
		@else
			{{$singleData->FileName}}
		@endif
	</div>
	<div class="col-md-4">
		@if ( file_exists(public_path('docs/'.$singleData->FileName)) )
		<a class="btn btn-primary" href="{{route('download.file',$singleData->Id)}}">Download</a>
		@else
			Document Unavailable
		@endif
	</div>
</div>
@endif
@endforeach
@endif

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
						<th>Trailer</th>
						<th>Total Invoice</th>
					</tr>
					<tbody>
						@if(count($invoiceData) && isset($invoiceData[0]->invoiceFiles))
							@foreach($invoiceData as $key =>$data)
							@if($data->invoiceFiles)
							@php
								
								$disabled = file_exists(public_path('docs/'.$data->invoiceFiles[$key]->FileName)) ? '' : 'disabled="disabled"'
							@endphp
							<tr>
								<td><input type="checkbox" {{$disabled}} name="Ids[]" value="{{$data->invoiceFiles[$key]->Id}}"></td>
								<td>
									<a href="{{route('edit.invoice', ['InvoiceNo' => $data->InvoiceNo])}}">
										{{$data->InvoiceNo}}
									</a></td>
								<td>{{date('m/d/Y', strtotime($data->InvoiceDate))}}</td>
								<td>{{$data->TrailerSerialNo}}</td>
								<td>${{$data->TotalPrice}}</td>
							</tr>
							@endif
							@endforeach
						@else
							<tr><td colspan="100%">No invoices found</td></tr>	
						@endif
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>
@else
	<div class="row">
		Equipment Documents Not Found
	</div>
@endif