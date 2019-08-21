<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>

<div class="row">
	<div class="col-md-4"><h3>Equipment Details</h3></div>
	<div class="col-md-4"><h3>Registration Details</h3></div>
	<div class="col-md-4"><h3>Tracking Details</h3></div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}                    
        	{!! Form::text('TrailerSerialNo', isset($data) ? $data->TrailerSerialNo : null, array('class'=>'form-control', 'readonly' => isset($data), 'id'=>'TrailerSerialNo', 'placeholder'=>'Trailer Number')) !!}
		</div>
	</div>
	<div class="col-md-4">
		{!! Form::label('VehicleId_VIN', 'Vehicle identification Number', ['class' => 'bold']) !!}                    
        {!! Form::text('VehicleId_VIN', (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null, array('class'=>'form-control', 'id'=>'VehicleId_VIN','readonly' => (isset($data) && isset($data->registrationData)), 'placeholder'=>'Vehicle identification Number')) !!}
	</div>
	<div class="col-md-4">
		{!! Form::label('etrack_id', 'etracking System', ['class' => 'bold']) !!}                    
        {!! Form::select('etrack_id', ['' => 'Select etracking']+$etracking, isset($data) ? $data->etrack_id : null, array('class'=>'form-control', 'id'=>'etrack_id')) !!}
	</div>
</div>

<div class="row">
	<div class="col-md-4 form-group">
			{!! Form::label('ManufacturerId', 'Make', ['class' => 'bold']) !!}                    
        	{!! Form::select('ManufacturerId', ['' => 'Select Make']+$make, isset($data) ? $data->ManufacturerId : null, array('class'=>'form-control', 'id'=>'ManufacturerId')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}                    
        {!! Form::text('PlateNo', (isset($data) && $data->registrationData) ? $data->registrationData[0]->PlateNo : null, array('class'=>'form-control', 'id'=>'PlateNo', 'placeholder'=>'Plate Number')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('TrackingId', 'Tracking Number', ['class' => 'bold']) !!}                    
        {!! Form::text('TrackingId', (isset($data) && isset($data->equipmentTracking) ) ? $data->equipmentTracking[0]->TrackingId : null, array('class'=>'form-control', 'id'=>'TrackingId', 'placeholder'=>'Tracking Number')) !!}
	</div>
</div>

<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('ModelYear', 'Year', ['class' => 'bold']) !!}                    
    	{!! Form::select('ModelYear', ['' => 'Select Year']+$year, isset($data) ? $data->ModelYear : null, array('class'=>'form-control', 'id'=>'ModelYear')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('StateAbbreviation', 'State Register', ['class' => 'bold']) !!}
		{!! Form::select('StateAbbreviation', ['' => 'Select State']+$state, (isset($data) && $data->registrationData ) ? $data->registrationData[0]->StateAbbreviation : null, array('class'=>'form-control', 'id'=>'StateAbbreviation')) !!}
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>

<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('ProductId', 'Size', ['class' => 'bold']) !!}                    
    	{!! Form::select('ProductId', ['' => 'Select Size']+$size, isset($data) ? $data->ProductId : null, array('class'=>'form-control', 'id'=>'ProductId')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('TitleNo', 'Title Number', ['class' => 'bold']) !!}
		{!! Form::text('TitleNo', (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->TitleNo : null, array('class'=>'form-control', 'id'=>'TitleNo', 'placeholder'=>'Title Number')) !!}
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>

<div class="row">
	<div class="col-md-4 form-group">
			{!! Form::label('SiteId', 'Location', ['class' => 'bold']) !!}                    
        	{!! Form::select('SiteId', ['' => 'Select Location']+$locations, isset($data) ? $data->SiteId : null, array('class'=>'form-control', 'id'=>'SiteId')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('LastInsepctionDate', 'Last Registration', ['class' => 'bold']) !!}
		{!! Form::text('LastInsepctionDate', isset($data) ? date('m/d/Y', strtotime($data->LastInsepctionDate)) : null, array('class'=>'form-control date-picker', 'id'=>'LastInsepctionDate', 'placeholder'=>'Last Registration')) !!}
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('ConditionStatusId', 'Condition Status', ['class' => 'bold']) !!}                    
    	{!! Form::select('ConditionStatusId', ['' => 'Select Condition']+$conditions, isset($data) ? $data->ConditionStatusId : null, array('class'=>'form-control', 'id'=>'ConditionStatusId')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('ExpireDate', 'Last Registration Expire', ['class' => 'bold']) !!}
		{!! Form::text('ExpireDate', (isset($data) && isset($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->ExpireDate)) : null, array('class'=>'form-control date-picker', 'id'=>'ExpireDate', 'placeholder'=>'Last Registration Expire')) !!}
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('Owner', 'Owners', ['class' => 'bold']) !!}                    
    	{!! Form::select('Owner', ['' => 'Select Owner']+$owners, (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->Owner : null, array('class'=>'form-control', 'id'=>'Owner')) !!}
	</div>
	<div class="col-md-4 form-group">
		{!! Form::label('RegistrationDate', 'Date Acquire', ['class' => 'bold']) !!}
		{!! Form::text('RegistrationDate', (isset($data) && isset($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->RegistrationDate)) : null, array('class'=>'form-control date-picker', 'id'=>'RegistrationDate', 'placeholder'=>'Date Acquire')) !!}
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-4 form-group">
		{!! Form::label('business', 'Business', ['class' => 'bold']) !!}                    
        	{!! Form::select('business', ['' => 'Select Business']+$business, (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->business  : null, array('class'=>'form-control', 'id'=>'business')) !!}
	</div>
</div>
