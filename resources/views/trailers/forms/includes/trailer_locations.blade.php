<div class="row">&nbsp;</div>

<div class="row">
	<div class="col-md-12">
		<div class="map-block">
            {!! Mapper::render() !!}
        </div>
	</div>
</div>
<div class="row">&nbsp;</div>
@if($displayTable)
	@if(count($mapData))
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
        			<td><input type="radio" name="trailerId[]" value="{{$data->id}}"></td>
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
	@endif
@endif