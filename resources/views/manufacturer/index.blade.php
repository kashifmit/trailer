@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Manufacturer') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('add.manufacturer')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add New Manufacturer
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <form method="post" role="form" id="manufacturer-search-form">
                    <table class="table table-striped table-bordered table-hover"  id="manufacturerDatatableAjax">
                        <thead>
                            <td colspan="2">
                                <input type="text" class="form-control" name="MakeName" id="MakeName" autocomplete="off" placeholder="Manufacturer Name">
                            </td>
                            <tr role="row" class="heading">
                                <th>Manufacturer Name</th>
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

        var oTable = $('#manufacturerDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.manufacturers') !!}',
            }, columns: [
                {data: 'MakeName', name: 'MakeName'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#manufacturer-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#MakeName').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteManufacturer(ManufacturerId) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.manufacturer') }}", {ManufacturerId: ManufacturerId, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#manufacturerDatatableAjax').DataTable();
                        table.row('manufacturerDtRow' + ManufacturerId).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

