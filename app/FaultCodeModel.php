<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaultCodeModel extends Model
{
    protected $table = 'fault_code';
    public $timestamps = false;
    protected $guarded = ['FaultReasonCode'];
}
