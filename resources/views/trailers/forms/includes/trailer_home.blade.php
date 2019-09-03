<div class="trailer-contents">
    {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true)) !!}

    <div class="mb-5">
        <div class="form-group row">
            <label for="TrailerSerialNo" class="col-md-3 col-form-label text-md-right">{{ __('Trailer Number') }}</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number" value="{{\Request::get('TrailerSerialNo')}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('VIN Number') }}</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number" value="{{\Request::get('VehicleId_VIN')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="TrackingId" class="col-md-3 col-form-label text-md-right">{{ __('Tracking Number') }}</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
            </div>
        </div>

        <div class="form-group row mb-5">
            <div class="col-md-3  offset-md-3">
                {!! Form::select('business', ['' => '--All business System--']+$business, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control', 'id'=>'business')) !!}
            </div>
            <div class="col-md-3">
                {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control', 'id'=>'SiteId')) !!}
            </div>
            <div class="col-md-3">
                {!! Form::button('Find', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
            </div>
        </div>

    </div>
    {!! Form::close() !!}


    @if($trailerData)
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
                    <a href="{{route('edit.trailer', ['TrailerSerialNo' => $data->TrailerSerialNo])}}">
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
                    <a href="{{route('edit.trailer', ['TrailerSerialNo' => $data->TrailerSerialNo])}}">
                        {{$data->TrackingId}}
                    </a>    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @if($trailerData)
        <div class="pull-right">
            {{ $trailerData->appends(request()->query())->links() }}
        </div>
    @endif
</div>