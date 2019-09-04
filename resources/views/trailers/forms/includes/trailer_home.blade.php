<div class="trailer-contents">
    {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true)) !!}

    <header class="heading">
        <h3 class="title">Search For a Trailer</h3>
    </header>

    <div class="mb-5">
        <div class="form-group row mb-0">
            <label for="TrailerSerialNo" class="col-md-3 col-form-label text-md-right">{{ __('Trailer Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number" value="{{\Request::get('TrailerSerialNo')}}">
                </div>
            </div>
            <div class="col-md-3">
                {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'button')) !!}
            </div>
        </div>

        <div class="mt-4 mb-4">Or</div>

        <div class="form-group row mb-0">
            <label for="VehicleId_VIN" class="col-md-3 col-form-label text-md-right">{{ __('VIN Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number" value="{{\Request::get('VehicleId_VIN')}}">
                </div>
            </div>
            <div class="col-md-3">
            {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'button')) !!}
            </div>
        </div>

        <div class="mt-4 mb-4">Or</div>

        <div class="form-group row mb-0">
            <label for="TrackingId" class="col-md-3 col-form-label text-md-right">{{ __('Tracking Number') }}</label>
            <div class="col-md-3">
                <div class="form-control-wrap search">
                    <input type="text" class="form-control form-control-radius" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
                </div>
            </div>
            <div class="col-md-3">
            {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'button')) !!}
            </div>
        </div>

        <header class="heading mt-5">
            <h3 class="title">Search For a Trailer by Location & Business</h3>
        </header>

        <div class="form-group row mb-5">
            <div class="col-md-4">
                {!! Form::select('business', ['' => '--All business System--']+$business, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control form-control-radius', 'id'=>'business')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control form-control-radius', 'id'=>'SiteId')) !!}
            </div>
            <div class="col-md-4">
                {!! Form::button('Find', array('class'=>'btn btn-min-md btn-primary', 'type'=>'submit')) !!}
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