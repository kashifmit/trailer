<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ConditionStatus extends Model
{
    use Notifiable;
    protected $table='condition_status';
    public $timestamp = 'false';
    public $primarykey='ConditionStatusId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ConditionType',
    ];
}
