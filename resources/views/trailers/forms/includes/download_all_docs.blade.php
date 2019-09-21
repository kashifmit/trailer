
@if($regData)

{!! Form::open(array('method' => 'get', 'route' => 'upload.all.docs', 'class' => 'form', 'id' => 'upload_all_docs')) !!}
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
				@if(count($data))
				@foreach($data as $singleData)
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
@else
	<div class="row">
		Equipment Documents Not Found
	</div>
@endif