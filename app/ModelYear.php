<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ModelYear extends Model
{
    //
    use Notifiable;
    protected $table='model_year';
    public $timestamp = 'false';
    public $primarykey='ModelYear';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ModelYear',
    ];
}
