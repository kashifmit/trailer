@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 pull-left">{{ __('Condition Types') }}</div>
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-3 pull-right">
                <a href="{{route('add.condition')}}" class="btn btn-xs btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add New Condition Type
                </a> 
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-container">
            <form method="post" role="form" id="condition-search-form">
                <table class="table table-striped table-bordered table-hover"  id="conditionDatatableAjax">
                    <thead>
                        <td colspan="2">
                            <input type="text" class="form-control" name="ConditionType" id="ConditionType" autocomplete="off" placeholder="Condition Type">
                        </td>
                        <tr role="row" class="heading">
                            <th>Condition Type</th>
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

        var oTable = $('#conditionDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.conditions') !!}',
            }, columns: [
                {data: 'ConditionType', name: 'ConditionType'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#condition-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#ConditionType').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteCondition(ConditionStatusId) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.condition') }}", {ConditionStatusId: ConditionStatusId, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#conditionDatatableAjax').DataTable();
                        table.row('conditionDtRow' + ConditionStatusId).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

