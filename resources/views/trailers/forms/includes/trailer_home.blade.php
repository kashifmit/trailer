<div class="table-container">
                {!! Form::open(array('method' => 'GET', 'route' => 'trailer.list', 'class' => 'form', 'files'=>true)) !!}
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number" value="{{\Request::get('TrailerSerialNo')}}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number" value="{{\Request::get('VehicleId_VIN')}}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('business', ['' => '--All business System--']+$business, \Request::get('business') ? \Request::get('business') : null, array('class'=>'form-control', 'id'=>'business')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('SiteId', ['' => '--All Locations--']+$locations, \Request::get('SiteId') ? \Request::get('SiteId') : null, array('class'=>'form-control', 'id'=>'SiteId')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::button('Find <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="row">&nbsp;</div>
                @if($trailerData)
                <table class="table table-striped table-bordered table-hover">
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