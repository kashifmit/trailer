<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Organization extends Model
{
    use Notifiable;
    protected $table='organization';
    public $timestamp = 'false';
    public $primarykey='organizationId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organizationId','userId','organizationName',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
