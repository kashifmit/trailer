<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    use Notifiable;
    protected $table='suspension';
    public $timestamp = 'false';
    public $primarykey='SuspensionId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SuspensionName','SuspensionDescription',
    ];
}
