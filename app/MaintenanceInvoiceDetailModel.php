<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceInvoiceDetailModel extends Model
{
    protected $table = 'maintenance_invoice_detail';
    public $timestamps = false;
    protected $guarded = ['InvoiceLine'];

    public function invoices()
    {
    	return $this->belongsTo('App\MaintenanceInvoiceModel', 'InvoiceNo');
    }

    public function ataCode()
    {
    	return $this->belongsTo('App\AtaCodeModel', 'ATACodeId', 'ATACodeId');
    }

    public function faultCode()
    {
    	return $this->belongsTo('App\FaultCodeModel', 'FaultReasonCode', 'FaultReasonCode');
    }

    public function resolutionCode()
    {
    	return $this->belongsTo('App\ResolutionCodeModel', 'ResolutionCodeId', 'ResolutionCodeId');
    }
}
