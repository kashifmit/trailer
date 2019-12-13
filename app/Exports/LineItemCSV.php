<?php

namespace App\Exports;

use App\MaintenanceInvoiceDetailModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LineItemCSV implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = explode(",", $id); 
    }
    public function collection()
    {
         $data = MaintenanceInvoiceDetailModel::with(['faultCode' => function ($query){
            $query->select('FaultReasonCode','FaultDescription');
         }, 'resolutionCode' => function($query2)
         {
            $query2->select('ResolutionCodeId','ResolutionCodeDescription');
         }, 'ataCode' => function($query3)
         {
            $query3->select('ATACodeId','FaultAreaDescription');
         }])->select('InvoiceNo', 'InvoiceLine', 'UnitPrice', 'LaborHoursQty', 'TotalPrice', 'LineType', 'FaultReasonCode', 'ResolutionCodeId', 'ATACodeId')->whereIn('InvoiceNo', $this->id)->orderBy('InvoiceNo')->get();

         $newArray = array();
         $array = [];
         foreach ($data as $singleData) {
            $array['InvoiceNo'] = $singleData->InvoiceNo;
            $array['InvoiceLine'] = $singleData->InvoiceLine;
            $array['UnitPrice'] = $singleData->UnitPrice;
            $array['LaborHoursQty'] = $singleData->LaborHoursQty;
            $array['TotalPrice'] = $singleData->TotalPrice;
            $array['LineType'] = $singleData->LineType;
            $array['faultCode'] = isset($singleData->faultCode) ? $singleData->faultCode->FaultDescription : '';
            $array['ResolutionCodeDescription'] = isset($singleData->resolutionCode) ? $singleData->resolutionCode->ResolutionCodeDescription : '';
            $array['ataCode'] = isset($singleData->ataCode) ? $singleData->ataCode->FaultAreaDescription : '';
            array_push($newArray, $array);
         }
         $exportAble = collect($newArray)->map(function ($collection) {
                return (object) $collection;
            });
         return $exportAble;
    }

    public function headings(): array
    {
        return [
            'Invoice No',
            'Invoice Line',
            'Unit Price',
            'Labor Hours / Unit Used',
            'Total Cost',
            'Line Type',
            'Fault Description',
            'Resolution Description',
            'Ata Area Code'
        ];
    }
}
