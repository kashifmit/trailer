<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtaCodeModel extends Model
{
    protected $table = 'ata_code';
    public $timestamps = false;
    protected $guarded = ['ATACodeId'];
}
