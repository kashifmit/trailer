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
use App\MaintenanceModel;
use App\MaintenanceInvoiceModel;
use App\MaintenanceInvoiceDetailModel;
use App\RequestMaintenanceModel;
use App\RegistrationModel;
use App\EquipmentModel;
use App\EquipmentTrackingModel;
use App\TrailerFilesModel;
use App\Helpers\DataArrayHelper;
use App\Exports\HeaderCSV;
use App\Exports\LineItemCSV;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
// use DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $data = '';
        if (!empty($request->query('TrailerSerialNo')) || !empty($request->query('VehicleId_VIN')) || !empty($request->query('TrackingId'))) {
            if (!empty($request->query('TrailerSerialNo'))) {
                $trailerNumber = EquipmentModel::select('TrailerSerialNo')->where('TrailerSerialNo', $request->query('TrailerSerialNo'))->first();
            }

            if (!empty($request->query('VehicleId_VIN'))) {
                $trailerNumber = RegistrationModel::select('TrailerSerialNo')->where('VehicleId_VIN', $request->query('VehicleId_VIN'))->first();
            }

            if (!empty($request->query('TrackingId'))) {
                $trailerNumber = EquipmentTrackingModel::select('TrailerSerialNo')->where('TrackingId', $request->query('TrackingId'))->first();
            }
            if ($trailerNumber) {
                $data = MaintenanceInvoiceModel::select([
                'maintenance_invoice.InvoiceDate', 'maintenance_invoice.InvoiceNo', 
                'maintenance_invoice.TrailerSerialNo', 
                'maintenance_invoice.LaborTotal', 
                'maintenance_invoice.PartsTotal', 
                'maintenance_invoice.AccessoriesTotal', 
                'maintenance_invoice.AnnualInspectionTotal', 
                'maintenance_invoice.RegistrationTotal',
                'maintenance_invoice.SalesTax', 
                'maintenance_invoice.TotalPrice',
                'registration.Owner', 'vendor.VendorName',
                ])
                ->where('maintenance_invoice.TrailerSerialNo', $trailerNumber->TrailerSerialNo)
                ->join('registration', 'maintenance_invoice.TrailerSerialNo', '=', 'registration.TrailerSerialNo')
                ->join('vendor', 'registration.Owner', '=', 'vendor.VendorId')
                ->orderBy('InvoiceDate', 'DESC')
                ->paginate(20);
            }
        }
       
    	return view('invoices.index')
        ->with('data', $data);
    }

    public function createInvoice()
    {

    	return view('invoices.add')
    	->with('trailers', DataArrayHelper::getTrailers())
    	->with('vendors',DataArrayHelper::getVendors());
    }

    public function storeInvoice(Request $request)
    {
        $validate = $request->validate([
            'TrailerSerialNo' => 'required',
            'InvoiceNo' => 'required|unique:maintenance_invoice',
            'InvoiceDate' => 'required',
            'MaintenanceOrderNo' => 'required|unique:maintenance',
        ]);
        try {
            $request_maintanence = new RequestMaintenanceModel();
            $request_maintanence->RequestOrderNo = $request->input('MaintenanceOrderNo');
            $request_maintanence->save();
            $this->updateRequestMaintenance($request_maintanence->RequestOrderNo, $request);

            $maintenance = new MaintenanceModel();
            $maintenance->MaintenanceOrderNo = $request->input('MaintenanceOrderNo');
            $maintenance->RequestOrderNo = $request_maintanence->RequestOrderNo;
            $maintenance->save();
            $this->updateMaintenance($maintenance->MaintenanceOrderNo, $request, $maintenance->RequestOrderNo);

            $invoice = new MaintenanceInvoiceModel();
            $invoice->InvoiceNo = $request->input('InvoiceNo');
            $invoice->MaintenanceOrderNo = $request->input('MaintenanceOrderNo');
            $invoice->TrailerSerialNo = $request->input('TrailerSerialNo');
            $invoice->save();
            $this->updateMaintenanceInvoice($invoice->InvoiceNo, $request);

            // $invoice_detail = new MaintenanceInvoiceDetailModel();
            // $invoice_detail->InvoiceLine = rand(1,10000);
            // $invoice_detail->InvoiceNo = $invoice->InvoiceNo;
            // $invoice_detail->save();
            // $this->updateMaintenanceInvoiceDetail($invoice_detail->InvoiceLine, $request);
            $this->uploadFile($request, $invoice->InvoiceNo);
            // return Redirect::route('create.invoice', ['InvoiceNo', $invoice->InvoiceNo, 'TrailerSerialNo', $request->input('TrailerSerialNo')]);
            return Redirect::route('invoice.success', [$invoice->InvoiceNo, $request->input('TrailerSerialNo')]);
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
        
    }

    public function invoiceSuccess($InvoiceNo, $TrailerSerialNo)
    {
        flash('Invoice '.$InvoiceNo. '- Successfully Loaded to Trailer ' .$TrailerSerialNo. ' Profile')->success();
        return view('invoices.success')
        ->with('InvoiceNo', $InvoiceNo)
        ->with('TrailerSerialNo', $TrailerSerialNo);
    }

    public function getInovice($InvoiceNo)
    {
        $data = MaintenanceInvoiceModel::select([
           'maintenance.RequestOrderNo',
           'maintenance_invoice.MaintenanceOrderNo',
           'maintenance_invoice.InvoiceDate', 
           'maintenance_invoice.InvoiceNo', 
           'maintenance_invoice.TrailerSerialNo',
           'registration.VehicleId_VIN',
           'maintenance_invoice.TotalPrice', 
           'maintenance_invoice.SalesTax', 
           'maintenance_invoice.LaborTotal', 
           'maintenance_invoice.PartsTotal', 
           'maintenance_invoice.AccessoriesTotal', 
           'maintenance_invoice.AnnualInspectionTotal', 
           'maintenance_invoice.RegistrationTotal',
           'maintenance_invoice.SalesTax', 
           'maintenance_invoice.TotalPrice',
           'registration.Owner',
           'files.Id', 'files.FileName'
        ])
        // ->join('maintenance_invoice_detail', 'maintenance_invoice.InvoiceNo', '=', 'maintenance_invoice_detail.InvoiceNo')
        ->join('registration', 'maintenance_invoice.TrailerSerialNo', '=', 'registration.TrailerSerialNo')
        ->join('maintenance', 'maintenance_invoice.MaintenanceOrderNo', '=', 'maintenance.MaintenanceOrderNo')
        ->leftJoin('files', function($join) use($InvoiceNo) {
            $join->on('maintenance_invoice.TrailerSerialNo', '=', 'files.TrailerSerialNo');
            // $join->where('files.DocType', $InvoiceNo);
        })
        ->where('maintenance_invoice.InvoiceNo', $InvoiceNo)
        // ->where('maintenance_invoice_detail.InvoiceLine', $InvoiceLine)
        ->get();
        return view('invoices.edit')
        ->with('trailers', DataArrayHelper::getTrailers())
        ->with('vendors',DataArrayHelper::getVendors())
        ->with('data', $data[0]);

    }

    public function updateInvoice($InvoiceNo, Request $request)
    {
        $validate = $request->validate([
            'InvoiceDate' => 'required',
        ]);
        try {
            // $this->updateRequestMaintenance($request->input('RequestOrderNo'), $request);
            // $this->updateMaintenance($request->input('MaintenanceOrderNo'), $request, $request->input('RequestOrderNo'));
            $this->updateMaintenanceInvoice($InvoiceNo, $request);
            // $this->updateMaintenanceInvoiceDetail($request->input('InvoiceLine'), $request);
            $this->uploadFile($request, $InvoiceNo);
            flash('Trailer has been updated successfully!')->success();
            return Redirect::route('edit.invoice', ['InvoiceNo' => $InvoiceNo]);
        } catch(QueryException $e) {
          return back()->withError($e->getMessage());
        }
    }

    private function updateRequestMaintenance($RequestOrderNo, $request)
    {
        RequestMaintenanceModel::where('RequestOrderNo', $RequestOrderNo)->update([
            'RequestPersonPhoneNo' => null !== $request->input('RequestPersonPhoneNo') ? $request->input('RequestPersonPhoneNo') : NULL,
            'RequestPersonEmail' => null !== $request->input('RequestPersonEmail') ? $request->input('RequestPersonEmail') : NULL,
            'RepairLocationName' => null !== $request->input('RepairLocationName') ? $request->input('RepairLocationName') : NULL,
            'RepairLocationName2' => null !== $request->input('RepairLocationName2') ? $request->input('RepairLocationName2') : NULL,
            'RepairLocationAddress' => null !== $request->input('RepairLocationAddress') ? $request->input('RepairLocationAddress') : NULL,
            'RepairLocationAddress2' => null !== $request->input('RepairLocationAddress2') ? $request->input('RepairLocationAddress2') : NULL,
            'RepairLocationCity' => null !== $request->input('RepairLocationCity') ? $request->input('RepairLocationCity') : NULL,
            'RepairLocationZipCode' => null !== $request->input('RepairLocationZipCode') ? $request->input('RepairLocationZipCode') : NULL,
            'TrailerSerialNo' => null !== $request->input('TrailerSerialNo') ? $request->input('TrailerSerialNo') : NULL,
            'WorkOrderCallOutId' => null !== $request->input('WorkOrderCallOutId') ? $request->input('WorkOrderCallOutId') : NULL,
            'RepairLocationState' => null !== $request->input('RepairLocationState') ? $request->input('RepairLocationState') : NULL,
        ]);
    }

    private function updateMaintenance($MaintenanceOrderNo, $request, $RequestOrderNo)
    {
        MaintenanceModel::where('MaintenanceOrderNo',$MaintenanceOrderNo)->update([
            'ServiceOrderDate' => null !== $request->input('ServiceOrderDate') ? $request->input('ServiceOrderDate') : NULL,
            'ResponseDate' => null !== $request->input('ResponseDate') ? $request->input('ResponseDate') : NULL,
            'ResponseTime' => null !== $request->input('ResponseTime') ? $request->input('ResponseTime') : NULL,
            'StartDate' => null !== $request->input('StartDate') ? $request->input('StartDate') : NULL,
            'StartTime' => null !== $request->input('StartTime') ? $request->input('StartTime') : NULL,
            'CompletionDate' => null !== $request->input('CompletionDate') ? $request->input('CompletionDate') : NULL,
            'CompletionTime' => null !== $request->input('CompletionTime') ? $request->input('CompletionTime') : NULL,
            'HoursOutofService' => null !== $request->input('HoursOutofService') ? $request->input('HoursOutofService') : NULL,
            'RequestOrderNo' => null !== $RequestOrderNo ? $RequestOrderNo : NULL,
        ]);
    }

    private function updateMaintenanceInvoice($InvoiceNo, $request)
    {
        MaintenanceInvoiceModel::where('InvoiceNo', $InvoiceNo)->update([
            'InvoiceDate' => null !== $request->input('InvoiceDate') ? date("Y-m-d", strtotime($request->input('InvoiceDate'))) : NULL,
            'Rebill' => null !== $request->input('Rebill') ? $request->input('Rebill') : "YES",
            'TotalPrice' => null !== $request->input('TotalPrice') ? $request->input('TotalPrice') : 0,
            'SalesTax' => null !== $request->input('SalesTax') ? $request->input('SalesTax') : 0,
            'LaborTotal' => null !== $request->input('LaborTotal') ? $request->input('LaborTotal') : 0,
            'PartsTotal' => null !== $request->input('PartsTotal') ? $request->input('PartsTotal') : 0,
            'AccessoriesTotal' => null !== $request->input('AccessoriesTotal') ? $request->input('AccessoriesTotal') : 0,
            'AnnualInspectionTotal' => null !== $request->input('AnnualInspectionTotal') ? $request->input('AnnualInspectionTotal') : 0,
            'RegistrationTotal' => null !== $request->input('RegistrationTotal') ? $request->input('RegistrationTotal') : 0,
        ]);
    }

    private function updateMaintenanceInvoiceDetail($InvoiceLine, $request, $index='')
    {
        $UnitPrice = 0;
        $LaborHoursQty = 0;
        if (!empty($request->input('UnitPrice')[$index])) {
            $UnitPrice = $request->input('UnitPrice')[$index];
        } 
        if (!empty($request->input('LaborHoursQty')[$index])) {
            $LaborHoursQty = $request->input('LaborHoursQty')[$index];
        } 
        // echo $index."<<<>>>>".$request->input('UnitPrice')[$index]."<<>>>".$request->input('LaborHoursQty')[$index]."<<<<>>>".$request->input('LineType')[$index]."<br>";
        MaintenanceInvoiceDetailModel::where('InvoiceLine', $InvoiceLine)->update([
            'ResolutionDescriptionSE' => null !== $request->input('ResolutionDescriptionSE')[$index] ? $request->input('ResolutionDescriptionSE')[$index] : NULL,
            'UnitPrice' => $UnitPrice,
            'LaborHoursQty' => $LaborHoursQty,
            'TotalPrice' => $UnitPrice*$LaborHoursQty,
            'SalesTax' => 0,
            'Rework' => null !== $request->input('Rework')[$index] ? $request->input('Rework')[$index] : "YES",
            'RepairComments' => null !== $request->input('RepairComments')[$index] ? $request->input('RepairComments')[$index] : NULL,
            'ATACodeId' => null !== $request->input('ATACodeId')[$index] ? $request->input('ATACodeId')[$index] : NULL,
            'FaultReasonCode' => null !== $request->input('FaultReasonCode')[$index] ? $request->input('FaultReasonCode')[$index] : NULL,
            'ResolutionCodeId' => null !== $request->input('ResolutionCodeId')[$index] ? $request->input('ResolutionCodeId')[$index] : NULL,
            'PartsLaborId' => null !== $request->input('PartsLaborId')[$index] ? $request->input('PartsLaborId')[$index] : NULL,
            'LineType' => null !== $request->input('LineType')[$index] ? $request->input('LineType')[$index] : Null,
        ]);
    }

    private function uploadFile($request, $invoiceLine)
    {
        if ( null !== $request->input('Id') && !empty($request->file('FileName')) ) {
            $uploadFiles = TrailerFilesModel::where('Id', $request->input('Id'))->first();
            $this->removeDocs($uploadFiles->FileName);
            $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName'), 'trailersdocs');
            TrailerFilesModel::where('Id', $request->input('Id'))->update([
                'FileName' => $fileName,
                'mimetype' => $request->file('FileName')->getClientOriginalExtension(),
                'InvoiceNo' => $invoiceLine
            ]);
        } else {
            if (!empty($request->file('FileName'))) {
                $trailerSerial = null !== $request->input('TrailerSerial') ? $request->input('TrailerSerial') : $request->input('TrailerSerialNo');
                $uploadFiles = new TrailerFilesModel();
                $fileName = ImgUploader::UploadDoc('docs', $request->file('FileName'), 'invoicedocs');
                $uploadFiles->VehicleId_VIN = $request->input('VehicleId_VIN');
                $uploadFiles->TrailerSerialNo = $trailerSerial;
                $uploadFiles->FileName = $fileName;
                $uploadFiles->mimetype = $request->file('FileName')->getClientOriginalExtension();
                $uploadFiles->DocType = 'invoice';
                $uploadFiles->InvoiceNo = $invoiceLine;
                $uploadFiles->save();
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

    public function trailerVendor(Request $request)
    {
        $data = RegistrationModel::select('Owner', 'VehicleId_VIN')->where('TrailerSerialNo', $request->input('TrailerSerialNo'))->first();
        if ($data) {
            return response()->json([ 'success' => 1 ,'Owner'=> $data->Owner, 'VehicleId_VIN' => $data->VehicleId_VIN]);    
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function addLineItem($InvoiceNo)
    {
        $data = MaintenanceInvoiceModel::select('InvoiceNo', 'InvoiceDate', 'LaborTotal', 'PartsTotal', 'AccessoriesTotal', 'AnnualInspectionTotal', 'RegistrationTotal', 'SalesTax', 'TotalPrice')->where('InvoiceNo', $InvoiceNo)->first();
        return view('invoices.add_inline')
        ->with('data', $data)
        ->with('invoices', DataArrayHelper::getInvoiceList());

    }

    public function createLineItem($InvoiceNo)
    {
        $data = MaintenanceInvoiceModel::select('InvoiceNo', 'InvoiceDate', 'LaborTotal', 'PartsTotal', 'AccessoriesTotal', 'AnnualInspectionTotal', 'RegistrationTotal', 'SalesTax', 'TotalPrice')->where('InvoiceNo', $InvoiceNo)->first()->toArray();
        $arrayData = [
            'Labor Total'=> 'LaborTotal', 
            'Parts Total' => 'PartsTotal',
            'Accessories Total' => 'AccessoriesTotal',
            'Annual Inspection Total' => 'AnnualInspectionTotal',
            'Registration Total' => 'RegistrationTotal',
            'Tax Total' => 'SalesTax',
            'Total Invoice Amount' => 'TotalPrice',
        ];
        return view('inline_invoice.add')
        ->with('data', $data)
        ->with('arrayData', $arrayData)
        ->with('invoices', DataArrayHelper::getInvoiceList())
        ->with('getResolutionCode', DataArrayHelper::getResolutionCode())
        ->with('getAtaCode', DataArrayHelper::getAtaCode())
        ->with('getFaultCode', DataArrayHelper::getFaultCode());
    }

    public function storeInlineInvoiceItem($InvoiceNo, Request $request)
    {
        try {
            $this->updateMaintenanceInvoice($InvoiceNo, $request);
            foreach ($request->input('LineType') as $key => $value) {
            $invoice_detail = new MaintenanceInvoiceDetailModel();
            $invoice_detail->InvoiceLine = rand(1,100000);
            $invoice_detail->InvoiceNo = $InvoiceNo;
            $invoice_detail->ResolutionDescriptionSE = NULL;
            $invoice_detail->UnitPrice = null !== $request->input('UnitPrice')[$key] ? $request->input('UnitPrice')[$key] : 0;
            $invoice_detail->LaborHoursQty = $request->input('LaborHoursQty')[$key];
            $invoice_detail->TotalPrice = ($request->input('UnitPrice')[$key]*$request->input('LaborHoursQty')[$key]);
            $invoice_detail->SalesTax = 0;
            $invoice_detail->Rework = "YES";
            $invoice_detail->RepairComments = NULL;
            $invoice_detail->ATACodeId = $request->input('ATACodeId')[$key];
            $invoice_detail->FaultReasonCode = $request->input('FaultReasonCode')[$key];
            $invoice_detail->ResolutionCodeId = $request->input('ResolutionCodeId')[$key];
            $invoice_detail->PartsLaborId = null !== $request->input('PartsLaborId') ? $request->input('PartsLaborId') : NULL;
            $invoice_detail->LineType = $value;
                $invoice_detail->save();
            }
            flash('Invoice Line Added successfully!')->success();
            return Redirect::route('create.line.item', $InvoiceNo);
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function exportHeadCSV()
    {
        return Excel::download(new HeaderCSV, 'headerCSV_'.\Carbon\Carbon::now().'.xlsx');
    }

    public function exportLineCSV()
    {
        return Excel::download(new LineItemCSV, 'LINEITEMCSV_'.\Carbon\Carbon::now().'.xlsx');
    }

    public function editInvoiceLine($InvoiceNo, Request $request)
    {
        $data = MaintenanceInvoiceModel::with(['invoiceLineItems'])->select('InvoiceNo', 'InvoiceDate', 'LaborTotal', 'PartsTotal', 'AccessoriesTotal', 'AnnualInspectionTotal', 'RegistrationTotal', 'SalesTax', 'TotalPrice')->where('InvoiceNo', $InvoiceNo)->first();
        $arrayData = [
            'Labor Total'=> 'LaborTotal', 
            'Parts Total' => 'PartsTotal',
            'Accessories Total' => 'AccessoriesTotal',
            'Annual Inspection Total' => 'AnnualInspectionTotal',
            'Registration Total' => 'RegistrationTotal',
            'Tax Total' => 'SalesTax',
            'Total Invoice Amount' => 'TotalPrice',
        ];
        $Labor = $Parts = $Accessories = $AnnualInspection = $Registration = $Sales = [];
        $LaborTotal = $PartsTotal = $AccessoriesTotal = $AnnualInspectionTotal = $RegistrationTotal = $SalesTax = array();
        foreach ($data->invoiceLineItems as $key => $value) {
            if (!empty($value->LineType)) {
                switch ($value->LineType) {
                case 'LaborTotal':
                    $Labor['InvoiceLine'] = $value->InvoiceLine;
                    $Labor['UnitPrice'] = $value->UnitPrice;
                    $Labor['LaborHoursQty'] = $value->LaborHoursQty;
                    $Labor['TotalPrice'] = $value->TotalPrice;
                    $Labor['FaultReasonCode'] = $value->FaultReasonCode;
                    $Labor['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $Labor['ATACodeId'] = $value->ATACodeId;
                    array_push($LaborTotal, $Labor);
                    break;
                case 'PartsTotal':
                    $Parts['InvoiceLine'] = $value->InvoiceLine;
                    $Parts['UnitPrice'] = $value->UnitPrice;
                    $Parts['LaborHoursQty'] = $value->LaborHoursQty;
                    $Parts['TotalPrice'] = $value->TotalPrice;
                    $Parts['FaultReasonCode'] = $value->FaultReasonCode;
                    $Parts['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $Parts['ATACodeId'] = $value->ATACodeId;
                    array_push($PartsTotal, $Parts);
                    break;
                case 'AccessoriesTotal':
                    $Accessories['InvoiceLine'] = $value->InvoiceLine;
                    $Accessories['UnitPrice'] = $value->UnitPrice;
                    $Accessories['LaborHoursQty'] = $value->LaborHoursQty;
                    $Accessories['TotalPrice'] = $value->TotalPrice;
                    $Accessories['FaultReasonCode'] = $value->FaultReasonCode;
                    $Accessories['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $Accessories['ATACodeId'] = $value->ATACodeId;
                    array_push($AccessoriesTotal, $Accessories);
                    break;
                case 'AnnualInspectionTotal':
                    $AnnualInspection['InvoiceLine'] = $value->InvoiceLine;
                    $AnnualInspection['UnitPrice'] = $value->UnitPrice;
                    $AnnualInspection['LaborHoursQty'] = $value->LaborHoursQty;
                    $AnnualInspection['TotalPrice'] = $value->TotalPrice;
                    $AnnualInspection['FaultReasonCode'] = $value->FaultReasonCode;
                    $AnnualInspection['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $AnnualInspection['ATACodeId'] = $value->ATACodeId;
                    array_push($AnnualInspectionTotal, $AnnualInspection);
                    break;
                case 'RegistrationTotal':
                    $Registration['InvoiceLine'] = $value->InvoiceLine;
                    $Registration['UnitPrice'] = $value->UnitPrice;
                    $Registration['LaborHoursQty'] = $value->LaborHoursQty;
                    $Registration['TotalPrice'] = $value->TotalPrice;
                    $Registration['FaultReasonCode'] = $value->FaultReasonCode;
                    $Registration['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $Registration['ATACodeId'] = $value->ATACodeId;
                    array_push($RegistrationTotal, $Registration);
                    break;
                case 'SalesTax':
                    $Sales['InvoiceLine'] = $value->InvoiceLine;
                    $Sales['UnitPrice'] = $value->UnitPrice;
                    $Sales['LaborHoursQty'] = $value->LaborHoursQty;
                    $Sales['TotalPrice'] = $value->TotalPrice;
                    $Sales['FaultReasonCode'] = $value->FaultReasonCode;
                    $Sales['ResolutionCodeId'] = $value->ResolutionCodeId;
                    $Sales['ATACodeId'] = $value->ATACodeId;
                    array_push($SalesTax, $Sales);
                    break;
                }
            }
        }
        $ItemArray = [
            'LaborTotal' => $LaborTotal,
            'PartsTotal' => $PartsTotal,
            'AccessoriesTotal' => $AccessoriesTotal,
            'AnnualInspectionTotal' => $AnnualInspectionTotal,
            'RegistrationTotal' => $RegistrationTotal,
            'SalesTax' => $SalesTax
        ];
        return View('inline_invoice.edit')
            ->with('data', $data)
            ->with('arrayData', $arrayData)
            ->with('invoices', DataArrayHelper::getInvoiceList())
            ->with('getResolutionCode', DataArrayHelper::getResolutionCode())
            ->with('getAtaCode', DataArrayHelper::getAtaCode())
            ->with('getFaultCode', DataArrayHelper::getFaultCode())
            ->with('ItemArray', $ItemArray);
    }

    public function updateInvoiceLine($InvoiceNo, Request $request)
    {   
        // dd($request->all());
        $this->updateMaintenanceInvoice($InvoiceNo, $request);
        foreach ($request->input('InvoiceLine') as $key => $value) {
            if (!empty($value)) {
                    $this->updateMaintenanceInvoiceDetail($value, $request, $key);
            } else {
                $invoice_detail = new MaintenanceInvoiceDetailModel();
                $invoice_detail->InvoiceLine = rand(1,10000);
                $invoice_detail->InvoiceNo = $InvoiceNo;
                $invoice_detail->save();
                $this->updateMaintenanceInvoiceDetail($invoice_detail->InvoiceLine, $request, $key);
            }
        }
        flash('Invoice Line updated successfully!')->success();
        return Redirect::route('edit.invoice.line', $InvoiceNo);
    }
}
