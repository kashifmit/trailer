<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropTrailerCostTblModel extends Model
{
    protected $table = 'drop_trailer_cost_tbl';
    public $timestamps = false;
    protected $guarded = ['CustomerNo'];
}
