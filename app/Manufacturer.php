<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use Notifiable;
    protected $table='t_manufacturer';
    public $timestamp = 'false';
    public $primarykey='ManufacturerId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ManuName',
    ];
}
