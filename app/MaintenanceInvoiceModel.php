<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceInvoiceModel extends Model
{
    protected $table = 'maintenance_invoice';
    public $timestamps = false;
    protected $guarded = ['InvoiceNo'];
}
