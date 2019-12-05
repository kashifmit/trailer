<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteServicesCostTblModel extends Model
{
    protected $table = 'site_services_cust_tbl';
    public $timestamps = false;
    protected $guarded = ['SiteId'];
}
