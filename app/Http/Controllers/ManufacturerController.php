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
use App\ManufacturerModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;

class ManufacturerController extends Controller
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
    
    public function index($value='')
    {
    	return view('manufacturer.index');
    }

    public function fetchmanfacturers(Request $request)
    {
    	$manufacturers = ManufacturerModel::select([
                    'trailer_manufacturer.MakeId',
                    'trailer_manufacturer.MakeName',
        ]);
        return Datatables::of($manufacturers)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('MakeName') && !empty($request->MakeName)) {
                                $query->where('trailer_manufacturer.MakeName', 'like', "%{$request->get('MakeName')}%");
                            }
                        })
                        ->addColumn('action', function ($manufacturers) {
                            
                            return '
				<div class="btn-group">
					<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.condtion', ['ManufacturerId' => $manufacturers->MakeId]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteManufacturer(' . $manufacturers->MakeId . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
					</ul>
				</div>';
                })
                ->setRowId(function($manufacturers) {
                    return 'manufacturerDtRow' . $manufacturers->ManufacturerId;
                })
                ->make(true);
    }

    public function addManufacturer()
    {
    	return view('manufacturer.add');
    }

    public function storeManufacturer(Request $request)
    {
    	
    	$validate = $request->validate([
    		'MakeName' => 'required|unique:trailer_manufacturer',
    	]);
    	try {
    		$manufacturer = new ManufacturerModel();
	        $manufacturer->MakeName = $request->input('MakeName');
	        $manufacturer->save();
	        flash('Manufacturer has been added!')->success();
	        return Redirect::route('add.manufacturer');
    	} catch (\Exception $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function editManufacturer($ManufacturerId)
    {
    	try{
    		$manufacturerData = ManufacturerModel::where('MakeId', $ManufacturerId)->first();
    		return view ('manufacturer.edit')->with('data', $manufacturerData);
    	} catch(\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function updatemanufacturer($ManufacturerId, Request $request)
    {
    	$validate = $request->validate([
    		'MakeName' => 'required|unique:trailer_manufacturer',
    	]);
    	try {
    		$manufacturer = ManufacturerModel::where('MakeId', $ManufacturerId)->update(['MakeName' => $request->input('MakeName')]);
	        flash('Manufacturer has been updated successfully!')->success();
	        return Redirect::route('edit.manufacturer');

    	} catch (\Exception $e) {
			return back()->withError($e->getMessage());
    	}
    }

    public function deleteManufacturer(Request $request)
    {
        $ManufacturerId = $request->input('ManufacturerId');
        try {
            $manufacturer = ManufacturerModel::where('MakeId', $ManufacturerId)->first();
            $manufacturer->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }
}
