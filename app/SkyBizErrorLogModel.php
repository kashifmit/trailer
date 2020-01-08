<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkyBizErrorLogModel extends Model
{
    protected $table = 'skybiz_error_log';
    public $timestamps = true;
    protected $guarded = ['id'];
}
