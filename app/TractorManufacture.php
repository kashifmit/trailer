<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TractorManufacture extends Model
{
    //
    use Notifiable;
    protected $table='tractor_manu';
    public $timestamp = 'false';
    public $primarykey='ManuFacturerID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ManuName',
    ];
}
