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
use App\StateModel;
use DataTables;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StateController extends Controller
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
    	return view('states.index');
    }

    public function fetchStates(Request $request)
    {
    	$states = StateModel::select([
                    'state.StateAbbreviation',
                    'state.StateName',
                    'state.Country',
        ]);
        return Datatables::of($states)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('StateAbbreviation') && !empty($request->StateAbbreviation)) {
                                $query->where('state.StateAbbreviation', 'like', "%{$request->get('StateAbbreviation')}%");
                            }
                            if ($request->has('StateName') && !empty($request->StateName)) {
                                $query->where('state.StateName', 'like', "%{$request->get('StateName')}%");
                            }
                            if ($request->has('Country') && !empty($request->Country)) {
                                $query->where('state.Country', 'like', "%{$request->get('Country')}%");
                            }
                        })
                        ->addColumn('action', function ($states) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.state', ['StateAbbreviation' => $states->StateAbbreviation]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteState(' . $states->StateAbbreviation . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->setRowId(function($states) {
                            return 'stateDtRow' . $states->StateAbbreviation;
                        })
                        ->make(true);
    }

    public function addState()
    {
    	return view('states.add');
    }

    public function storeState(Request $request)
    {
    	$validate = $request->validate([
    		'StateAbbreviation' => 'required|unique:state',
    		'StateName' => 'required|unique:state',
    		'Country' => 'required',
    	]);
    	$state = new StateModel();
    	try {
    		$state->StateAbbreviation = $request->input('StateAbbreviation');
	    	$state->StateName = $request->input('StateName');
	    	$state->Country = $request->input('Country');
	    	$state->save();
	    	flash('State has been added!')->success();
	        return Redirect::route('add.state');
    	} catch(QueryException $e) {
    		return back()->withError($e->getMessage());
    	}
    }
    public function editState($StateAbbreviation)
    {
    	try {
    		$stateData = StateModel::where('StateAbbreviation', $StateAbbreviation)->first();
    		return view ('states.edit')->with('data', $stateData);
    	} catch (QueryException $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function updateState($StateAbbreviation, Request $request)
    {
    	$validate = $request->validate([
    		'StateAbbreviation' => 'required|unique:state',
    		'StateName' => 'required|unique:state',
    		'Country' => 'required',
    	]);
    	try {
    		$updateState = StateModel::where('StateAbbreviation', $StateAbbreviation)->update([
    			'StateAbbreviation' => $request->input('StateAbbreviation'),
    			'StateName' => $request->input('StateName'),
				'Country' => $request->input('Country')
    		]);
    		flash('State has been updated successfully!')->success();
	        return Redirect::route('edit.state');
    	} catch(QueryException $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function deleteState(Request $request)
    {
    	$StateAbbreviation = $request->input('StateAbbreviation');
        try {
    		$state = StateModel::where('StateAbbreviation', $StateAbbreviation)->first();
            $state->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }
}
