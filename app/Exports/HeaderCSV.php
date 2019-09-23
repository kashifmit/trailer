<?php

namespace App\Exports;

use App\MaintenanceInvoiceModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HeaderCSV implements FromCollection, WithHeadings, ShouldAutoSize
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
        return MaintenanceInvoiceModel::select('InvoiceNo', 'InvoiceDate', 'Rebill', 'TrailerSerialNo', 'LaborTotal', 'PartsTotal', 'AccessoriesTotal', 'AnnualInspectionTotal', 'RegistrationTotal', 'SalesTax', 'TotalPrice')->whereIn('InvoiceNo', $this->id)->get();
    }

    public function headings(): array
    {
        return [
            'Invoice Number',
            'Date',
            'Rebill',
            'Trailer Serial No',
            'Laboor Total',
            'Parts Total',
            'Accessories Total',
            'Annual Inspection Total',
            'Registration Total',
            'Sales Tax',
            'Total Price'
        ];
    }
}
