<?php

namespace App\Http\Controllers;
use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use App\EquipmentModel;
use App\TrailerFilesModel;
use App\RegistrationModel;
use App\EquipmentTrackingModel;
use App\SiteModel;
use Carbon\Carbon;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DataTables;

class TrailerController extends Controller
{
    public function index(Request $request)
    {
        $trailerData = EquipmentModel::select([
            'equipment.TrailerSerialNo',
            'registration.VehicleId_VIN',
            'equipment.etrack_id',
            'equipment.ManufacturerId',
            'equipment_tracking.TrackingId',
            'etrack.ETrackDescription',
            'trailer_manufacturer.MakeName'    
        ])
        ->join('registration', 'equipment.TrailerSerialNo', '=', 'registration.TrailerSerialNo')
        ->join('equipment_tracking', 'equipment.TrailerSerialNo', '=', 'equipment_tracking.TrailerSerialNo')
        ->join('etrack', 'equipment.etrack_id', '=', 'etrack.ETrackId')
        ->join('trailer_manufacturer', 'equipment.ManufacturerId', '=', 'trailer_manufacturer.MakeId');
        
        if (!empty($request->query('TrailerSerialNo'))) {
            $trailerData = $trailerData->where('equipment.TrailerSerialNo','like', "%{$request->query('TrailerSerialNo')}%");
        }

        if (!empty($request->query('VehicleId_VIN'))) {
            $trailerData = $trailerData->where('registration.VehicleId_VIN', 'like', "%{$request->query('VehicleId_VIN')}%");
        }

        if (!empty($request->query('etrack_id'))) {
            $trailerData = $trailerData->where('equipment.etrack_id', 'like', "%{$request->query('etrack_id')}%");
        }

        if (!empty($request->query('ManufacturerId'))) {
            $trailerData = $trailerData->where('equipment.ManufacturerId', 'like', "%{$request->query('ManufacturerId')}%");
        }

        if (!empty($request->query('TrackingId'))) {
            $trailerData = $trailerData->where('equipment_tracking.TrackingId', 'like', "%{$request->query('TrackingId')}%");
        }

        $trailerData = $trailerData->paginate(20);
    	return view('trailers.index')
        ->with('trailerData', $trailerData)
    	->with('getMakes', DataArrayHelper::getMakes())
    	->with('etrack_id', DataArrayHelper::getTrackingsystems());
    }

    public function createtriler()
    {
    	return view('trailers.add')
    	->with('etracking', DataArrayHelper::getTrackingsystems())
    	->with('make', DataArrayHelper::getMakes())
    	->with('year', DataArrayHelper::getModelYears())
    	->with('state', DataArrayHelper::getState())
    	->with('size', DataArrayHelper::getTrailerSizes())
    	->with('locations', DataArrayHelper::getSites())
    	->with('conditions', DataArrayHelper::getCondition())
    	->with('owners', DataArrayHelper::getOrganizations())
    	->with('business', DataArrayHelper::businessList());
    }

    public function storetriler(Request $request)
    {
    	$validate = $request->validate([
    		'TrailerSerialNo' => 'required|unique:equipment',
    		'ProductId' => 'required',
    		'SiteId' => 'required',
    		'ConditionStatusId' => 'required',
    		'VehicleId_VIN' => 'required|unique:registration',
    		'ExpireDate' => 'required',
    		'TitleNo' => 'required',
    		'RegistrationDate' => 'required',
    		'Owner' => 'required',
    		'TrackingId' => 'required|unique:equipment_tracking',
    		'etrack_id' => 'required',
    		'FileName.*' => 'required',

    	]);
    	try {
    		$equipment = new EquipmentModel();
	    	$equipment->TrailerSerialNo = $request->input('TrailerSerialNo');
	    	$equipment->ProductId = $request->input('ProductId');
	    	$equipment->SiteId = $request->input('SiteId');
	    	$equipment->ConditionStatusId = $request->input('ConditionStatusId');
	    	$equipment->save();
            $this->upDateEquipment($equipment->TrailerSerialNo, $request);
	    	$EquipmentTracking = new EquipmentTrackingModel();
	    	$EquipmentTracking->TrackingId = $request->input('TrackingId');
	    	$EquipmentTracking->TrailerSerialNo = $equipment->TrailerSerialNo;
	    	$EquipmentTracking->trackingProvider = $request->input('etrack_id');
	    	$EquipmentTracking->save();
            $this->updateTracking($equipment->TrailerSerialNo, $request);
	    	$registration = new RegistrationModel();
            $registration->VehicleId_VIN = $request->input('VehicleId_VIN');
	    	$registration->TrailerSerialNo = $equipment->TrailerSerialNo;
	    	$registration->save();
            $this->updateRegistration($equipment->TrailerSerialNo, $request);
    		$this->uploadDocuments($equipment->TrailerSerialNo, $registration->VehicleId_VIN, $request);
	    	flash('Trailer has been added!')->success();
		    return Redirect::route('create.trailer');
    	} catch (ModelNotFoundException $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function editTrailer($TrailerSerialNo)
    {
    	$data = EquipmentModel::with(['equipmentTracking', 'registrationData', 'filesData'])->where('TrailerSerialNo', $TrailerSerialNo)->get();
    	return view('trailers.edit')
    	->with('data', $data[0])
    	->with('etracking', DataArrayHelper::getTrackingsystems())
    	->with('make', DataArrayHelper::getMakes())
    	->with('year', DataArrayHelper::getModelYears())
    	->with('state', DataArrayHelper::getState())
    	->with('size', DataArrayHelper::getTrailerSizes())
    	->with('locations', DataArrayHelper::getSites())
    	->with('conditions', DataArrayHelper::getCondition())
    	->with('owners', DataArrayHelper::getOrganizations())
    	->with('business', DataArrayHelper::businessList());
    }

    public function updateTrailer($TrailerSerialNo, Request $request)
    {
        $validate = $request->validate([
            'ProductId' => 'required',
            'SiteId' => 'required',
            'ConditionStatusId' => 'required',
            'ExpireDate' => 'required',
            'TitleNo' => 'required',
            'RegistrationDate' => 'required',
            'Owner' => 'required',
            'etrack_id' => 'required',
            'FileName.*' => 'required',

        ]);
        try {
            $this->upDateEquipment($TrailerSerialNo, $request);
            $this->updateTracking($TrailerSerialNo, $request);
            $this->updateRegistration($TrailerSerialNo, $request);
            $this->uploadDocuments($TrailerSerialNo, $request->input('VehicleId_VIN'), $request);
            flash('Trailer has been updated successfully!')->success();
            return Redirect::route('edit.trailer', ['TrailerSerialNo' => $TrailerSerialNo]);
        } catch (QueryException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function dowLoadFile($id)
    {
    	$file = TrailerFilesModel::where('Id', $id)->firstOrFail();
    	$pathToFile = public_path('docs/'. $file->FileName);
    	return response()->download($pathToFile);
    }

    private function upDateEquipment($TrailerSerialNo, $request)
    {
       $equipment = EquipmentModel::where('TrailerSerialNo', $TrailerSerialNo)->update(['ManufacturerId' => $request->input('ManufacturerId'),
        'ModelYear' => $request->input('ModelYear'),
        'ProductId' => $request->input('ProductId'),
        'SiteId' => $request->input('SiteId'),
        'ConditionStatusId' => $request->input('ConditionStatusId'),
        'etrack_id' => $request->input('etrack_id'),
        'LastInsepctionDate' => date('Y-m-d', strtotime($request->input('LastInsepctionDate'))),
        'business' => $request->input('business')
        ]);
    }

    private function updateTracking($TrailerSerialNo, $request)
    {
        $EquipmentTracking = EquipmentTrackingModel::where('TrailerSerialNo', $TrailerSerialNo)->update([
            'TrackingId' => $request->input('TrackingId'),
            'trackingProvider' => $request->input('etrack_id')
        ]);
        
    }

    private function updateRegistration($TrailerSerialNo, $request)
    {
        $registration = RegistrationModel::where('TrailerSerialNo', $TrailerSerialNo)->update([
            'PlateNo' => $request->input('PlateNo'),
            'StateAbbreviation' => $request->input('StateAbbreviation'),
            'TitleNo' => $request->input('TitleNo'),
            'ExpireDate' => date('Y-m-d', strtotime($request->input('ExpireDate'))),
            'RegistrationDate' => date('Y-m-d', strtotime($request->input('RegistrationDate'))),
            'Owner' => $request->input('Owner')
        ]);
    }

    private function uploadDocuments($TrailerSerialNo, $VehicleId_VIN, $request) {
        foreach ($request->input('DocType') as $index => $value) {
            if (isset($request->input('Id')[$index])) {
                if (!empty($request->file('FileName')[$index])) {
                    $uploadFiles = TrailerFilesModel::where('Id', $request->input('Id')[$index])->first();
                    $this->removeDocs($uploadFiles->FileName);
                    $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName')[$index], 'trailersdocs');
                    TrailerFilesModel::where('Id', $request->input('Id')[$index])->update([
                        'FileName' => $fileName,
                        'mimetype' => $request->file('FileName')[$index]->getClientOriginalExtension()
                    ]);
                }
            } else {
                if (!empty($request->file('FileName')[$index])) {
                    $uploadFiles = new TrailerFilesModel();
                    $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName')[$index], 'trailersdocs');
                    $uploadFiles->VehicleId_VIN = $VehicleId_VIN;
                    $uploadFiles->TrailerSerialNo = $TrailerSerialNo;
                    $uploadFiles->FileName = $fileName;
                    $uploadFiles->mimetype = $request->file('FileName')[$index]->getClientOriginalExtension();
                    $uploadFiles->DocType = $request->input('DocType')[$index];
                    $uploadFiles->save();
                }
            }
        }
    }

    private function removeDocs($file_name)
    {
        try {
                File::delete(ImgUploader::real_public_path() . 'docs/' . $file_name);
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function trailerOwners(Request $request)
    {
        $data = SiteModel::select([
            'site.Division', 'site.OrganizationId',
            'vendor.VendorId',
        ])
        ->join('organization', 'site.OrganizationId', '=', 'organization.OrganizationId')
        ->join('vendor', 'organization.VendorId', '=', 'vendor.VendorId')
        ->where('SiteId', $request->input('SiteId'))->first();
        if ($data) {
            return response()->json([ 'success' => 1 ,'Owner'=> $data->VendorId, 'business'=> $data->Division, 'OrganizationId' => $data->OrganizationId]);    
        } else {
            return response()->json(['success' => 0]);
        }
        
    }
}
