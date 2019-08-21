@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Sites') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('add.organization')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add New Site
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <form method="post" role="form" id="organization-search-form">
                    <table class="table table-striped table-bordered table-hover"  id="organizationsDatatableAjax">
                        <thead>
                            <td colspan="2">
                                <input type="text" class="form-control" name="organization" id="organization" autocomplete="off" placeholder="Organization Name">
                            </td>
                            <tr role="row" class="heading">
                                <th>Site Name</th>
                                <th>Steet No</th>
                                <th>Street Name</th>
                                <th>Suite No</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Invite</th>
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

        var oTable = $('#organizationsDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.organization.list') !!}',
            }, columns: [
                {data: 'organizationName', name: 'organizationName'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#organization-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#organization').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteOrganization(id, is_default) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.organization') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#organizationsDatatableAjax').DataTable();
                        table.row('organizationDtRow' + id).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

