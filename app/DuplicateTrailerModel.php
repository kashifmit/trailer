<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuplicateTrailerModel extends Model
{
    protected $table = 'equipment_duplicate';
    public $timestamps = true;
    protected $guarded = ['id'];
}
