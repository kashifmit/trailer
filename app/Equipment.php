<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    use Notifiable;
    protected $table='equipment';
    public $timestamp = 'false';
    public $primarykey='TrailerSerialNo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TrailerSerialNo','LastInspectionDate', 'SiteId', 'ModelYear','TrailerDetailId','TrailerBinaryId','created_at','updated_at',
    ];
}
