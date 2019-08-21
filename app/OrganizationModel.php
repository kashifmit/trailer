<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationModel extends Model
{
    protected $table = 'organization';
    public $timestamps = false;
    protected $guarded = ['OrganizationId'];
}
