<?php

namespace App\Http\Controllers;
use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Mapper;
use Redirect;
use Zipper;
use App\EquipmentModel;
use App\TrailerFilesModel;
use App\RegistrationModel;
use App\EquipmentTrackingModel;
use App\SiteModel;
use App\ManufacturerModel;
use App\MaintenanceInvoiceModel;
use App\TrailerRentedViaModel;
use App\RentalModel;
use App\rentedViaModel;
use App\modelYearModel;
use Carbon\Carbon;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Exports\ExportTrailerTrackingCSV;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class TrailerController extends Controller
{
    public function excelView()
    {
        return view('trailers.excelView');
        # code...
    }
    
    public function importExcel(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path)->get();
        $i = 1;
        foreach ($data->toArray() as $key => $value) {
            $findTrailer = EquipmentModel::where('TrailerSerialNo', $value['unit_no._shipped'])->first();
            if (!$findTrailer) {


                $equipmentData = new EquipmentModel();
                $equipmentData->TrailerSerialNo = $value['unit_no._shipped'];
                $equipmentData->SiteId = $value['siteid'];
                $equipmentData->ModelYear = $this->getModelYear($value['year']);
                if ($value['skybitz']) {
                    $equipmentData->etrack_id = 1;
                }
                $equipmentData->ManufacturerId = $this->getMakingName($value['make']);
                $equipmentData->save();
                $registration = new RegistrationModel();
                $registration->VehicleId_VIN = $value['vin'];
                $registration->PlateNo = $value['plate'];
                $registration->TrailerSerialNo = $value['unit_no._shipped'];
                $registration->Owner = $value['organizationid'];
                $registration->StateAbbreviation = $value['plate_state'];
                $registration->save();
                if ($value['skybitz']) { 
                    $tracking = new EquipmentTrackingModel();
                    $tracking->TrackingId = $value['skybitz'];
                    $tracking->TrailerSerialNo = $value['unit_no._shipped'];
                    $tracking->trackingProvider = 1;
                    $tracking->save();
                }

                $rental = new RentalModel();
                $rental->RentalTransId = $i;
                $rental->VendorId = $value['vendorid'];
                $rental->SiteId = $value['siteid'];
                $rental->save();

                $trailerRentedVia = new TrailerRentedViaModel();
                $trailerRentedVia->Price = $value['monthly_rent'];
                $trailerRentedVia->RentalStartDate = date('Y-m-d', strtotime($value['lease_acceptance_date']));
                $trailerRentedVia->RentalEndDate = date('Y-m-d', strtotime($value['lease_end_date']));
                $trailerRentedVia->RentalTransId = $rental->RentalTransId;
                $trailerRentedVia->TrailerSerialNo = $value['unit_no._shipped'];
                $trailerRentedVia->save();
                
                $rentedVia = new rentedViaModel();
                $rentedVia->TrailerSerialNo = $value['unit_no._shipped'];
                $rentedVia->RentalTransId = $trailerRentedVia->RentalTransId;
                $rentedVia->save();
                $i++;
            }

        }
        dd("data saved successfully");
    }
    public function index(Request $request)
    {
        $trailerData = '';
        $requestData = false;
        if (null !== $request->query('TrailerSerialNo') || 
            null !== $request->query('VehicleId_VIN') || 
            null !== $request->query('SiteId') || 
            null !== $request->query('business') || 
            null !== $request->query('TrackingId') ||
            null !== $request->query('search')
            ) {
            $trailerData = $this->trailerHomeData($request);
            if ($trailerData[0]) {
                $getTrailerDetails = $this->getTrailerById($trailerData['0']->TrailerSerialNo, $request);
            }
            // $requestData = true;
        }
        $trailerSerNo = '';
        if ((!empty($trailerData) && $trailerData[0])) {
            $trailerSerNo = $trailerData[0]->TrailerSerialNo;
            $mapData = DataArrayHelper::trailerTracking($trailerSerNo, '');
            $allData = DataArrayHelper::getfinancials($trailerSerNo, $request);
            $invoices = MaintenanceInvoiceModel::where('TrailerSerialNo', $trailerSerNo)->get();
        } else {
            $allData = DataArrayHelper::getfinancials('', $request);
            $mapData = DataArrayHelper::trailerTracking('', explode(",", $allData['trailerIds']), '');
        }
        Mapper::map(39.381266, -97.922211,
                [
                    'zoom' => 5,
                    'clusters' => ['size' => 20, 'center' => true, 'zoom' => 10]
                ]
            );
        if (count($mapData)) {
            foreach ($mapData as $key => $value) {
                $trailerInfo = '<a target="_blank" href='.route('view.trailer', $value->TrailerNo).'>Trailer No '.$value->TrailerNo.'</a>';
                $content = $trailerInfo.' '.$value->ClosestLandMark.' '.$value->State.' '.$value->Country;
                Mapper::informationWindow($value->Latitude, $value->Longitude,$content
                );
            }    
        } 
        // else {
        //     Mapper::map(39.381266, -97.922211, ['marker' => false]);
        // }

        $leaseExpenseChart = DataArrayHelper::getChart(
            'Total Lease Expense', 
            $allData['leaseExpense'] ? $allData['leaseExpense'] : 0, 
            'lease_expense_chart');
        $TotalMaintenanceExpense = DataArrayHelper::getChart(
            'Total Maintenance Expense', 
            $allData['totalPrice'] ? $allData['totalPrice'] : 0, 
            'Total_Maintenance_Expense');
        $TrailerLeasedCountAndOwned = DataArrayHelper::getChart(
            'Total Trailer Count Lease & Owned', 
             $allData['totalLeased_owned'] ? $allData['totalLeased_owned'] : 0, 
            'Total_trailer_count_owned');
    	return view('trailers.index')
        ->with('trailerData', $trailerData)
    	->with('locations', DataArrayHelper::getSites())
    	->with('business', DataArrayHelper::businessList())
        ->with('getTrailers', DataArrayHelper::getTrailers())
        ->with('allData', isset($getTrailerDetails['allData']) ? $getTrailerDetails['allData'] : $allData)
        ->with('getTrackingsystems', DataArrayHelper::getTrackingsystems())
        ->with('getTrackingUnits', DataArrayHelper::getTrackingUnits())
        ->with('displayTable', true)
        ->with('mapData', $mapData)
        ->with('invoices', isset($invoices) ? $invoices : [])
        ->with('requestData', $requestData)
        ->with('data', isset($getTrailerDetails['data']) ? $getTrailerDetails['data'] : '')
        ->with('leaseExpenseChart', isset($getTrailerDetails['leaseExpenseChart']) ? $getTrailerDetails['leaseExpenseChart'] : $leaseExpenseChart)
        ->with('TotalMaintenanceExpense', isset($getTrailerDetails['TotalMaintenanceExpense']) ? $getTrailerDetails['TotalMaintenanceExpense'] : $TotalMaintenanceExpense)
        ->with('TrailerLeasedCountAndOwned', isset($getTrailerDetails['TrailerLeasedCountAndOwned']) ? $getTrailerDetails['TrailerLeasedCountAndOwned'] : $TrailerLeasedCountAndOwned);
    }

    public function createtriler(Request $request)
    {
        $allData = DataArrayHelper::getfinancials('', $request);
        $mapData = DataArrayHelper::trailerTracking('', explode(",", $allData['trailerIds']));
        if (count($mapData)) {
            Mapper::map($mapData[0]->Latitude, $mapData[0]->Longitude,
                [
                    'clusters' => ['size' => 20, 'center' => true, 'zoom' => 10]
                ]
            );
            foreach ($mapData as $key => $value) {
                $trailerInfo = '<a target="_blank" href='.route('view.trailer', $value->TrailerNo).'>Trailer No '.$value->TrailerNo.'</a>';
                $content = $trailerInfo.' '.$value->ClosestLandMark.' '.$value->State.' '.$value->Country;
                Mapper::informationWindow($value->Latitude, $value->Longitude,$content
                );
            }    
        } else {
            Mapper::map(39.381266, -97.922211, ['marker' => false]);
        }
        $leaseExpenseChart = DataArrayHelper::getChart('Total Lease Expense', $allData['leaseExpense'], 'lease_expense_chart');
        $TotalMaintenanceExpense = DataArrayHelper::getChart(
            'Total Maintenance Expense', 
            $allData['totalPrice'], 
            'Total_Maintenance_Expense');
        $TrailerLeasedCountAndOwned = DataArrayHelper::getChart(
            'Total Trailer Count Lease & Owned', 
             $allData['totalLeased_owned'], 
            'Total_trailer_count_owned');
    	return view('trailers.add')
    	->with('etracking', DataArrayHelper::getTrackingsystems())
        ->with('trailerData', '')
    	->with('make', DataArrayHelper::getMakes())
    	->with('year', DataArrayHelper::getModelYears())
    	->with('state', DataArrayHelper::getState())
        ->with('size', DataArrayHelper::getTrailerSizes())
    	->with('getTrailers', DataArrayHelper::getTrailers())
    	->with('locations', DataArrayHelper::getSites())
    	->with('conditions', DataArrayHelper::getCondition())
    	->with('owners', DataArrayHelper::getOrganizations())
        ->with('displayTable', false)
        ->with('invoices', isset($invoices) ? $invoices : [])
        ->with('requestData', false)
    	->with('business', DataArrayHelper::businessList())
        ->with('allData', $allData)
        ->with('leaseExpenseChart', $leaseExpenseChart)
        ->with('TotalMaintenanceExpense', $TotalMaintenanceExpense)
        ->with('TrailerLeasedCountAndOwned', $TrailerLeasedCountAndOwned);
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
    		// $this->uploadDocuments($equipment->TrailerSerialNo, $registration->VehicleId_VIN, $request);
	    	flash('Trailer has been added!')->success();
		    return Redirect::route('view.trailer', ['TrailerSerialNo' => $request->input('TrailerSerialNo')]);
    	} catch (ModelNotFoundException $e) {
    		return back()->withError($e->getMessage());
    	}
    }

    public function editTrailer($TrailerSerialNo, Request $request)
    {
        $mapData = DataArrayHelper::trailerTracking($TrailerSerialNo, '');
        Mapper::map(39.381266, -97.922211,
                [
                    'zoom' => 5,
                    'clusters' => ['size' => 20, 'center' => true, 'zoom' => 10]
                ]
            );
        if (count($mapData)) {
            $trailerInfo = 'Trailer No '.$mapData[0]->TrailerNo;
            $content = $trailerInfo.' '.$mapData[0]->ClosestLandMark.' '.$mapData[0]->State.' '.$mapData[0]->Country;
                Mapper::informationWindow($mapData[0]->Latitude, $mapData[0]->Longitude,$content
                );    
        }
    	$getTrailerDetails = $this->getTrailerById($TrailerSerialNo, $request);
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($getTrailerDetails['data']->filesData as $key => $value) {
            $docData[$value->DocType] = $value; 
        }
    	return view('trailers.edit')
    	->with('data', $getTrailerDetails['data'])
        ->with('docData', $docData)
        ->with('trailerData', '')
    	->with('etracking', DataArrayHelper::getTrackingsystems())
    	->with('make', DataArrayHelper::getMakes())
    	->with('year', DataArrayHelper::getModelYears())
    	->with('state', DataArrayHelper::getState())
    	->with('size', DataArrayHelper::getTrailerSizes())
    	->with('locations', DataArrayHelper::getSites())
    	->with('conditions', DataArrayHelper::getCondition())
    	->with('owners', DataArrayHelper::getOrganizations())
    	->with('business', DataArrayHelper::businessList())
        ->with('getTrailers', DataArrayHelper::getTrailers())
        ->with('allData', $getTrailerDetails['allData'])
        ->with('invoices', $getTrailerDetails['data']->TrailerInvoices ? $getTrailerDetails['data']->TrailerInvoices : [])
        ->with('requestData', true)
        ->with('displayTable', true)
        ->with('mapData', $mapData)
        ->with('leaseExpenseChart', $getTrailerDetails['leaseExpenseChart'])
        ->with('TotalMaintenanceExpense', $getTrailerDetails['TotalMaintenanceExpense'])
        ->with('TrailerLeasedCountAndOwned', $getTrailerDetails['TrailerLeasedCountAndOwned']);
    }

    public function viewTrailer($TrailerSerialNo, Request $request)
    {
        $mapData = DataArrayHelper::trailerTracking($TrailerSerialNo, '');
        if (count($mapData)) {
            Mapper::map($mapData[0]->Latitude, $mapData[0]->Longitude,
            [
                'marker' => false,
                'clusters' => ['size' => 20, 'center' => true, 'zoom' => 10]
            ]);
            $trailerInfo = 'Trailer No '.$mapData[0]->TrailerNo;
            $content = $trailerInfo.' '.$mapData[0]->ClosestLandMark.' '.$mapData[0]->State.' '.$mapData[0]->Country;
                Mapper::informationWindow($mapData[0]->Latitude, $mapData[0]->Longitude,$content
                );    
        } else {
            Mapper::map(39.381266, -97.922211, ['marker' => false]);
        }
        $getTrailerDetails = $this->getTrailerById($TrailerSerialNo, $request);
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($getTrailerDetails['data']->filesData as $key => $value) {
            $docData[$value->DocType] = $value; 
        }
        return view('trailers.view')
        ->with('data', $getTrailerDetails['data'])
        ->with('docData', $docData)
        ->with('trailerData', '')
        ->with('locations', DataArrayHelper::getSites())
        ->with('business', DataArrayHelper::businessList())
        ->with('getTrailers', DataArrayHelper::getTrailers())
        ->with('allData', $getTrailerDetails['allData'])
        ->with('displayTable', true)
        ->with('invoices', $getTrailerDetails['data']->TrailerInvoices ? $getTrailerDetails['data']->TrailerInvoices : [])
        ->with('requestData', true)
        ->with('mapData', $mapData)
        ->with('leaseExpenseChart', $getTrailerDetails['leaseExpenseChart'])
        ->with('TotalMaintenanceExpense', $getTrailerDetails['TotalMaintenanceExpense'])
        ->with('TrailerLeasedCountAndOwned', $getTrailerDetails['TrailerLeasedCountAndOwned']);
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
            // $this->uploadDocuments($TrailerSerialNo, $request->input('VehicleId_VIN'), $request);
            flash('Trailer has been updated successfully!')->success();
            return Redirect::route('view.trailer', ['TrailerSerialNo' => $TrailerSerialNo]);
        } catch (QueryException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function downLoadFile($id)
    {
        try {
            $file = TrailerFilesModel::where('Id', $id)->firstOrFail();
            $pathToFile = public_path('docs/'. $file->FileName);
            $fileName = $file->FileName;
            $headers = array(
                'Content-Type: application/'.$file->mimetype
            );
            return response()->download($pathToFile, $fileName, $headers);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
        $findData = EquipmentTrackingModel::where('TrailerSerialNo', $TrailerSerialNo)->first();
        if ($findData) { 
            $EquipmentTracking = EquipmentTrackingModel::where('TrailerSerialNo', $TrailerSerialNo)->update([
            'TrackingId' => $request->input('TrackingId'),
            'trackingProvider' => $request->input('etrack_id')
            ]);
        } else {
            $EquipmentTracking = new EquipmentTrackingModel();
            $EquipmentTracking->TrackingId = $request->input('TrackingId');
            $EquipmentTracking->TrailerSerialNo = $TrailerSerialNo;
            $EquipmentTracking->trackingProvider = $request->input('etrack_id');
            $EquipmentTracking->save();
        }
        
        
    }

    private function updateRegistration($TrailerSerialNo, $request)
    {
        $findData = RegistrationModel::where('TrailerSerialNo', $TrailerSerialNo)->first();
        if ($findData) {
            $registration = RegistrationModel::where('TrailerSerialNo', $TrailerSerialNo)->update([
                'PlateNo' => $request->input('PlateNo'),
                'StateAbbreviation' => $request->input('StateAbbreviation'),
                'TitleNo' => $request->input('TitleNo'),
                'ExpireDate' => date('Y-m-d', strtotime($request->input('ExpireDate'))),
                'RegistrationDate' => date('Y-m-d', strtotime($request->input('RegistrationDate'))),
                'Owner' => $request->input('Owner')
            ]);
        } else {
            $registration = new RegistrationModel();
            $registration->VehicleId_VIN = $request->input('VehicleId_VIN');
            $registration->TrailerSerialNo = $TrailerSerialNo;
            $registration->save();
            $this->updateRegistration($TrailerSerialNo, $request);
        }
        
    }

    private function uploadDocuments($TrailerSerialNo, $VehicleId_VIN, $request) {
        try {
            foreach ($request->input('DocType') as $index => $value) {
                if (isset($request->input('Id')[$index])) {
                    if (!empty($request->file('FileName')[$index])) {
                        $uploadFiles = TrailerFilesModel::where('Id', $request->input('Id')[$index])->first();
                        $this->removeDocs($uploadFiles->FileName);
                        $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName')[$index], $request->input('DocType')[$index]);
                        TrailerFilesModel::where('Id', $request->input('Id')[$index])->update([
                            'FileName' => $fileName,
                            'mimetype' => $request->file('FileName')[$index]->getClientOriginalExtension()
                        ]);
                    }
                } else {
                    if (!empty($request->file('FileName')[$index])) {
                        $uploadFiles = new TrailerFilesModel();
                        $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName')[$index], $request->input('DocType')[$index]);
                        $uploadFiles->VehicleId_VIN = $VehicleId_VIN;
                        $uploadFiles->TrailerSerialNo = $TrailerSerialNo;
                        $uploadFiles->FileName = $fileName;
                        $uploadFiles->mimetype = $request->file('FileName')[$index]->getClientOriginalExtension();
                        $uploadFiles->DocType = $request->input('DocType')[$index];
                        $uploadFiles->save();
                    }
                }
            }
            return response()->json(['success' => 1, 'message' => "Documents uploaded successfully"]);
        } catch (\Exception $e) {
            return response()->json([ 'success' => 0 ,'message'=> 'Something went wrong', 'technical_message' => $e->getMessage()]);
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

    public function trailerfinancilas(Request $request)
    {
        $TrailerSerialNo = '';
        if (!empty($request->query('TrailerSerialNo_financial'))) {
            $TrailerSerialNo = $request->query('TrailerSerialNo_financial');
        }
        $allData = DataArrayHelper::getfinancials($TrailerSerialNo, $request);
        $leaseExpenseChart = DataArrayHelper::getChart(
            'Total Lease Expense', 
            $allData['leaseExpense'], 
            'lease_expense_chart'
        );
        $TotalMaintenanceExpense = DataArrayHelper::getChart(
            'Total Maintenance Expense', 
            $allData['totalPrice'], 
            'Total_Maintenance_Expense'
        );
        $TrailerLeasedCountAndOwned = DataArrayHelper::getChart(
            'Total Trailer Count Lease & Owned', 
             $allData['totalLeased_owned'], 
            'Total_trailer_count_owned'
        );

        return response()->View('trailers.forms.includes.financilas_data',
            compact(
            'allData', 
            'leaseExpenseChart', 
            'TotalMaintenanceExpense', 
            'TrailerLeasedCountAndOwned'
            )
        );
    }

    private function getTrailerById($TrailerSerialNo, Request $request)
    {
        $data = EquipmentModel::with(['equipmentTracking', 'registrationData', 'filesData', 'TrailerInvoices', 'TrailerInvoices'])->where('TrailerSerialNo', $TrailerSerialNo)->get();
        $allData = DataArrayHelper::getfinancials($TrailerSerialNo, $request);
        $leaseExpenseChart = DataArrayHelper::getChart('Total Lease Expense', $allData['leaseExpense'], 'lease_expense_chart');
        $TotalMaintenanceExpense = DataArrayHelper::getChart(
            'Total Maintenance Expense', 
            $allData['totalPrice'], 
            'Total_Maintenance_Expense');
        $TrailerLeasedCountAndOwned = DataArrayHelper::getChart(
            'Total Trailer Count Lease & Owned', 
             $allData['totalLeased_owned'], 
            'Total_trailer_count_owned');
        return [
            'data' => $data[0],
            'allData' => $allData,
            'leaseExpenseChart' => $leaseExpenseChart,
            'TotalMaintenanceExpense' => $TotalMaintenanceExpense,
            'TrailerLeasedCountAndOwned' => $TrailerLeasedCountAndOwned
        ];
    }

    public function downloadTrailerLocationCsv(Request $request)
    {
        return Excel::download(new ExportTrailerTrackingCSV($request->input('trailerId')), 'trailerLocations'.\Carbon\Carbon::now().'.xlsx');
    }

    private function trailerHomeData($request)
    {
        $trailerData = EquipmentModel::select([
            'equipment.TrailerSerialNo',
            'registration.VehicleId_VIN',
            'equipment.etrack_id',
            'equipment.ManufacturerId',
            'equipment_tracking.TrackingId',
            'trailer_manufacturer.MakeName',
            'registration.PlateNo',
            'registration.ExpireDate',
            'equipment.ModelYear',
            'equipment.business',
            'site.SiteName',
            'site.Division'
        ])
        // ->where('site.SiteId', '!=', '')
        ->leftjoin('registration', 'equipment.TrailerSerialNo', '=', 'registration.TrailerSerialNo')
        ->leftjoin('equipment_tracking', 'equipment.TrailerSerialNo', '=', 'equipment_tracking.TrailerSerialNo')
        ->leftjoin('site', 'equipment.SiteId', '=', 'site.SiteId')
        ->leftjoin('trailer_manufacturer', 'equipment.ManufacturerId', '=', 'trailer_manufacturer.MakeId');
        
        if (null !== $request->query('TrailerSerialNo')) {
            $trailerData = $trailerData->where('equipment.TrailerSerialNo', $request->query('TrailerSerialNo'));
        }

        if (null !== $request->query('VehicleId_VIN')) {
            $trailerData = $trailerData->where('registration.VehicleId_VIN',$request->query('VehicleId_VIN'));
        }

        if (null !== $request->query('SiteId')) {
            $trailerData = $trailerData->where('equipment.SiteId', $request->query('SiteId'));
        }

        if (null !== $request->query('business')) {
            $trailerData = $trailerData->where('site.Division',$request->query('business'));
        }

        if (null !== $request->query('TrackingId')) {
            $trailerData = $trailerData->where('equipment_tracking.TrackingId',$request->query('TrackingId'));
        }
        $trailerData = $trailerData->paginate(20);
        return $trailerData;
    }

    public function searchTrailerLocation(Request $request)
    {
        $data = [];
        // if (!empty($request->query('TrailerNo')) || !empty($request->query('SiteId'))){
            $data = EquipmentModel::select(DB::raw('GROUP_CONCAT(TrailerSerialNo) AS trailerIds'));
            if (!empty($request->query('TrailerNo'))){
                $data = $data->where('TrailerSerialNo', $request->query('TrailerNo'));
            }
            if (!empty($request->query('SiteId'))){
                $data = $data->where('SiteId', $request->query('SiteId'));
            }
            $data = $data->get();
        // }

        $mapData = DataArrayHelper::trailerTracking('',  count($data) ? explode(",", $data[0]->trailerIds) : '', !empty($request->query('TrailerUnitNo')) ? $request->query('TrailerUnitNo') : '');

        return response()->json(['success' => count($mapData), 'mapData' => $mapData, 'displayTable' => false]);
    }

    public function trailerLocationTable(Request $request)
    {
        $data = [];
        // if (!empty($request->query('TrailerNo')) || !empty($request->query('SiteId'))){
            $data = EquipmentModel::select(DB::raw('GROUP_CONCAT(TrailerSerialNo) AS trailerIds'));
            if (!empty($request->query('TrailerNo'))){
                $data = $data->where('TrailerSerialNo', $request->query('TrailerNo'));
            }
            if (!empty($request->query('SiteId'))){
                $data = $data->where('SiteId', $request->query('SiteId'));
            }
            $data = $data->get();
        // }
        $mapData = DataArrayHelper::trailerTracking('',  count($data) ? explode(",", $data[0]->trailerIds) : '', !empty($request->query('TrailerUnitNo')) ? $request->query('TrailerUnitNo') : '');
        $displayTable = true;
        return response()->View('trailers.forms.includes.location_table',
        compact('mapData', 'displayTable'));
    }

    public function trailerData(Request $request)
    {
        $trailerData = $this->trailerHomeData($request);
        return response()->View('trailers.forms.includes.home_data_table',
        compact('trailerData'));
    }

    private function getDocs($request)
    {

        $TrailerSerialNo = $request->input('TrailerSerialNo');
        $VehicleId_VIN = $request->input('VehicleId_VIN');
        $message = "";
        if (!empty($request->input('TrackingId'))) {
            $trackData = EquipmentTrackingModel::select('TrailerSerialNo')->where('TrackingId', $request->input('TrackingId'))->first();
            if ($trackData) {
                $TrailerSerialNo = $trackData->TrailerSerialNo;
            } else { 
                $message = "Trailer Not found against tracking Id";
            }
        }
        if (!empty($request->input('TrailerSerialNo'))) {
            $VehicleId_VIN = "";
        }

        if (!empty($request->input('VehicleId_VIN'))) {
            $TrailerSerialNo = "";
        }
        if (!empty($request->input('TrailerSerialNo')) && !empty($request->input('VehicleId_VIN'))) {
            $TrailerSerialNo = $request->input('TrailerSerialNo');
            $VehicleId_VIN = $request->input('VehicleId_VIN');
        }
        if (!empty($TrailerSerialNo) || !empty($request->input('VehicleId_VIN'))) {
            $regData = RegistrationModel::select('TrailerSerialNo', 'PlateNo', 'VehicleId_VIN', 'Owner');    
        }
        if (!empty($TrailerSerialNo)) {
            $regData = $regData->where('TrailerSerialNo', $TrailerSerialNo)->first();
            if (empty($regData)) {
                $message = "Trailer Not found against Trailer Serial Number";
            }
        }
        if (!empty($request->input('VehicleId_VIN'))) {
            $regData = $regData->where('VehicleId_VIN', $VehicleId_VIN)->first();
            if (empty($regData)) {
                $message = "Trailer Not found against Vehicle Identification Number";
            }
        }
        $data = [];
        $invoiceData = [];
        if (isset($regData)) {
            $data = TrailerFilesModel::where('TrailerSerialNo', $regData->TrailerSerialNo)->where('DocType', '!=','invoice')->get();
            $invoiceData = MaintenanceInvoiceModel::with('invoiceFiles')->where('TrailerSerialNo', $regData->TrailerSerialNo)->get();
        }
        return [
            "data" => $data,
            "invoiceData" => $invoiceData,
            "regData" => isset($regData) ? $regData : [],
            "message" => $message
        ];
    }

    public function searchTrailerDocs(Request $request)
    {
        $result = $this->getDocs($request);
        $data = $result['data'];
        $invoiceData = $result['invoiceData'];
        $message = $result['message'];
        $docTypes = DataArrayHelper::docsTypes();
        $regData = $result['regData'];
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($data as $key => $value) {
            $docData[$value->DocType] = $value; 
        }
        return response()->View('trailers.forms.includes.trailer_doc_table',
        compact('invoiceData', 'regData', 'docTypes', 'message', 'docData'));

    }
    public function downAllDocs(Request $request)
    {
        $result = $this->getDocs($request);
        $data = $result['data'];
        $invoiceData = $result['invoiceData'];
        $regData = $result['regData'];
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($data as $key => $value) {
            $docData[$value->DocType] = $value; 
        }
        return response()->View('trailers.forms.includes.download_all_docs',
        compact('docData', 'invoiceData', 'regData'));
    }

    public function searchDocsForm()
    {
        return response()->View('trailers.forms.includes.search_documents');
    }
    public function uploadAllDocs(Request $request)
    {
        $result = $this->getDocs($request);
        $data = $result['data'];
        $regData = $result['regData'];
        $docTypes = DataArrayHelper::docsTypes();
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($data as $key => $value) {
            $docData[$value->DocType] = $value; 
        }

        return response()->View('trailers.forms.includes.upload_all_docs',
        compact('docData', 'docTypes', 'regData'));
    }
    public function downLoadZip(Request $request)
    {
        try {
            if (file_exists(public_path('trailerDocs.zip'))){
            File::delete('trailerDocs.zip');
            }
            $filesData = TrailerFilesModel::where('TrailerSerialNo', $request->input('TrailerSerialNo'));
            if (!empty($request->input('Ids'))) {
                $filesData = $filesData->whereIn('Id', $request->input('Ids'));
            }
            $filesData = $filesData->get();
            foreach($filesData as $data) {
                    $files = public_path('docs/'. $data->FileName);
                    Zipper::make(public_path('trailerDocs.zip'))->add($files);
                } 
                Zipper::close();
            return response()->download(public_path('trailerDocs.zip'));
        } catch(\Exception $e) {
            return back()->withError($e->getMessage());
        }
        
    }

    public function uploadNewDocuments(Request $request)
    {
        // dd($request->all());
        $result = $this->uploadDocuments($request->input('TrailerSerialNo'), $request->input('VehicleId_VIN'), $request);

        $result = $this->getDocs($request);
        $data = $result['data'];
        $invoiceData = $result['invoiceData'];
        $message = $result['message'];
        $docTypes = DataArrayHelper::docsTypes();
        $regData = $result['regData'];
        $docData = array("inspection_document"=> '', "fhwa" => '', "tracking_installation_sheet" => '', "registration" => '');
        foreach ($data as $key => $value) {
            $docData[$value->DocType] = $value; 
        }
        $successMessage = "Document Uploaded successfully";
        return response()->View('trailers.forms.includes.trailer_doc_table',
        compact('invoiceData', 'regData', 'docTypes', 'message', 'docData', 'successMessage'));
        // return $result;
    }

    private function getMakingName($make)
    {
        if (!empty($make)) {
            $data = ManufacturerModel::where('MakeName', $make)->first();
            if ($data) {
                return $data->MakeId;
            } else {
                $data = new ManufacturerModel();
                $data->MakeName = $make;
                $data->save();
                return $data->MakeId;
            }
        } else {
            $MakeId = "12";
            return $MakeId;
        }
        
    }

    private function getModelYear($model)
    {
        if (!empty($model)) {
            $modelYear = modelYearModel::where('ModelYear', $model)->first();
            if ($modelYear) {
                return $modelYear->ModelYear;
            } else {
                $modelYear = new modelYearModel();
                $modelYear->ModelYear = $model;
                $modelYear->save();
                return $modelYear->ModelYear;
            }    
        } else {
            $ModelYear = "Unknown";
            return $ModelYear;
        }
        
    }
}
