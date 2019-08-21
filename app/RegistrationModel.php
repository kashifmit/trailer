<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table = 'registration';
    public $timestamps = false;
    protected $guarded = ['VehicleId_VIN'];
}
