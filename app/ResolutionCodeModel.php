<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResolutionCodeModel extends Model
{
    protected $table = 'resolution_code';
    public $timestamps = false;
    protected $guarded = ['ResolutionCodeId'];
}
