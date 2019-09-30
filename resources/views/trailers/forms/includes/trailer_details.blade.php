
@if(Route::currentRouteName() == 'create.trailer')
	<header class="heading mb-0">
		<h3 class="title">
		Create New Trailer Record
		</h3>
	</header>
	<div class="trailer-contents">

	{!! Form::open(array('method' => 'post', 'route' => 'store.trailer', 'class' => 'form', 'files'=>true, 'id' => 'add_trailer')) !!}
	@else
	<div class="trailer-contents">
		{!! Form::open(array('method' => 'put', 'route' => array('update.trailer', $data->TrailerSerialNo), 'class' => 'form', 'files'=>true, 'id' => 'edit_trailer')) !!}
            {!! Form::hidden('TrailerSerialNo', $data->TrailerSerialNo) !!}
	@endif

	<div class="row">
		<div class="col-md-6 col-xl-4">
			<div class="trailer-block mb-4 mb-lg-0">
				<header class="heading">
					<h5 class="text-bold">Equipment Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}                    
						{!! Form::text('TrailerSerialNo', isset($data) ? $data->TrailerSerialNo : null, array('class'=>'form-control form-control-radius sm', 'readonly' => isset($data), 'id'=>'TrailerSerialNo', 'placeholder'=>'Trailer Number')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ManufacturerId', 'Make', ['class' => 'bold']) !!}                    
						{!! Form::select('ManufacturerId', ['' => 'Select Make']+$make, isset($data) ? $data->ManufacturerId : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'ManufacturerId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ModelYear', 'Year', ['class' => 'bold']) !!}                    
						{!! Form::select('ModelYear', ['' => 'Select Year']+$year, isset($data) ? $data->ModelYear : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'ModelYear')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ProductId', 'Size', ['class' => 'bold']) !!}                    
						{!! Form::select('ProductId', ['' => 'Select Size']+$size, isset($data) ? $data->ProductId : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'ProductId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('SiteId', 'Location', ['class' => 'bold']) !!}                    
						{!! Form::select('SiteId', ['' => 'Select Location']+$locations, isset($data) ? $data->SiteId : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'SiteId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ConditionStatusId', 'Condition Status', ['class' => 'bold']) !!}                    
						{!! Form::select('ConditionStatusId', ['' => 'Select Condition']+$conditions, isset($data) ? $data->ConditionStatusId : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'ConditionStatusId')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('Owner', 'Owners', ['class' => 'bold']) !!}                    
						{!! Form::select('Owner', ['' => 'Select Owner']+$owners, (isset($data) && count($data->registrationData)) ? $data->registrationData[0]->Owner : null, array('class'=>'form-control form-control-radius', 'id'=>'Owner')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('business', 'Business', ['class' => 'bold']) !!}                    
						{!! Form::select('business', ['' => 'Select Business']+$business, (isset($data) && isset($data)) ? App\Helpers\DataArrayHelper::getBusinessName($data->SiteId) : null, array('class'=>'form-control form-control-radius', 'id'=>'business_detail', 'disabled' => true )) !!}
					</div>
				</div>			
			</div>
		</div>

		<div class="col-md-6 col-xl-4">
			<div class="trailer-block mb-4 mb-lg-0 trailer-block-bg">
				<header class="heading">
					<h5 class="text-bold">Registration Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('VehicleId_VIN', 'Vehicle identification Number', ['class' => 'bold']) !!}                    
						{!! Form::text('VehicleId_VIN', (isset($data) && count($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null, array('class'=>'form-control form-control-radius sm', 'id'=>'VehicleId_VIN','readonly' => (isset($data) && count($data->registrationData)), 'placeholder'=>'Vehicle identification Number')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}                    
						{!! Form::text('PlateNo', (isset($data) && count($data->registrationData)) ? $data->registrationData[0]->PlateNo : null, array('class'=>'form-control form-control-radius sm', 'id'=>'PlateNo', 'placeholder'=>'Plate Number')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('StateAbbreviation', 'State Register', ['class' => 'bold']) !!}
						{!! Form::select('StateAbbreviation', ['' => 'Select State']+$state, (isset($data) && count($data->registrationData) ) ? $data->registrationData[0]->StateAbbreviation : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'StateAbbreviation')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('TitleNo', 'Title Number', ['class' => 'bold']) !!}
						{!! Form::text('TitleNo', (isset($data) && count($data->registrationData)) ? $data->registrationData[0]->TitleNo : null, array('class'=>'form-control form-control-radius sm', 'id'=>'TitleNo', 'placeholder'=>'Title Number')) !!}
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
							{!! Form::text('ExpireDate', (isset($data) && count($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->ExpireDate)) : null, array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'ExpireDate', 'placeholder'=>'Last Registration Expire')) !!}
							<label class="picker-icon" for="ExpireDate"><i class="far fa-calendar-alt"></i></label>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('', 'Date Acquire', ['class' => 'bold']) !!}
						<div class="form-control-wrap date-picker">
							{!! Form::text('RegistrationDate', (isset($data) && count($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->RegistrationDate)) : null, array('class'=>'form-control form-control-radius sm datepicker', 'id'=>'RegistrationDate', 'placeholder'=>'Date Acquire')) !!}
							<label class="picker-icon" for="RegistrationDate"><i class="far fa-calendar-alt"></i></label>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-6 col-xl-4">
			<div class="trailer-block">
				<header class="heading">
					<h5 class="text-bold">Tracking Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('etrack_id', 'etracking System', ['class' => 'bold']) !!}                    
						{!! Form::select('etrack_id', ['' => 'Select etracking']+$etracking, isset($data) ? $data->etrack_id : null, array('class'=>'form-control form-control-radius selectable-box', 'id'=>'etrack_id')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('TrackingId', 'Tracking Number', ['class' => 'bold']) !!}                    
						{!! Form::text('TrackingId', (isset($data) && isset($data->equipmentTracking) ) ? $data->equipmentTracking[0]->TrackingId : null, array('class'=>'form-control form-control-radius sm', 'id'=>'TrackingId', 'placeholder'=>'Tracking Number')) !!}
					</div>			
				</div>
			</div>
		</div>

	</div>
	<div class="form-actions mt-4">
	@if(Route::currentRouteName() == 'create.trailer')
      {!! Form::button('Submit', array('class'=>'btn btn-min-md btn-primary edit-class', 'type'=>'submit')) !!}
    @else
    	{!! Form::button('Update', array('class'=>'btn btn-min-md btn-primary edit-class', 'type'=>'submit')) !!}
	@endif
    </div>
	</div>
{!! Form::close() !!}

