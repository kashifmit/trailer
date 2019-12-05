<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkyBizTrackingModel extends Model
{
    protected $table = 'skybiz_tracking';
    public $timestamps = true;
    protected $guarded = ['id'];
}
