@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 pull-left">{{ __('States') }}</div>
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-3 pull-right">
                <a href="{{route('add.state')}}" class="btn btn-xs btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add New State
                </a> 
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-container">
            <form method="post" role="form" id="state-search-form">
                <table class="table table-striped table-bordered table-hover"  id="stateDatatableAjax">
                <thead>
                        <td>
                            <input type="text" class="form-control" name="StateAbbreviation" id="StateAbbreviation" autocomplete="off" placeholder="State Abbrivation">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="StateName" id="StateName" autocomplete="off" placeholder="State Name">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control" name="Country" id="Country" autocomplete="off" placeholder="Country">
                        </td>
                        <tr role="row" class="heading">
                            <th>State Abbrivation</th>
                            <th>State Name</th>
                            <th>Country</th>
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

        var oTable = $('#stateDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.states') !!}',
            }, columns: [
                {data: 'StateAbbreviation', name: 'StateAbbreviation'},
                {data: 'StateName', name: 'StateName'},
                {data: 'Country', name: 'Country'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#state-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#StateAbbreviation').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#StateName').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#Country').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteState(StateAbbreviation) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.condition') }}", {StateAbbreviation: StateAbbreviation, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#stateDatatableAjax').DataTable();
                        table.row('stateDtRow' + StateAbbreviation).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

