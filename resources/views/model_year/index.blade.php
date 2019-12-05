@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Model Year') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('add.model')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add New Model
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <form method="post" role="form" id="model-search-form">
                    <table class="table table-striped table-bordered table-hover"  id="modelDatatableAjax">
                        <thead>
                            <td colspan="2">
                                <input type="text" class="form-control" name="ModelYear" id="ModelYear" autocomplete="off" placeholder="model Year">
                            </td>
                            <tr role="row" class="heading">
                                <th>Model</th>
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

        var oTable = $('#modelDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.model.years') !!}',
            }, columns: [
                {data: 'ModelYear', name: 'ModelYear'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#model-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#ModelYear').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        function deleteModelYear(modelYear) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.model') }}", {modelYear: modelYear, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok') {
                        var table = $('#modelDatatableAjax').DataTable();
                        table.row('modelYearDtRow' + modelYear).remove().draw(false);
                    } else {
                        alert('Request Failed!');
                    }
                });
            }
        }
    </script>
@endsection

    

