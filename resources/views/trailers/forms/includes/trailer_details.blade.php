<div class="trailer-contents">
	
	<div class="row">
		<div class="col-md-4">
			<div class="trailer-block">
				<header class="heading">
					<h5>Equipment Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}                    
						{!! Form::text('TrailerSerialNo', isset($data) ? $data->TrailerSerialNo : null, array('class'=>'form-control form-control-radius sm', 'readonly' => isset($data), 'id'=>'TrailerSerialNo', 'placeholder'=>'Trailer Number')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ManufacturerId', 'Make', ['class' => 'bold']) !!}                    
						{!! Form::select('ManufacturerId', ['' => 'Select Make']+$make, isset($data) ? $data->ManufacturerId : null, array('class'=>'form-control form-control-radius', 'id'=>'ManufacturerId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ModelYear', 'Year', ['class' => 'bold']) !!}                    
						{!! Form::select('ModelYear', ['' => 'Select Year']+$year, isset($data) ? $data->ModelYear : null, array('class'=>'form-control form-control-radius', 'id'=>'ModelYear')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ProductId', 'Size', ['class' => 'bold']) !!}                    
						{!! Form::select('ProductId', ['' => 'Select Size']+$size, isset($data) ? $data->ProductId : null, array('class'=>'form-control form-control-radius', 'id'=>'ProductId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('SiteId', 'Location', ['class' => 'bold']) !!}                    
						{!! Form::select('SiteId', ['' => 'Select Location']+$locations, isset($data) ? $data->SiteId : null, array('class'=>'form-control form-control-radius', 'id'=>'SiteId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ConditionStatusId', 'Condition Status', ['class' => 'bold']) !!}                    
						{!! Form::select('ConditionStatusId', ['' => 'Select Condition']+$conditions, isset($data) ? $data->ConditionStatusId : null, array('class'=>'form-control form-control-radius', 'id'=>'ConditionStatusId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('Owner', 'Owners', ['class' => 'bold']) !!}                    
						{!! Form::select('Owner', ['' => 'Select Owner']+$owners, (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->Owner : null, array('class'=>'form-control form-control-radius', 'id'=>'Owner')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('business', 'Business', ['class' => 'bold']) !!}                    
						{!! Form::select('business', ['' => 'Select Business']+$business, (isset($data) && isset($data)) ? $data->business  : null, array('class'=>'form-control form-control-radius', 'id'=>'business')) !!}
					</div>

				</div>			
			</div>

		</div>

		<div class="col-md-4">
			<div class="trailer-block trailer-block-bg">
				<header class="heading">
					<h5>Registration Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('VehicleId_VIN', 'Vehicle identification Number', ['class' => 'bold']) !!}                    
						{!! Form::text('VehicleId_VIN', (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null, array('class'=>'form-control form-control-radius sm', 'id'=>'VehicleId_VIN','readonly' => (isset($data) && isset($data->registrationData)), 'placeholder'=>'Vehicle identification Number')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}                    
						{!! Form::text('PlateNo', (isset($data) && $data->registrationData) ? $data->registrationData[0]->PlateNo : null, array('class'=>'form-control form-control-radius sm', 'id'=>'PlateNo', 'placeholder'=>'Plate Number')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('StateAbbreviation', 'State Register', ['class' => 'bold']) !!}
						{!! Form::select('StateAbbreviation', ['' => 'Select State']+$state, (isset($data) && $data->registrationData ) ? $data->registrationData[0]->StateAbbreviation : null, array('class'=>'form-control form-control-radius', 'id'=>'StateAbbreviation')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('TitleNo', 'Title Number', ['class' => 'bold']) !!}
						{!! Form::text('TitleNo', (isset($data) && isset($data->registrationData)) ? $data->registrationData[0]->TitleNo : null, array('class'=>'form-control form-control-radius sm', 'id'=>'TitleNo', 'placeholder'=>'Title Number')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('LastInsepctionDate', 'Last Registration', ['class' => 'bold']) !!}
						<div class="form-control-wrap date-picker">
							{!! Form::text('', isset($data) ? date('m/d/Y', strtotime($data->LastInsepctionDate)) : null, array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'LastInsepctionDate', 'placeholder'=>'Last Registration')) !!}
							<label class="picker-icon" for="LastInsepctionDate"><i class="far fa-calendar-alt"></i></label>
						</div>
					</div>
					<div class="form-group date-picker-group">
						{!! Form::label('', 'Last Registration Expire', ['class' => 'bold']) !!}
						<div class="form-control-wrap date-picker">
							{!! Form::text('ExpireDate', (isset($data) && isset($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->ExpireDate)) : null, array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'ExpireDate', 'placeholder'=>'Last Registration Expire')) !!}
							<label class="picker-icon" for="ExpireDate"><i class="far fa-calendar-alt"></i></label>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('', 'Date Acquire', ['class' => 'bold']) !!}
						<div class="form-control-wrap date-picker">
							{!! Form::text('RegistrationDate', (isset($data) && isset($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->RegistrationDate)) : null, array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'RegistrationDate', 'placeholder'=>'Date Acquire')) !!}
							<label class="picker-icon" for="RegistrationDate"><i class="far fa-calendar-alt"></i></label>
						</div>
					</div>

				</div>
			</div>

		</div>

		<div class="col-md-4">
			<div class="trailer-block">
				<header class="heading">
					<h5>Tracking Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('etrack_id', 'etracking System', ['class' => 'bold']) !!}                    
						{!! Form::select('etrack_id', ['' => 'Select etracking']+$etracking, isset($data) ? $data->etrack_id : null, array('class'=>'form-control form-control-radius', 'id'=>'etrack_id')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('TrackingId', 'Tracking Number', ['class' => 'bold']) !!}                    
						{!! Form::text('TrackingId', (isset($data) && isset($data->equipmentTracking) ) ? $data->equipmentTracking[0]->TrackingId : null, array('class'=>'form-control form-control-radius sm', 'id'=>'TrackingId', 'placeholder'=>'Tracking Number')) !!}
					</div>			
				</div>
			</div>

		</div>

	</div>

</div>

