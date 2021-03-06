<input type="hidden" id="check_Data_available" value="{{(isset($data) && !empty($data)) ? 1 : 0}}">
<input type="hidden" id="enable_document" value="show_document_table">
{!! Form::open(array('method' => 'get', 'route' => 'upload.all.docs', 'class' => 'form', 'id' => 'upload_all_docs')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$data->TrailerSerialNo}}">
{!! Form::close() !!}
{!! Form::open(array('method' => 'get', 'route' => 'download.all.docs', 'class' => 'form', 'id' => 'all_docs_form')) !!}
	<input type="hidden" name="TrailerSerialNo" value="{{$data->TrailerSerialNo}}">
{!! Form::close() !!}
<div class="trailer-contents">
	<div class="row">
		<div class="col-xl-8">
			<div class="trailer-doc-block">

				<header class="heading">
					<h4 class="title text-bold">
						Equipment Documents
					</h4>
				</header>

				<div class="trailer-doc-contents">
						<div class="row doc-row">
							<div class="col-md-4"><span>Trailer Number</span></div>
							<div class="col-md-4"><span>{{(isset($data) && !empty($data)) ? $data->TrailerSerialNo : '---'}}</span></div>
						</div>
						<div class="row doc-row">
							<div class="col-md-4"><span>VIN</span></div>
							<div class="col-md-4">
								<span>{{((isset($data) && !empty($data)) && count($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : '---'}}</span>
							</div>
						</div>
						<div class="row doc-row">
							<div class="col-md-4"><span>Plate Number</span></div>
							<div class="col-md-4"><span>{{((isset($data) && !empty($data)) && count($data->registrationData)) ? $data->registrationData[0]->PlateNo : '---'}}</span></div>
						</div>

						
							@include('trailers.forms.includes.trailer_doc_table_view')
				</div>			
			</div>
		</div>
		<div class="col-md-6 col-lg-4">
			<div class="doc-preview-wrap">
				<embed src="" type="application/pdf" id="image_previews">
			</div>
		</div>
	</div>
</div>

