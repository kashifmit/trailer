<div class="trailer-contents">
	
	<div class="row">
		<div class="col-md-6 col-xl-4">
			<div class="trailer-block mb-4 mb-xl-0">
				<header class="heading">
					<h5 class="text-bold">Equipment Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('TrailerSerialNo', 'Trailer Number', ['class' => 'bold']) !!}                    
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? $data->TrailerSerialNo : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('ManufacturerId', 'Make', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? App\Helpers\DataArrayHelper::getMakeName($data->ManufacturerId) : null}}</span>                    
						
					</div>
					<div class="form-group">
						{!! Form::label('ModelYear', 'Year', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? $data->ModelYear : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('ProductId', 'Size', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? $data->ProductId : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('SiteId', 'Location', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? App\Helpers\DataArrayHelper::getSiteName($data->SiteId) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('ConditionStatusId', 'Condition Status', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? App\Helpers\DataArrayHelper::getConditionName($data->ConditionStatusId) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('Owner', 'Owners', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? App\Helpers\DataArrayHelper::getOrganizationName($data->registrationData[0]->Owner) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('business', 'Business', ['class' => 'bold']) !!}
						<span class="trailer-form-text">
							{{(isset($data) && !empty($data)) ? App\Helpers\DataArrayHelper::getBusinessName($data->SiteId) : null}}
						</span>
					</div>

				</div>			
			</div>
		</div>

		<div class="col-md-6 col-xl-4">
			<div class="trailer-block mb-4 mb-xl-0 trailer-block-bg">
				<header class="heading">
					<h5 class="text-bold">Registration Details</h5>
				</header>
				<div class="text">
					<div class="form-group">
						{!! Form::label('VehicleId_VIN', 'Vehicle identification Number', ['class' => 'bold']) !!} 
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? $data->registrationData[0]->VehicleId_VIN : null}}</span>
					</div>

					<div class="form-group">
						{!! Form::label('PlateNo', 'Plate Number', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? $data->registrationData[0]->PlateNo : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('StateAbbreviation', 'State Register', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData) ) ? $data->registrationData[0]->StateAbbreviation : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('TitleNo', 'Title Number', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? $data->registrationData[0]->TitleNo : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('LastInsepctionDate', 'Last Registration', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? date('m/d/Y', strtotime($data->LastInsepctionDate)) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('ExpireDate', 'Last Registration Expire', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->ExpireDate)) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('RegistrationDate', 'Date Acquire', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->registrationData)) ? date('m/d/Y', strtotime($data->registrationData[0]->RegistrationDate)) : null}}</span>
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
						<span class="trailer-form-text">{{(isset($data) && !empty($data)) ? App\Helpers\DataArrayHelper::getTrackingsystemName($data->etrack_id) : null}}</span>
					</div>
					<div class="form-group">
						{!! Form::label('TrackingId', 'Tracking Number', ['class' => 'bold']) !!}
						<span class="trailer-form-text">{{((isset($data) && !empty($data)) && count($data->equipmentTracking) ) ? $data->equipmentTracking[0]->TrackingId : null}}</span>
					</div>			
				</div>
			</div>
		</div>

	</div>

</div>

