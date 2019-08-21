<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrailerFilesModel extends Model
{
    protected $table = 'files';
    public $timestamps = false;
    protected $guarded = ['Id'];
}
