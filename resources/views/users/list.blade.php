@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 pull-left">{{ __('Users') }}</div>
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-3 pull-right">
                <a href="{{route('create.user')}}" class="btn btn-xs btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add New User
                </a> 
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-container">
            <form method="post" role="form" id="user-search-form">
                <table class="table table-striped table-bordered table-hover"  id="userDatatableAjax">
                    <thead>
                        <td>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="First Name">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="last_name" id="last_name" autocomplete="off" placeholder="Last Name">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="email">
                        </td>
                        <td>
                            {!! Form::select('organization', ['' => 'Select Organization']+$organizations, null, array('class'=>'form-control', 'id'=>'organization')) !!}
                        </td>
                        <td colspan="2">
                            {!! Form::select('role', ['' => 'Select Role']+$roles, null, array('class'=>'form-control', 'id'=>'role')) !!}
                        </td>
                        <tr role="row" class="heading">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>email</th>
                            <th>Organization</th>
                            <th>Role</th>
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

        var oTable = $('#userDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.users') !!}',
            }, columns: [
                {data: 'name', name: 'name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'organization_id', name: 'organization_id'},
                {data: 'Role_id', name: 'Role_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#user-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#last_name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#organization').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#role').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteUser(StateAbbreviation) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.condition') }}", {StateAbbreviation: StateAbbreviation, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#userDatatableAjax').DataTable();
                        table.row('userDtRow' + StateAbbreviation).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

