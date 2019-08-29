<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceInvoiceModel extends Model
{
    protected $table = 'maintenance_invoice';
    public $timestamps = false;
    protected $guarded = ['InvoiceNo'];

    public function invoiceLineItems()
    {
    	return $this->hasMany('App\MaintenanceInvoiceDetailModel', 'InvoiceNo', 'InvoiceNo');
    }
}
