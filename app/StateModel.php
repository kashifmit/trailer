<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    protected $table = 'state';
    public $timestamps = false;
    protected $guarded = ['StateAbbreviation'];
}
