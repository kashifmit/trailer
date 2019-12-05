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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;


class SiteController extends Controller
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
    	return view('sites.index');
    }

    public function fetchSite()
    {
    	$site = siteModel::select([
                    'site.id', 'site.SiteName', 'site.SteetNo', 'site.StreetName', 'site.SuiteNo', 'site.City', 'site.StateAbbreviation', 'site.site_unique_id',
        ]);
        return Datatables::of($site)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('SiteName') && !empty($request->SiteName)) {
                                $query->where('site.siteName', 'like', "%{$request->get('site')}%");
                            }
                        })
                        ->addColumn('action', function ($site) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.site', ['siteId' => $site->siteId]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deletesite(' . $site->siteId . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->setRowId(function($site) {
                            return 'siteDtRow' . $site->organizationId;
                        })
                        ->make(true);
    }

    public function editSite($id)
    {
    	dd($id);
    }
}
