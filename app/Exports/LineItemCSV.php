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
    public function collection()
    {
        return MaintenanceInvoiceDetailModel::select('InvoiceLine', 'UnitPrice', 'LaborHoursQty', 'InvoiceNo', 'LineType')->get();
    }

    public function headings(): array
    {
        return [
            'Invoice Line',
            'Unit Price',
            'Labor Hours Qty',
            'Invoice No',
            'Line Type'
        ];
    }
}
