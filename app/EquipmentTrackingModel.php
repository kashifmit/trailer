<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentTrackingModel extends Model
{
    protected $table = 'equipment_tracking';
    public $timestamps = false;
    protected $guarded = ['TrackingId'];
}
