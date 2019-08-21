@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 pull-left">{{ __('Invoices') }}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-5 pull-right">
                    <a href="{{route('create.invoice')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Add Invoice
                    </a>
                    <a href="{{route('create.trailer')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Download Header CSV
                    </a>
                    <a href="{{route('create.trailer')}}" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                        Download Line Item CSV
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover"  id="invoices">
                    <tr>
                        <thead>
                            <th>View Invoice</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Vendor</th>
                            <th>Labor Total</th>
                            <th>Parts Total</th>
                            <th>Accessories Total</th>
                            <th>Annual Inspection Total</th>
                            <th>Registration</th>
                            <th>Tax</th>
                            <th>Total Invoice</th>
                        </thead>
                    </tr>
                    <tbody>
                        @if(count($data))
                            @foreach($data as $single)
                                <tr>
                                    <td><a href="{{route('edit.invoice', ['InvoiceNo' => $single->InvoiceNo])}}">{{$single->InvoiceNo}}</a></td>
                                    <td>{{$single->InvoiceNo}}</td>
                                    <td>{{date('m/d/Y', strtotime($single->InvoiceDate))}}</td>
                                    <td>{{$single->VendorName}}</td>
                                    <td>{{$single->LaborTotal}}</td>
                                    <td>{{$single->PartsTotal}}</td>
                                    <td>{{$single->AccessoriesTotal}}</td>
                                    <td>{{$single->AnnualInspectionTotal}}</td>
                                    <td>{{$single->RegistrationTotal}}</td>
                                    <td>{{$single->SalesTax}}</td>
                                    <td>{{$single->TotalPrice}}</td>
                                </tr>
                            @endforeach    
                        @endif
                    </tbody>
                </table>
                @if(count($data))
                    <div class="pull-right">{{$data->links()}}</div>
                @endif
            </div>
        </div>
    </div>
<script>
    //     $(function () {

    //     var oTable = $('#trailerDatatableAjax').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         stateSave: true,
    //         searching: false,
    //         ajax: {
    //             url: '{!! route('fetch.trailer') !!}',
    //         }, columns: [
    //             {data: 'TrailerSerialNo', name: 'TrailerSerialNo'},
    //             {data: 'VehicleId_VIN', name: 'VehicleId_VIN'},
    //             {data: 'etrack_id', name: 'etrack_id'},
    //             {data: 'ManufacturerId', name: 'ManufacturerId'},
    //             {data: 'TrackingId', name: 'TrackingId'},
    //             {data: 'action', name: 'action', orderable: false, searchable: false}
    //         ]
    //     });
    //     $('#trailer-search-form').on('submit', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    //     $('#TrailerSerialNo').on('keyup', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    //     $('#VehicleId_VIN').on('keyup', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    //     $('#etrack_id').on('change', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    //     $('#ManufacturerId').on('change', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    //     $('#TrackingId').on('keyup', function (e) {
    //         oTable.draw();
    //         e.preventDefault();
    //     });
    // });
    //     function deleteTrailer(id, is_default) {
    //     var msg = 'Are you sure?';
    //     if (confirm(msg)) {
    //         $.post("{{ route('delete.organization') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
    //             .done(function (response) {
    //                 if (response == 'ok') {
    //                     var table = $('#trailerDatatableAjax').DataTable();
    //                     table.row('trailerDtRow' + id).remove().draw(false);
    //                 } else {
    //                     alert('Request Failed!');
    //                 }
    //             });
    //         }
    //     }
    </script>
@endsection

    

