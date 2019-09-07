<div class="trailer-contents">
	<div class="row">
		<div class="col-md-12 text-left">
			<h3>
			Equipment Documents
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="text">
			<div class="form-group">
				{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}                    
				<span class="form-control-radius sm">{{(isset($data) && !empty($data)) ? $data->TrailerSerialNo : null}}</span>
			</div>
			<div class="form-group">
				{!! Form::label('VehicleId_VIN', 'VIN', ['class' => 'bold']) !!} 
				<span>{{((isset($data) && !empty($data)) && isset($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null}}</span>
			</div>
			<div class="form-group">
				{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}
				<span>{{((isset($data) && !empty($data)) && $data->registrationData) ? $data->registrationData[0]->PlateNo : null}}</span>
			</div>
		</div>
	</div>

	@if((isset($data) && !empty($data)) && count($data->filesData) > 0)
		@include('trailers.forms.includes.trailer_doc_table')
	@endif

</div>

