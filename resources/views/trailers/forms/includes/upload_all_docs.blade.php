<input type="hidden" id="check_Data_available" value="{{$regData ? 1 : 0}}">
<input type="hidden" id="enable_document" value="upload_all_documents">
@if($regData)
<div class="alert" style="display: none"></div>
{!! Form::open(array('method' => 'get', 'route' => 'download.all.docs', 'class' => 'form', 'id' => 'all_docs_form')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
{!! Form::close() !!}
	<div class="trailer-contents">
		<div class="row">
			<div class="col-lg-8">
				<div class="trailer-doc-block">
					<header class="heading">
						<h4 class="title text-bold">Equipment Documents</h4>
					</header>

					<div class="trailer-doc-contents">
						<img src="{{url('images/Spinner.gif')}}" id="lazy_image" style="display: none;">
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

						@if(count($docData))
							@foreach($docTypes as $key => $value)
							{!! Form::open(array('method' => 'post', 'route' => 'upload.documents', 'class' => 'form', 'id' => 'form_'.$value, 'files'=>true)) !!}

							<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
							<input type="hidden" name="VehicleId_VIN" value="{{$regData->VehicleId_VIN}}">
							<div class="row doc-row">
								{!! Form::hidden('DocType[]', $docData[$value] ? $docData[$value]->DocType : $value) !!}
								@if($docData[$value])
								{!! Form::hidden('Id[]', $docData[$value]->Id) !!}
								@endif
								<div class="col-md-4">{{$value =="fhwa" ? strtoupper($value) : ucwords(str_replace("_", " ",$value))}}</div>
								<div class="col-md-4">
									@if ($docData[$value])
										@if ($docData[$value]->mimetype == "pdf" || $docData[$value]->mimetype == "txt" || $docData[$value]->mimetype == "jpg" || $docData[$value]->mimetype == "png" || $docData[$value]->mimetype == "jpeg")
										<a href="javascript:" class="get-file-view text-primary text-underline" file-name="{{url('docs/'. $docData[$value]->FileName)}}">view</a>
										@else
											{{$docData[$value]->FileName}}
										@endif
									@else
										Not Exist
									@endif
								</div>
								<div class="col-md-2">
									<input type="file" name="FileName[]" id="file_{{$value}}">
								</div>
								<div class="col-md-2">
									<input type="submit" class="btn btn-primary btn-sm load-btn" value="Load">
								</div>
							</div>
							{!! Form::close() !!}
							@endforeach
						@endif

					</div>
				</div>

			</div>
			<div class="col-lg-4">
				<embed src="" style="width: 100%; height: 500px;" type="" id="image_previews">
			</div>
		</div>
	</div>
@endif