<input type="hidden" id="check_Data_available" value="{{$regData ? 1 : 0}}">
<input type="hidden" id="enable_document" value="download_all_documents">
@if($regData)
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
		{!! Form::open(array('method' => 'get', 'route' => 'download.zip', 'class' => 'form')) !!}
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
				@if(count($docData))
				@foreach($docData as $key => $value)
					<tr>
						<td>
							@if ($value)
							<input type="checkbox" value="{{$value->Id}}" name="Ids[]">
							@else
							<input type="checkbox" disabled="disabled" name="Ids[]">
							@endif
						</td>
						<td>
							{{$key == "fhwa" ? strtoupper($key) : ucwords(str_replace("_", " ",$key))}}
						</td>
						<td>
							{{ $value && file_exists(public_path('docs/'.$value->FileName)) ? 'Exists' : 'File Not Available' }}
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td colspan="100%">No record found</td>
					</tr>
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
		<div class="table-responsive">
			<table class="table table-striped text-sm table-hover">
				<thead>
					<tr>
						<th>DownLoad Invoice</th>
						<th>Invoice Number</th>
						<th>Invoice Date</th>
						<th>Vendor Name</th>
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
								<td>{{App\Helpers\DataArrayHelper::getOrganizationName($regData->Owner)}}</td>
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
@if(count($invoiceData) || count($data))
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
	{!! Form::button('Download Selected Documents', array('class'=>'btn btn-primary save-email', 'type'=>'submit')) !!}
	@endif
{!! Form::close() !!}
	</div>
@else
	<div class="trailer-contents">
		<div class="titles-masthead mb-4">
			<ul class="list-title-masthead">
				<li>
					Equipment Documents Not Found
				</li>
			</ul>
		</div>
	</div>
@endif