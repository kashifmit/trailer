<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackingSystemModel extends Model
{
    protected $table = 'etrack';
    public $timestamps = false;
    protected $guarded = ['ETrackId'];
}
