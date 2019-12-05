@if($trailerData)
<div class="table-responsive">
    <table class="table table-striped text-sm table-hover">
        <thead>
            <tr>
                <th>Trailer Number</th>
                <th>Location</th>
                <th>Business</th>
                <th>Make</th>
                <th>VIN Number</th>
                <th>Year</th>
                <th>Licence Plate</th>
                <th>Registration Expiration Date</th>
                <th>Tracking Number</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($trailerData as $data)
            <tr>
                <td>
                    <a class="text-primary text-underline" href="{{route('view.trailer', ['TrailerSerialNo' => $data->TrailerSerialNo])}}">
                        {{$data->TrailerSerialNo}}
                    </a>    
                    </td>
                <td>{{$data->SiteName}}</td>
                <td>{{$data->business ? $data->business : '--'}}</td>
                <td>{{$data->MakeName}}</td>
                <td>{{$data->VehicleId_VIN}}</td>
                <th>{{$data->ModelYear}}</th>
                <th>{{$data->PlateNo}}</th>
                <th>{{date('m/d/Y', strtotime($data->ExpireDate))}}</th>
                <td>
                    <a class="text-primary text-underline" href="{{route('edit.trailer', ['TrailerSerialNo' => $data->TrailerSerialNo])}}">
                        {{$data->TrackingId}}
                    </a>    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@if($trailerData)
    {{ $trailerData->appends(request()->query())->links() }}
@endif