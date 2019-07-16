<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TractorDetails extends Model
{
    //
    use Notifiable;
    protected $table='TractorDetails';
    public $timestamp = 'false';
    public $primarykey='TractorDetailId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TractorTypeId','ManuFacturerID','ConditionStatusId','created_at','updated_at',
    ];
}
