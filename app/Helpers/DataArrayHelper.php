<?php

namespace App\Helpers;

use Hash;
use File;
use ImgUploader;
use Auth;
use DB;
use Input;
use Redirect;
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

class DataArrayHelper {
	
	public static function getOrganizations()
	{
		return OrganizationModel::select('OrgName', 'VendorId')->pluck('OrgName', 'VendorId')->toArray();
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
		return SiteModel::select(DB::raw('CONCAT(SiteName, " - " ,IF(City IS NOT NULL, City, "") ) AS SiteName'), 'SiteId')->pluck('SiteName', 'SiteId')->toArray();
	}

	public static function getMakes()
	{
		return ManufacturerModel::select('MakeName', 'MakeId')->pluck('MakeName', 'MakeId')->toArray();
	}

	public static function getModelYears()
	{
		return modelYearModel::select('ModelYear', 'ModelYear')->pluck('ModelYear', 'ModelYear')->toArray();
	}

	public static function getCondition()
	{
		return conditionModel::select('ConditionType', 'ConditionStatusId')->pluck('ConditionType', 'ConditionStatusId')->toArray();
	}

	public static function getState()
	{
		return StateModel::select('StateName', 'StateAbbreviation')->pluck('StateName', 'StateAbbreviation')->toArray();
	}

	public static function getTrackingsystems()
	{
		return TrackingSystemModel::select('ETrackDescription', 'ETrackId')->pluck('ETrackDescription', 'ETrackId')->toArray();
	}


	public static function getTrailerSizes()
	{
		return SizesModel::select(DB::raw('CONCAT("L", Length, " - ", "W", Width, " - ", "H", Height) AS Sizes'), 'ProductId')->where('ProductId', '!=', 'UNKNOWN')->orderBy('Sizes', 'ASC')->pluck('Sizes', 'ProductId')->toArray();
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
}