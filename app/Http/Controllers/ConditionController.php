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
use App\conditionModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;

class ConditionController extends Controller
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
    	return view('conditions.index');
    }

    public function fetchConditions(Request $request)
    {
    	$conditions = conditionModel::select([
                    'condition_status.ConditionStatusId',
                    'condition_status.ConditionType',
        ]);
        return Datatables::of($conditions)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('ConditionType') && !empty($request->ConditionType)) {
                                $query->where('condition_status.ConditionType', 'like', "%{$request->get('ConditionType')}%");
                            }
                        })
                        ->addColumn('action', function ($conditions) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.condtion', ['ConditionStatusId' => $conditions->ConditionStatusId]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteCondition(' . $conditions->ConditionStatusId . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->setRowId(function($conditions) {
                            return 'conditionDtRow' . $conditions->organizationId;
                        })
                        ->make(true);
    }

    public function addCondition()
    {
    	return view('conditions.add');
    }

    public function storeCondition(Request $request)
    {
    	$validate = $request->validate([
    		'ConditionType' => 'required|unique:condition_status',
    	]);
    	try {
    		$condition = new conditionModel();
	        $condition->ConditionType = $request->input('ConditionType');
	        $condition->save();
	        flash('Condtion Type has been added!')->success();
	        return Redirect::route('add.condition');
    	} catch (\Exception $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function editCondtion($ConditionStatusId)
    {
    	try{
    		$conditionData = conditionModel::where('ConditionStatusId', $ConditionStatusId)->first();
    		return view ('conditions.edit')->with('data', $conditionData);
    	} catch(\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function updateCondition($ConditionStatusId, Request $request)
    {
    	$validate = $request->validate([
    		'ConditionType' => 'required|unique:condition_status',
    	]);

    	try {
    		$condition = conditionModel::where('ConditionStatusId', $ConditionStatusId)->update(['ConditionType' => $request->input('ConditionType')]);
	        flash('Condition Type has been updated successfully!')->success();
	        return Redirect::route('edit.condtion');

    	} catch (\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function deleteCondition(Request $request)
    {
    	$ConditionStatusId = $request->input('ConditionStatusId');
        try {
    		$condition = conditionModel::where('ConditionStatusId', $ConditionStatusId)->first();
            $condition->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }
}
