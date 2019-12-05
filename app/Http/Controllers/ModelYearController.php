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
use App\modelYearModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;


class ModelYearController extends Controller
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
    	return view('model_year.index');
    }

    public function fetchModelYears(Request $request)
    {
    	$modelYear = modelYearModel::select([
                    'model_year.ModelYear',
        ]);
        return Datatables::of($modelYear)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('ModelYear') && !empty($request->ModelYear)) {
                                $query->where('model_year.ModelYear', 'like', "%{$request->get('ModelYear')}%");
                            }
                        })
                        ->addColumn('action', function ($modelYear) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.model.year', ['ModelYear' => $modelYear->ModelYear]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteModelYear(' . $modelYear->ModelYear . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                        })
                        ->setRowId(function($modelYear) {
                            return 'modelYearDtRow' . $modelYear->ModelYear;
                        })
                        ->make(true);
    }

    public function addOrModel($value='')
    {
    	return view('model_year.add');
    }

    public function storeModel(Request $request)
    {
    	$validate = $request->validate([
    		'ModelYear' => 'required|unique:model_year|numeric',
    	]);

    	try {
    		$model = new modelYearModel();
	        
	        $model->ModelYear = $request->input('ModelYear');
	        $model->save();
	        flash('Model Year has been added!')->success();
	        return Redirect::route('add.model');
    	} catch (\Exception $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function editModel($ModelYear)
    {
    	try{
    		$model = modelYearModel::where('ModelYear', $ModelYear)->first();
    		return view ('model_year.edit')->with('data', $model);
    	} catch(\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function updatemodel($model_year, Request $request)
    {
    	$validate = $request->validate([
    		'ModelYear' => 'required|unique:model_year|numeric',
    	]);
    	try {
    		$model = modelYearModel::where('ModelYear', $model_year)->update(['ModelYear' => $request->input('ModelYear')]);
	        flash('Model has been updated successfully!')->success();
	        return Redirect::route('edit.model.year');

    	} catch (\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function deleteModel(Request $request)
    {
    	$modelYear = $request->input('modelYear');
        try {
    		$model = modelYearModel::where('ModelYear', $modelYear)->first();
            $model->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }
}
