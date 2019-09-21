<?php

namespace App\Helpers;

use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
use Chart;
use Carbon\Carbon;
use App\OrganizationModel;
use App\RoleModel;
use App\VendorModel;
use App\SiteModel;
use App\ManufacturerModel;
use App\modelYearModel;
use App\conditionModel;
use App\StateModel;
use App\TrackingSystemModel;
use App\CustomerModel;
use App\SizesModel;
use App\EquipmentModel;
use App\FaultCodeModel;
use App\ResolutionCodeModel;
use App\AtaCodeModel;
use App\PartsLaborModel;
use App\MaintenanceInvoiceModel;
use App\TrailerRentedViaModel;
use App\RentalModel;
use App\SkyBizTrackingModel;
use App\EquipmentTrackingModel;

class DataArrayHelper {
	
	public static function getOrganizations()
	{
		return OrganizationModel::select('OrgName', 'VendorId')->pluck('OrgName', 'VendorId')->toArray();
	}

	public static function getTrackingUnits()
	{
		return EquipmentTrackingModel::distinct('TrackingId')->pluck('TrackingId', 'TrackingId')->toArray();
	}

	public static function getOrganizationName($VendorId)
	{
		$data = OrganizationModel::select('OrgName')->where('VendorId', $VendorId)->first();
		return $data->OrgName;
	}

	public static function getRoles()
	{
		return RoleModel::select('Role_name', 'roleId')->pluck('Role_name', 'roleId')->toArray();
	}

	public static function getVendors()
	{
		return VendorModel::select('VendorName', 'VendorId')->pluck('VendorName', 'VendorId')->toArray();
	}

	public static function getSites()
	{
		return SiteModel::select(DB::raw('CONCAT(SiteName, " - " ,IF(City IS NOT NULL, City, ""), " - ", Division) AS SiteName'), 'SiteId')->pluck('SiteName', 'SiteId')->toArray();
	}

	public static function getSiteName($SiteId)
	{
		$data = SiteModel::select(DB::raw('CONCAT(SiteName, " - " ,IF(City IS NOT NULL, City, ""), " - ", Division ) AS SiteName'))->where('SiteId', $SiteId)->first();
		return $data->SiteName;
	}

	public static function getBusinessName($SiteId)
	{
		$data = SiteModel::select('Division')->where('SiteId', $SiteId)->first();
		return $data->Division;
	}
	public static function getMakes()
	{
		return ManufacturerModel::select('MakeName', 'MakeId')->pluck('MakeName', 'MakeId')->toArray();
	}

	public static function getMakeName($MakeId)
	{
		$data = ManufacturerModel::select('MakeName')->where('MakeId', $MakeId)->first();
		return $data->MakeName;
	}

	public static function getModelYears()
	{
		return modelYearModel::select('ModelYear', 'ModelYear')->pluck('ModelYear', 'ModelYear')->toArray();
	}

	public static function getCondition()
	{
		return conditionModel::select('ConditionType', 'ConditionStatusId')->pluck('ConditionType', 'ConditionStatusId')->toArray();
	}

	public static function getConditionName($ConditionStatusId)
	{
		$data = conditionModel::select('ConditionType')->where('ConditionStatusId', $ConditionStatusId)->first();
		return $data->ConditionType;
	}

	public static function getState()
	{
		return StateModel::select('StateName', 'StateAbbreviation')->pluck('StateName', 'StateAbbreviation')->toArray();
	}

	public static function getStateName($StateAbbreviation)
	{
		return StateModel::select('StateName')->where('StateAbbreviation', $StateAbbreviation)->first();
	}

	public static function getTrackingsystems()
	{
		return TrackingSystemModel::select('ETrackDescription', 'ETrackId')->pluck('ETrackDescription', 'ETrackId')->toArray();
	}

	public static function getTrackingsystemName($ETrackId)
	{
		$data = TrackingSystemModel::select('ETrackDescription')->where('ETrackId', $ETrackId)->first();
		return $data->ETrackDescription;
	}


	public static function getTrailerSizes()
	{
		return SizesModel::select(DB::raw('CONCAT(ProductId, " - ","L", Length, " - ", "W", Width, " - ", "H", Height) AS Sizes'), 'ProductId')->where('ProductId', '!=', 'UNKNOWN')->orderBy('Sizes', 'ASC')->pluck('Sizes', 'ProductId')->toArray();
	}

	public static function getCustomers()
	{
		return CustomerModel::select('ShipToName', 'CustomerID')->pluck('ShipToName', 'CustomerID')->toArray();
	}

	public static function getTrailers()
	{
		return EquipmentModel::select('TrailerSerialNo', 'TrailerSerialNo')->pluck('TrailerSerialNo', 'TrailerSerialNo')->toArray();
	}

	public static function businessList()
	{
		return SiteModel::distinct('Division')->pluck('Division', 'Division')->toArray();
	}

	public static function getFaultCode()
	{
		return FaultCodeModel::select('FaultDescription', 'FaultReasonCode')->pluck('FaultDescription', 'FaultReasonCode')->toArray();
	}

	public static function getResolutionCode()
	{
		return ResolutionCodeModel::select('ResolutionCodeDescription', 'ResolutionCodeId')->pluck('ResolutionCodeDescription', 'ResolutionCodeId')->toArray();
	}

	public static function getAtaCode()
	{
		return AtaCodeModel::select('FaultAreaDescription', 'ATACodeId')->pluck('FaultAreaDescription', 'ATACodeId')->toArray();
	}

	public static function PartsLaborCode()
	{
		return PartsLaborModel::select('PartsLaborName', 'PartsLaborId')->pluck('PartsLaborName', 'PartsLaborId')->toArray();
	}

	public static function getInvoiceList()
	{
		return MaintenanceInvoiceModel::select('InvoiceNo', 'InvoiceNo')->pluck('InvoiceNo', 'InvoiceNo')->toArray();
	}

	public static function getfinancials($TrailerSerialNo='', $request)
	{
		$total = EquipmentModel::select(DB::raw('COUNT(equipment.TrailerSerialNo) as Total'), DB::raw('GROUP_CONCAT(equipment.TrailerSerialNo) AS trailerIds'), DB::raw('SUM(maintenance_invoice.TotalPrice) as TotalPrice'))
			->leftJoin('maintenance_invoice', 'equipment.TrailerSerialNo', '=', 'maintenance_invoice.TrailerSerialNo');

        $leaseExpense = TrailerRentedViaModel::select([DB::raw('SUM(trailer_rented_via.Price) as Price')])
        ->join('equipment', 'trailer_rented_via.TrailerSerialNo', '=', 'equipment.TrailerSerialNo');
        

        $leasedTrailer = RentalModel::whereNotNull('rental.RentalTransId');
        $leasedTrailer = $leasedTrailer->join('site', 'rental.SiteId', '=', 'site.SiteId');

        if (!empty($TrailerSerialNo)) {
        	$total = $total->where('equipment.TrailerSerialNo', $TrailerSerialNo);
        	$leaseExpense = $leaseExpense->where('equipment.TrailerSerialNo', $TrailerSerialNo);
        }
        if (!empty($request->query('business_financial'))) {
			$total = $total->join('site', 'equipment.SiteId', '=', 'site.SiteId');
            $total = $total->where('site.Division', 'like', "%{$request->query('business_financial')}%");
            $leaseExpense = $leaseExpense->join('site', 'equipment.SiteId', '=', 'site.SiteId');
            $leaseExpense = $leaseExpense->where('site.Division', 'like', "%{$request->query('business_financial')}%");
            $leasedTrailer = $leasedTrailer->where('site.Division', 'like', "%{$request->query('business_financial')}%");
        }
        if (!empty($request->query('SiteId_financial'))) {
            $total = $total->where('equipment.SiteId', 'like', "%{$request->query('SiteId_financial')}%");
            $leaseExpense = $leaseExpense->where('equipment.SiteId', 'like', "%{$request->query('SiteId_financial')}%");
            $leasedTrailer = $leasedTrailer->where('site.SiteId', 'like', "%{$request->query('SiteId_financial')}%");
        }
        $total = $total->get();
        $leaseExpense = $leaseExpense->first();
        $leasedTrailer = $leasedTrailer->count();
        return [
        	'totalTrailers' => $total[0]->Total, 
        	'leaseExpense' => empty($leaseExpense) ? 0 : $leaseExpense->Price, 
        	'totalPrice' => $total[0]->TotalPrice, 
        	'leasedTrailer' => empty($leasedTrailer) ? 0 : $leasedTrailer,
        	'totalLeased_owned' => $total[0]->Total+$leasedTrailer,
        	'trailerIds' => $total[0]->trailerIds
        ];
	}

	public static function getChart($title,$data, $id)
	{
		$chart1 = Chart::title([
        'text' => $title,
    	])
	    ->chart([
	        'type'     => 'bar', // pie , columnt ect
	        'renderTo' => $id, // render the chart into your div with id
	    ])
	    ->subtitle([
	        'text' => $title,
	    ])
	    ->colors([
	        '#0c2959'
	    ])
	    ->xaxis([
	        // 'categories' => [
	        //     'Lease Expense'
	        // ],
	        'labels'     => [
	            'rotation'  => 0,
	            'align'     => 'bottom',
	        ],
	    ])
	    // ->yaxis([
	    //     'text' => 'This Y Axis',
	    // ])
	    ->legend([
	        // 'layout'        => 'vertikal',
	        // 'align'         => 'left',
	        'verticalAlign' => 'middle',
	    ])
	    ->series(
	        [
	            [
	                'name'  => $title,
	                'data'  => [$data],
	            ],
	        ]
	    )
	    ->display();
	    return $chart1;
	}
	public static function trailerTracking($TrailerNo='', $TrailerIds= '', $TrailerUnitNo= '')
	{
		$start_date = date('Y-m-d H:00:00');
        $end_date = date('Y-m-d H:59:59');
        $mapData = [];
        if (!empty($TrailerNo) || !empty($TrailerIds) || !empty($TrailerUnitNo)) {
        	DB::enableQueryLog();
        	$mapData = SkyBizTrackingModel::select('id','TrailerNo','TrailerUnitNo','Latitude', 'Longitude', 'ClosestLandMark', 'State', 'Country', 'DistanceFromLandmark', 'BatteryStatus', 'Motion_status', 'track_date_time');
     	if (!empty($TrailerNo)) {
     		$mapData = $mapData->where('TrailerNo', $TrailerNo);
     	}

     	if (!empty($TrailerUnitNo)) {
     		$mapData = $mapData->where('TrailerUnitNo', $TrailerUnitNo);
     	}
     	if (!empty($TrailerIds)) {
     		$mapData = $mapData->whereIn('TrailerNo', $TrailerIds);
     		// ->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date);
     		}
     	 $mapData = $mapData->orderBy('id', 'ASC')->get();
        }
        
        return $mapData;
	}

	public static function docsTypes()
	{
		return ["inspection_document", "fhwa", "registration", "tracking_installation_sheet"];
	}

	public static function getVendndorNameByTrailer($TrailerSerialNo)
	{
		$getOwner = equipment::select()->where()->first();
	}
}