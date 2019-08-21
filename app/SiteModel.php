<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteModel extends Model
{
    protected $table = 'site';
    public $timestamps = true;
    protected $guarded = ['id'];
}
