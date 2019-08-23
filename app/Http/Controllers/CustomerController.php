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
        $data = new CustomerModel();

        if (!empty($request->query('business'))) {
            $data = $data->where('business','like', "%{$request->query('business')}%");
        }

        if (!empty($request->query('SiteId'))) {
            $data = $data->where('SiteId','like', "%{$request->query('SiteId')}%");
        }

        if (!empty($request->query('CustomerID'))) {
            $data = $data->where('CustomerID','like', "%{$request->query('CustomerID')}%");
        }

        $data = $data->paginate(20);
        return view('customers.index')
        ->with('Alldata', $data)
    	->with('buniness', DataArrayHelper::getOrganizations())
    	->with('sites', DataArrayHelper::getSites())
    	->with('customers', DataArrayHelper::getCustomers());
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
