<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizesModel extends Model
{
    protected $table = 'trailer_product';
    public $timestamps = false;
    protected $guarded = ['ProductId'];
}
