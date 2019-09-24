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
		<div class="col-lg-8">
			<header class="heading">
				<h4 class="title text-bold">
					Equipment Documents
				</h4>
			</header>
	<div class="titles-masthead mb-4">
		<ul class="list-title-masthead">
			<li>
				{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}
				<span>{{(isset($data) && !empty($data)) ? $data->TrailerSerialNo : '---'}}</span>
			</li>
			<li>
				{!! Form::label('VehicleId_VIN', 'VIN', ['class' => 'bold']) !!}
				<span>{{((isset($data) && !empty($data)) && isset($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : '---'}}</span>
			</li>
			<li>
				{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}
				<span>{{((isset($data) && !empty($data)) && $data->registrationData) ? $data->registrationData[0]->PlateNo : '---'}}</span>
			</li>
		</ul>
	</div>

	@if((isset($data) && !empty($data)) && count($data->filesData) > 0)
		@include('trailers.forms.includes.trailer_doc_table_view')
	@endif
		</div>
		<div class="col-lg-4">
			<embed src="" style="width: 100%; height: 500px;" 
 type="application/pdf" id="image_previews">
		</div>
	</div>
</div>

