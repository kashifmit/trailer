<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TrailerDetails extends Model
{
    //
    use Notifiable;
    protected $table='trailer_detail';
    public $timestamp = 'false';
    public $primarykey='TrailerDetailId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ManufacturerId','TrailerTypeId','ConditionStatusId','SuspensionId','updated_at','created_at',
    ];
}
