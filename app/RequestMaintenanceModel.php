<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestMaintenanceModel extends Model
{
    protected $table = 'request_maintenance';
    public $timestamps = false;
    protected $guarded = ['RequestOrderNo'];
}
