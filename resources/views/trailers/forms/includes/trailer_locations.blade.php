<div class="row">&nbsp;</div>

@if(Route::currentRouteName() == 'trailer.list')
{!! Form::open(array('method' => 'get', 'route' => 'search.trailer.location', 'class' => 'form', 'files'=>true, 'id' => 'search_trailer_location')) !!}
<div class="trailer-contents">
    <header class="heading">
        <h3 class="title">Search For a Trailer</h3>
    </header>

    <div class="mb-5">
        <div class="form-group row mb-0">
            <label for="TrailerSerialNo" class="col-md-3 col-form-label text-md-right">{{ __('Trailer Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap">
                    {!! Form::select('TrailerNo', ['' => '--Select Trailer No--']+$getTrailers, null, array('class'=>'form-control form-control-radius', 'id'=>'TrailerNo')) !!}
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('Tracking Unit Id') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap">
                    
                    {!! Form::select('TrailerUnitNo', ['' => '--Tracking Unit Id--']+$getTrackingUnits, null, array('class'=>'form-control form-control-radius', 'id'=>'TrailerUnitNo')) !!}
                </div>
            </div>
            <div class="col-md-3">&nbsp;</div>
        </div>

        <div class="form-group row mb-5">
        	<label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('Location Name') }}</label>
            <div class="col-md-4">
            	 {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, null, array('class'=>'form-control form-control-radius', 'id'=>'SiteId')) !!}
            </div>
        </div>
    </div>
    <div class="form-group row">
    	{!! Form::button('Display', array('class'=>'btn display-map btn-min-md btn-primary submit-class', 'type'=>'button')) !!}
    </div>
</div>
{!! Form::close() !!}
@endif

<div class="row">
	<div class="col-md-12">
		<div class="map-block"  id="map-block">
            {!! Mapper::render() !!}
        </div>
	</div>
</div>
<div class="row">&nbsp;</div>
@if($displayTable)
	@if(count($mapData))
		{!! Form::open(array('method' => 'post', 'route' => 'download.trailer.location.csv', 'class' => 'form', 'files'=>true, 'id' => 'add_trailer')) !!}
		<div class="row">
			<div class="col-md-2">
				<button class="btn btn-large btn-primary edit-class" type="button">Download CSV</button>
			</div>
			<div class="col-md-10">&nbsp;</div>
		</div>
		<div class="row">&nbsp;</div>
	
		<div class="row">
			<table class="table table-striped text-sm table-hover">
				<thead>
		            <tr>
		                <th>Select Trailer</th>
		                <th>Map Id</th>
		                <th>Trailer No</th>
		                <th>Tracking Unit Number</th>
		                <th>Latitude</th>
		                <th>Longitude</th>
		                <th>Closest LandMark</th>
		                <th>State</th>
		                <th>Country</th>
		                <th>Distance From Land Mark</th>
		                <th>Battery Status</th>
		                <th>Motion</th>
		                <th>Time</th>
		            </tr>
	        	</thead>
	        	<tbody>
	        		@if(count($mapData))
	        		@foreach($mapData as $data)
	        		<tr>
	        			<td><input type="radio" name="trailerId" value="{{$data->id}}"></td>
	        			<td>{{$data->id}}</td>
	        			<td>{{$data->TrailerNo}}</td>
	        			<td>{{$data->TrailerUnitNo}}</td>
	        			<td>{{$data->Latitude}}</td>
	        			<td>{{$data->Longitude}}</td>
	        			<td>{{$data->ClosestLandMark}}</td>
	        			<td>{{$data->State}}</td>
	        			<td>{{$data->Country}}</td>
	        			<td>{{$data->DistanceFromLandmark}}</td>
	        			<td>{{$data->BatteryStatus}}</td>
	        			<td>{{$data->Motion_status}}</td>
	        			<td>{{date('m/d/Y H:i:s', strtotime($data->track_date_time))}}</td>
	        		</tr>
	        		@endforeach
	        		@endif
	        	</tbody>
			</table>	
		</div>
		{!! Form::close() !!}
	@endif
@endif