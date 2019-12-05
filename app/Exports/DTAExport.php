<?php

namespace App\Exports;

use App\DropTrailerCostTblModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DTAExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DropTrailerCostTblModel::select('customer.CustomerID', 'customer.ShipToName', 'customer.ShipToAddress1', 'drop_trailer_cost_tbl.CostPerHour', 'dta.NumberOfTrailers', 'dta.FreeDays')
        ->join('customer', 'drop_trailer_cost_tbl.CustomerNo', '=','customer.CustomerID')
        ->join('dta', 'drop_trailer_cost_tbl.DTAId', '=', 'dta.DTAId')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Customer Id',
            'Name',
            'Address 1',
            'Cost Per Hour',
            'Number Of Trailers',
            'Free Days'
        ];
    }
}
