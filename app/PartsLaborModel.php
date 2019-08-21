<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartsLaborModel extends Model
{
    protected $table = 'parts_labor';
    public $timestamps = false;
    protected $guarded = ['PartsLaborId'];
}
