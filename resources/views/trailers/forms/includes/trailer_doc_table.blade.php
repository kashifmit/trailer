<input type="hidden" id="check_Data_available" value="{{$regData ? 1 : 0}}">
<input type="hidden" id="enable_document" value="show_document_table">
@if($regData)
{!! Form::open(array('method' => 'get', 'route' => 'upload.all.docs', 'class' => 'form', 'id' => 'upload_all_docs')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
{!! Form::close() !!}
{!! Form::open(array('method' => 'get', 'route' => 'download.all.docs', 'class' => 'form', 'id' => 'all_docs_form')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
{!! Form::close() !!}

<div class="trailer-contents">
	<header class="heading">
		<h4 class="title text-bold">
			Equipment Documents
		</h4>
	</header>
	<div class="titles-masthead mb-4">
		<ul class="list-title-masthead">
			<li>
				{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}
				<span>{{$regData ? $regData->TrailerSerialNo : ''}}</span>
			</li>
			<li>
				{!! Form::label('VehicleId_VIN', 'VIN', ['class' => 'bold']) !!}
				<span>{{$regData ? $regData->VehicleId_VIN : ''}}</span>
			</li>
			<li>
				{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}
				<span>{{$regData ? $regData->PlateNo : ''}}</span>
			</li>
		</ul>
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
</div>
@else
	<div class="trailer-contents">
		<div class="titles-masthead mb-4">
			<ul class="list-title-masthead">
				<li>
					{{$message}}
				</li>
			</ul>
		</div>
	</div>
@endif