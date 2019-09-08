<div class="trailer-contents">
	<header class="heading">
		<h4 class="title">
			Equipment Documents		
		</h4>
	</header>

	<div class="titles-masthead mb-4">
		<ul class="list-title-masthead">
			<li>
				{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}
				<span>{{(isset($data) && !empty($data)) ? $data->TrailerSerialNo : null}}</span>
			</li>
			<li>
				{!! Form::label('VehicleId_VIN', 'VIN', ['class' => 'bold']) !!}
				<span>{{((isset($data) && !empty($data)) && isset($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null}}</span>
			</li>
			<li>
				{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}
				<span>{{((isset($data) && !empty($data)) && $data->registrationData) ? $data->registrationData[0]->PlateNo : null}}</span>
			</li>
		</ul>
	</div>

	@if((isset($data) && !empty($data)) && count($data->filesData) > 0)
		@include('trailers.forms.includes.trailer_doc_table')
	@endif

</div>

