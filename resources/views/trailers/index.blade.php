@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Trailers') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('create.trailer')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add Trailer
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
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
                        {!! Form::select('etrack_id', ['' => '--Etracking System--']+$etrack_id, \Request::get('etrack_id') ? \Request::get('etrack_id') : null, array('class'=>'form-control', 'id'=>'etrack_id')) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('ManufacturerId', ['' => '--Make--']+$getMakes, \Request::get('ManufacturerId') ? \Request::get('ManufacturerId') : null, array('class'=>'form-control', 'id'=>'ManufacturerId')) !!}
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number" value="{{\Request::get('TrackingId')}}">
                    </div>
                    <div class="col-md-2">
                        {!! Form::button('Find <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="row">&nbsp;</div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Trailer Number</th>
                            <th>VIN Number</th>
                            <th>ETracking System</th>
                            <th>Make</th>
                            <th>Tracking Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($trailerData))
                        @foreach($trailerData as $data)
                        <tr>
                            <td>{{$data->TrailerSerialNo}}</td>
                            <td>{{$data->VehicleId_VIN}}</td>
                            <td>{{$data->ETrackDescription}}</td>
                            <td>{{$data->MakeName}}</td>
                            <td>{{$data->TrackingId}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('edit.trailer', ['TrailerSerialNo' => $data->TrailerSerialNo])}}"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if(count($trailerData))
                    <div class="pull-right">{{$trailerData->links()}}</div>
                @endif
            </div>
        </div>
    </div>
@endsection

    

