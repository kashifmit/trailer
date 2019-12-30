@if($displayTable)
	@if(count($mapData))
		{!! Form::open(array('method' => 'post', 'route' => 'download.trailer.location.csv', 'class' => 'form', 'files'=>true, 'id' => 'add_trailer')) !!}
		<div class="mt-4 mb-3">
			<button class="btn btn-large btn-primary edit-class" type="submit">Download CSV</button>
		</div>
	@endif
		<div class="table-responsive">
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
		                <th>Date Time</th>
		            </tr>
	        	</thead>
	        	<tbody>
	        		@if(count($mapData))
	        		@foreach($mapData as $data)
	        		<tr>
	        			<td><input type="checkbox" name="trailerId[]" value="{{$data->id}}"></td>
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
	        		@else
	        			<tr><td colspan="100%">No Trailer Found</td></tr>
	        		@endif
	        	</tbody>
			</table>	
		</div>
		{!! Form::close() !!}
@endif