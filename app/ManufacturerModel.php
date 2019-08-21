<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManufacturerModel extends Model
{
    protected $table = 'trailer_manufacturer';
    public $timestamps = false;
    protected $guarded = ['MakeId'];
}
