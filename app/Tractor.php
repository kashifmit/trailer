<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Tractor extends Model
{
    //
    use Notifiable;
    protected $table='tractor';
    public $timestamp = 'false';
    public $primarykey='TractorSerialNo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TractorSerialNo','LastInspectionDate', 'SiteId', 'ModelYear','created_at','updated_at',
    ];
}
