<input type="hidden" id="check_Data_available" value="{{$regData ? 1 : 0}}">
<input type="hidden" id="enable_document" value="show_document_table">
@if($regData)
{!! Form::open(array('method' => 'get', 'route' => 'upload.all.docs', 'class' => 'form', 'id' => 'upload_all_docs')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
{!! Form::close() !!}
{!! Form::open(array('method' => 'get', 'route' => 'download.all.docs', 'class' => 'form', 'id' => 'all_docs_form')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
{!! Form::close() !!}

<div class="row">Equipment Documents</div>
<div class="row">
	<div class="col-lg-8">
		<div class="row">
			<div class="col-md-6">Trailer Number</div>
			<div class="col-md-6">{{$regData ? $regData->TrailerSerialNo : ''}}</div>
		</div>
		<div class="row">
			<div class="col-md-6">VIN #</div>
			<div class="col-md-6">{{$regData ? $regData->VehicleId_VIN : ''}}</div>
		</div>
		<div class="row">
			<div class="col-md-6">Licence #</div>
			<div class="col-md-6">{{$regData ? $regData->PlateNo : ''}}</div>
		</div>
	</div>
</div>
@foreach($docData as $key => $value)
<div class="row">
	<div class="col-md-4">{{$key == "fhwa" ? strtoupper($key) : ucwords(str_replace("_", " ",$key))}}</div>
	<div class="col-md-4">
		@if ($value)
			<a class="btn btn-primary" href="{{route('download.file',$value->Id)}}">Download</a>
		@else
			Document Unavailable
		@endif
	</div>
</div>
@endforeach
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
						@if(count($invoiceData))
							@foreach($invoiceData as $key =>$data)
							@if($data->invoiceFiles)
							@php
								
								$disabled = file_exists(public_path('docs/'.$data->invoiceFiles->FileName)) ? '' : 'disabled="disabled"'
							@endphp
							<tr>
								<td><input type="checkbox" {{$disabled}} name="Ids[]" value="{{$data->invoiceFiles->Id}}"></td>
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
		{{$message}}
	</div>
@endif