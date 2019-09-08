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
use App\Exports\CustomerExport;
use App\Exports\DTAExport;
use Maatwebsite\Excel\Facades\Excel;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
        
       try {
            $data = "";
        if (!empty($request->query('CustomerID')) || !empty($request->query('business')) || !empty($request->query('SiteId')) || !empty($request->query('pressSubmit')) ) {
            $data = CustomerModel::select([
                'customer.CustomerID', 'customer.ShipToName', 'customer.ShipToAddress1', 'customer.ShipToCity', 'customer.StateAbbreviation', 'site.SiteName','site_services_cust_tbl.SiteId', 'site_services_cust_tbl.CustomerNo'
            ])
            ->join('site_services_cust_tbl', 'customer.CustomerID', '=', 'site_services_cust_tbl.CustomerNo')
            ->join('site', 'site_services_cust_tbl.SiteId', '=', 'site.SiteId');
        }

       if (!empty($request->query('CustomerID'))) {
            $data = $data->where('customer.CustomerID', $request->query('CustomerID'));
        }

        if (!empty($request->query('business'))) {
            $data = $data->where('site.Division', $request->query('business'));
        }

        if (!empty($request->query('SiteId'))) {
            $data = $data->where('site_services_cust_tbl.SiteId', $request->query('SiteId'));
        }

        if ( (!empty($request->query('CustomerID')) && !empty($request->query('business'))) && 
            empty($request->query('SiteId')) ) {
            $data = $data->where('customer.CustomerID', $request->query('CustomerID'))->where('site.Division', $request->query('business'));
        }

        if ( (!empty($request->query('CustomerID')) && !empty($request->query('SiteId'))) && 
            empty($request->query('business')) ) {
            $data = $data->where('customer.CustomerID', $request->query('CustomerID'))->where('site_services_cust_tbl.SiteId', $request->query('SiteId'));
        }

        if ( (!empty($request->query('business')) && !empty($request->query('SiteId'))) && empty($request->query('CustomerID'))  ) {
            $data = $data->where('site.Division', $request->query('business'))->where('site_services_cust_tbl.SiteId', $request->query('SiteId'));
        }

        if ( !empty($request->query('business')) && !empty($request->query('SiteId')) && !empty($request->query('CustomerID'))  ) {
            $data = $data->where('customer.CustomerID', $request->query('CustomerID'))->where('site.Division', $request->query('business'))->where('site_services_cust_tbl.SiteId', $request->query('SiteId'));
        }

        if (!empty($request->query('CustomerID')) || !empty($request->query('business')) || !empty($request->query('SiteId')) || !empty($request->query('pressSubmit'))) {
            $data = $data->paginate(20);
        }
        return view('customers.index')
        ->with('Alldata', $data)
        ->with('buniness', DataArrayHelper::businessList())
        ->with('sites', DataArrayHelper::getSites())
        ->with('customers', DataArrayHelper::getCustomers());

       } catch(\Exception $e) {
        print_r($e->getMessage().$e->getLine());
       }
        
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
