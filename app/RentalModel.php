<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentalModel extends Model
{
    protected $table = 'rental';
    public $timestamps = false;
    protected $guarded = ['RentalTransId'];
}
