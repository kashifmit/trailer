
@if($regData)
<div class="alert" style="display: none"></div>
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
			<div class="col-md-4">{{ucwords(str_replace("_", " ",$value))}}</div>
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

{!! Form::close() !!}




@endif