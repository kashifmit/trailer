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
	@if (isset($successMessage))
		<div class="alert alert-success">{{$successMessage}}</div>
	@endif
	<div class="row">
		<div class="col-xl-8">
			<div class="trailer-doc-block">
				<header class="heading">
					<h4 class="title text-bold">Equipment Documents</h4>
				</header>
				<div class="trailer-doc-contents">
					<div class="row doc-row">
						<div class="col-md-4"><span>Trailer Number</span></div>
						<div class="col-md-4"><span>{{$regData ? $regData->TrailerSerialNo : ''}}</span></div>
					</div>
					<div class="row doc-row">
						<div class="col-md-4"><span>VIN</span></div>
						<div class="col-md-4"><span>{{$regData ? $regData->VehicleId_VIN : ''}}</span></div>
					</div>
					<div class="row doc-row">
						<div class="col-md-4"><span>Plate Number</span></div>
						<div class="col-md-4"><span>{{$regData ? $regData->PlateNo : ''}}</span></div>
					</div>

					@foreach($docData as $key => $value)
						<div class="row doc-row">
							<div class="col-md-4">{{$key == "fhwa" ? strtoupper($key) : ucwords(str_replace("_", " ",$key))}}</div>
							@if ($value)
								<div class="col-md-4">
									@if ($value->mimetype == "pdf" || $value->mimetype == "txt" || $value->mimetype == "jpg" || $value->mimetype == "png" || $value->mimetype == "jpeg")
									<a href="javascript:" class="get-file-view text-primary text-underline" file-name="{{url('docs/'. $value->FileName)}}">view</a>
									@else
										{{$value->FileName}}
									@endif
								</div>
							@else
								<div class="col-md-4">
									<span><a href="javascript:">view</a></span>
								</div>
							@endif
						
							<div class="col-md-4">
								@if ($value)
									<a class="btn btn-primary btn-sm" href="{{route('download.file',$value->Id)}}">Download</a>
								@else
									Document Unavailable
								@endif
							</div>
						</div>
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
			</div>

		</div>

		<div class="col-md-6 col-lg-4">
			<div class="doc-preview-wrap">
				<embed src="" type="" id="image_previews">
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