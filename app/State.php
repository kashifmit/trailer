<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    use Notifiable;
    protected $table='state';
    public $timestamp = 'false';
    public $primarykey='StateAbbreviation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StateName','Country',
    ];
}
