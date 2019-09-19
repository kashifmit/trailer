
@if(count($data))

<div class="row">
	<div class="col-md-8">&nbsp;</div>
	<div class="col-md-2">
		<button class="btn btn-primary upload-documents" type="button">Upload Document</button>
	</div>
	<div class="col-md-2"><input type="button" value="Search Docs" class="search-docs-form btn btn-min-md btn-primary"></div>
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
<div class="row">
	<div class="col-lg-8">
	<div class="table-responsive mb-4">
		<table class="table table-striped text-sm table-hover">
			<thead>
				<tr>
					<th>DownLoad</th>
					<th>Document Name</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@if(count($data))
				@foreach($data as $singleData)
					@if($singleData->DocType != 'invoice')
					@php	
						$disabled = file_exists(public_path('docs/'.$singleData->FileName)) ? '' : 'disabled="disabled"'
					@endphp
					<tr>
						<td>
							<input type="checkbox" value="{{$singleData->Id}}" {{$disabled}} name="Ids[]">
						</td>
						<td>
							{{str_replace("_", " ",$singleData->DocType)}}
						</td>
						<td>
							{{ file_exists(public_path('docs/'.$singleData->FileName)) ? 'Exists' : 'File Not Available' }}
						</td>
					</tr>
					@endif
					@endforeach
					@endif
			</tbody>
		</table>
	</div>	
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
		{!! Form::open(array('method' => 'get', 'route' => 'download.zip', 'class' => 'form')) !!}
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
			@if(count($invoiceData) && isset($invoiceData[0]->invoiceFiles))
			<input type="hidden" name="TrailerSerialNo" value="{{$invoiceData[0]->invoiceFiles[0]->TrailerSerialNo}}">
			{!! Form::button('Download Selected Documents', array('class'=>'btn btn-primary save-email', 'type'=>'submit')) !!}
			@endif
		{!! Form::close() !!}
	</div>
</div>
@else
	<div class="row">
		Equipment Documents Not Found
	</div>
@endif