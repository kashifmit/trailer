<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceModel extends Model
{
    protected $table = 'maintenance';
    public $timestamps = false;
    protected $guarded = ['MaintenanceOrderNo'];
}
