<?php

namespace App\Exports;

use App\CustomerModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomerExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerModel::select('CustomerID', 'ShipToName', 'ShipToAddress1', 'ShipToAddress2', 'ShipToAddress3', 'ShipToCity', 'ShipToPostalCode', 'SkyBitzLoadNameOrig', 'SkyBitzLoadNameNew', 'StateAbbreviation')->get();
    }

    public function headings(): array
    {
        return [
            'Customer Id',
            'Name',
            'Address 1',
            'Address 1',
            'Address 3',
            'Ship To City',
            'Postal code',
            'Skybiz Load Name',
            'Skybiz Load Name New',
            'State'
        ];
    }
}
