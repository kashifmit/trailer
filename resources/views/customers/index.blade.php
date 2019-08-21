@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Customers') }}</div>
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <a href="{{route('export.customers')}}" class="btn btn-xs btn-success">
                        <i class="fa fa-download"></i>
                        Download CSV
                    </a>
                    <a href="{{route('export.dta')}}" class="btn btn-xs btn-success">
                        <i class="fa fa-download"></i>
                        Download DTA
                    </a> 
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <form method="post" role="form" id="customer-search-form">
                    <table class="table table-striped table-bordered table-hover"  id="customerDatatableAjax">
                        <thead>
                            <td>
                                {!! Form::select('business', ['' => '--Business--']+$buniness, null, array('class'=>'form-control', 'id'=>'business')) !!}
                            </td>
                            <td>                    
                                {!! Form::select('SiteId', ['' => '--Location--']+$sites, null, array('class'=>'form-control', 'id'=>'SiteId')) !!}
                            </td>
                            <td colspan="5">
                                {!! Form::select('CustomerID', ['' => '--Customers--']+$customers, null, array('class'=>'form-control', 'id'=>'CustomerID')) !!}
                            </td>
                            <tr role="row" class="heading">
                                <th>Customer Number</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Drop Trailer Agreement</th>
                                <th>Approved Allocation</th>
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

        var oTable = $('#customerDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            ajax: {
                url: '{!! route('fetch.customer') !!}',
            }, columns: [
                {data: 'CustomerID', name: 'CustomerID'},
                {data: 'ShipToName', name: 'ShipToName'},
                {data: 'ShipToAddress1', name: 'ShipToAddress1'},
                {data: 'ShipToCity', name: 'ShipToCity'},
                {data: 'StateAbbreviation', name: 'StateAbbreviation'},
                {data: 'ShipToAddress2', name: 'ShipToAddress2'},
                {data: 'ShipToAddress3', name: 'ShipToAddress3'}
            ]
        });
        $('#business').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#SiteId').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#CustomerID').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
        // function deleteTrailer(id, is_default) {
        // var msg = 'Are you sure?';
        // if (confirm(msg)) {
        //     $.post("{{ route('delete.organization') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
        //         .done(function (response) {
        //             if (response == 'ok') {
        //                 var table = $('#trailerDatatableAjax').DataTable();
        //                 table.row('trailerDtRow' + id).remove().draw(false);
        //             } else {
        //                 alert('Request Failed!');
        //             }
        //         });
        //     }
        // }
    </script>
@endsection

    

