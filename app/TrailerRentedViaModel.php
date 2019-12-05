<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrailerRentedViaModel extends Model
{
    protected $table = 'trailer_rented_via';
    public $timestamps = false;
    protected $guarded = ['RentalTransId'];
}
