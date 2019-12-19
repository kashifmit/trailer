<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rentedViaModel extends Model
{
    protected $table = 'rentedvia';
    public $timestamps = false;
    protected $guarded = ['RentalTransId'];
}
