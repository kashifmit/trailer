<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TractorType extends Model
{
    //
    use Notifiable;
    protected $table='tractor_type';
    public $timestamp = 'false';
    public $primarykey='TractorTypeId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TractorTypeName',
    ];
}
