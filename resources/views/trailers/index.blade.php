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
                <form method="post" role="form" id="trailer-search-form">
                    <table class="table table-striped table-bordered table-hover"  id="trailerDatatableAjax">
                        <thead>
                            <td>
                                <input type="text" class="form-control" name="TrailerSerialNo" id="TrailerSerialNo" autocomplete="off" placeholder="Trailer Number">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="VehicleId_VIN" id="VehicleId_VIN" autocomplete="off" placeholder="VIN Number">
                            </td>
                            <td>
                                {!! Form::select('etrack_id', ['' => '--Etracking System--']+$etrack_id, isset($data) ? $data->location : null, array('class'=>'form-control', 'id'=>'etrack_id')) !!}
                            </td>
                            <td>                    
                                {!! Form::select('ManufacturerId', ['' => '--Make--']+$getMakes, isset($data) ? $data->getMakes : null, array('class'=>'form-control', 'id'=>'ManufacturerId')) !!}
                            </td>
                            <td colspan="2">
                                <input type="text" class="form-control" name="TrackingId" id="TrackingId" autocomplete="off" placeholder="Tracking Number">
                                
                            </td>
                            <tr role="row" class="heading">
                                <th>Trailer Number</th>
                                <th>VIN Number</th>
                                <th>ETracking System</th>
                                <th>Make</th>
                                <th>Tracking Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>    
                </form>
            </div>
        </div>
    </div>
<script>
        $(function () {

        var oTable = $('#trailerDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.trailer') !!}',
            }, columns: [
                {data: 'TrailerSerialNo', name: 'TrailerSerialNo'},
                {data: 'VehicleId_VIN', name: 'VehicleId_VIN'},
                {data: 'etrack_id', name: 'etrack_id'},
                {data: 'ManufacturerId', name: 'ManufacturerId'},
                {data: 'TrackingId', name: 'TrackingId'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#trailer-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#TrailerSerialNo').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#VehicleId_VIN').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#etrack_id').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#ManufacturerId').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#TrackingId').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteTrailer(id, is_default) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.organization') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#trailerDatatableAjax').DataTable();
                        table.row('trailerDtRow' + id).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

