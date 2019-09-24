<input type="hidden" id="check_Data_available" value="{{$regData ? 1 : 0}}">
<input type="hidden" id="enable_document" value="upload_all_documents">
@if($regData)
<div class="alert" style="display: none"></div>
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
		{!! Form::open(array('method' => 'post', 'route' => 'upload.documents', 'class' => 'form', 'id' => 'upload_documents', 'files'=>true)) !!}

<input type="hidden" name="TrailerSerialNo" value="{{$regData->TrailerSerialNo}}">
<input type="hidden" name="VehicleId_VIN" value="{{$regData->VehicleId_VIN}}">

	@if(count($docData))
		@foreach($docTypes as $key => $value)
		<div class="row">
			{!! Form::hidden('DocType[]', $docData[$value] ? $docData[$value]->DocType : $value) !!}
			@if($docData[$value])
			{!! Form::hidden('Id[]', $docData[$value]->Id) !!}
			@endif
			<div class="col-md-4">{{$value =="fhwa" ? strtoupper($value) : ucwords(str_replace("_", " ",$value))}}</div>
			<div class="col-md-4">
				@if($docData[$value])
				{{$docData[$value]->FileName}}
				@else
				Not Exist
				@endif

			</div>
			<div class="col-md-4">
				<input type="file" name="FileName[]" value="{{$value}}">
			</div>
		</div>
		@endforeach
		@else
		@foreach($docTypes as $key => $value)
		<div class="row">
			<div class="col-md-4">{{ucwords(str_replace("_", " ",$value))}}</div>
			{!! Form::hidden('DocType[]', $value) !!}
			<div class="col-md-4"><input type="file" name="FileName[]" value="{{$value}}"></div>
		</div>
		@endforeach
	@endif

	<div class="row">
		<input type="submit" class="btn btn-primary" name="Upload" value="Upload">
	</div>
	</div>
@endif