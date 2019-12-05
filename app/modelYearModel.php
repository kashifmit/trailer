<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modelYearModel extends Model
{
    protected $table = 'model_year';
    public $timestamps = false;
    protected $guarded = ['ModelYear'];
}
