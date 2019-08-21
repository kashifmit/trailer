<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceInvoiceDetailModel extends Model
{
    protected $table = 'maintenance_invoice_detail';
    public $timestamps = false;
    protected $guarded = ['InvoiceLine'];
}
