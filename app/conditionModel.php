<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conditionModel extends Model
{
    protected $table = 'condition_status';
    public $timestamps = false;
    protected $guarded = ['ConditionStatusId'];
}
