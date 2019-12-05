<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    protected $table = 'vendor';
    public $timestamps = false;
    protected $guarded = ['VendorId'];
}
