<?php

namespace App\Http\Controllers;

use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\OrganizationModel;
use Illuminate\Http\Request;
// use App\Http\Requests\storeOrganization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;

class OrganizationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('organizations.index');
    }

    public function fetchOrganization(Request $request)
    {
    	
        $organization = OrganizationModel::select([
                    'organization.OrganizationId',
                    'organization.OrgName',
        ]);
        return Datatables::of($organization)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('OrgName') && !empty($request->OrgName)) {
                                $query->where('organization.OrgName', 'like', "%{$request->get('organization')}%");
                            }
                        })
                        ->addColumn('action', function ($organization) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.organization', ['organizationId' => $organization->organizationId]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteOrganization(' . $organization->organizationId . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->setRowId(function($organization) {
                            return 'organizationDtRow' . $organization->organizationId;
                        })
                        ->make(true);
    }

    public function addOrganization()
    {
    	return view('organizations.add');
    }

    public function storeOrganization(Request $request)
    {
    	$validate = $request->validate([
    		'OrgName' => 'required|unique:organization',
    	]);
    	try {
    		$organization = new OrganizationModel();
	        $organization->organizationId = stripslashes(str_replace('/', '', Hash::make($request->input('OrgName'))));
	        $organization->VendorId = Auth::user()->id;
	        $organization->OrgName = $request->input('OrgName');
	        $organization->save();
	        flash('Organization has been added!')->success();
	        return Redirect::route('add.organization');
    	} catch (\Exception $e) {
    		return back()->withError($e->getMessage());
    	}

    }

    public function editOrganization($id)
    {
    	try{
    		$organizationData = OrganizationModel::where('organizationId', $id)->first();
    		return view ('organizations.edit')->with('data', $organizationData);
    	} catch(\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function updateOrganization($id, Request $request)
    {
    	$validate = $request->validate([
    		'OrgName' => 'required|unique:organization',
    	]);
    	try {
    		$organization = OrganizationModel::where('organizationId', $id)->update(['OrgName' => $request->input('OrgName')]);
	        flash('Organization has been updated successfully!')->success();
	        return Redirect::route('edit.organization');

    	} catch (\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function deleteOrganization(Request $request)
    {
        $id = $request->input('id');
        try {
    		$organization = OrganizationModel::where('organizationId', $id)->first();
            $organization->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }
}
