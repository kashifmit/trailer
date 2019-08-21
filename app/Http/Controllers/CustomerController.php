<?php

namespace App\Http\Controllers;

use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use App\CustomerModel;
use Carbon\Carbon;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;
use App\Exports\CustomerExport;
use App\Exports\DTAExport;
use Maatwebsite\Excel\Facades\Excel;


class CustomerController extends Controller
{
    public function index()
    {
    	return view('customers.index')
    	->with('buniness', DataArrayHelper::getOrganizations())
    	->with('sites', DataArrayHelper::getSites())
    	->with('customers', DataArrayHelper::getCustomers());
    }

    public function fetchCustomers(Request $request)
    {
    	$customers = CustomerModel::select([
    		'customer.CustomerID',
    		'customer.ShipToName',
    		'customer.ShipToAddress1',
    		'customer.ShipToCity',
    		'customer.StateAbbreviation',
    		'customer.ShipToAddress2',
    		'customer.ShipToAddress3',
    	]);

    	return Datatables::of($customers)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('CustomerID') && !empty($request->CustomerID)) {
                                $query->where('customer.CustomerID', 'like', "%{$request->get('CustomerID')}%");
                            }
                            if ($request->has('SiteId') && !empty($request->SiteId)) {
                                $query->where('customer.SiteId', 'like', "%{$request->get('SiteId')}%");
                            }
                            if ($request->has('business') && !empty($request->business)) {
                                $query->where('customer.business', 'like', "%{$request->get('business')}%");
                            }
                        })
                        ->addColumn('ShipToAddress2', function ($customers) {
                    		return "<input type='chekcbox'>";
                		})
                		->addColumn('ShipToAddress3', function ($customers) {
                    		return '3';
                		})
                        ->addColumn('action', function ($customers) {
                            
    //                         return '
				// <div class="btn-group">
				// 	<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
				// 		<i class="fa fa-angle-down"></i>
				// 	</button>
				// 	<ul class="dropdown-menu">
				// 		<li>
				// 			<a href="' . route('edit.user', ['organizationId' => $customers->TrailerSerialNo]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
				// 		</li>						
				// 		<li>
				// 			<a href="javascript:void(0);" onclick="deleteTrailer(' . $customers->TrailerSerialNo . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
				// 		</li>
				// 	</ul>
				// </div>';
                        })
                        ->setRowId(function($customers) {
                            return 'organizationDtRow' . $customers->CustomerID;
                        })
                        ->make(true);
    }

    public function exportCustomer()
    {
    	return Excel::download(new CustomerExport, 'customers_'.\Carbon\Carbon::now().'.xlsx');
    }

    public function exportDTA()
    {
    	return Excel::download(new DTAExport, 'DTA_'.\Carbon\Carbon::now().'.xlsx');
    }
}
