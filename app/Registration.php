<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    use Notifiable;
    protected $table='registration1';
    public $timestamp = 'false';
    public $primarykey='VehicleId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Make','PlateNo','Class','ExpireDate','TitleNo','RegistrationDate','StateAbbreviation','Document','TrailerSerialNo','TractorSerialNo','Own_info','ModelYear','created_at','updated_at', 
    ];
}
